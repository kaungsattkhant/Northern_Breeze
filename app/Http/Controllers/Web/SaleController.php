<?php

namespace App\Http\Controllers\Web;

use App\Model\Group;
use App\Model\Staff;
use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;

class SaleController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $checkRole=Auth::user()->role_name(Auth::user()->role_id);
        if ($checkRole == "Admin")
        {
            $transactions=Transaction::with('staff')->get();

            if($transactions->isNotEmpty())
            {
                $transactions=$this->transaction($transactions);
            }
        }
        elseif($checkRole== "Manager")
        {
//            $transactions=$this->transaction($userId);
            $branch_id=Auth::user()->branch_id;
//            dd($branch_id);
            $staff=Staff::where('branch_id',$branch_id)->get();
//            dd($staff);
//            $a=new Collection();
            $transaction = new \Illuminate\Database\Eloquent\Collection;
            foreach($staff as $st)
            {
                $transaction=$transaction->merge(Transaction::where('staff_id',$st->id)->get());
            }
            $transactions=$this->transaction($transaction);
        }
        elseif($checkRole == "Front Man")
        {
//            dd('Front_Man');
            $transactions=Transaction::whereHas('staff', function  ($q) use ($userId) {
                $q->whereId($userId);
            })->get();
            if($transactions->isNotEmpty())
            {
                $transactions=$this->transaction($transactions);

            }
        }
//        dd($transactions);

        return view('Sale.sale_record',compact('transactions'));
    }
    protected function transaction($transactions)
    {
        foreach($transactions as $transaction)
        {
            if($transaction->status==="other_other")
            {
                $get_in_transaction=DB::table('in_transaction_group_note')->where('transaction_id',$transaction->id)->first();
                $get_out_transaction=DB::table('out_transaction_group_note')->where('transaction_id',$transaction->id)->first();
//                dd($get_in_transaction);
//                dd($get_out_transaction);
                if(isset($get_in_transaction) && isset($get_out_transaction)  )
                {
                    $get_in_group=DB::table('group_note')->whereId($get_in_transaction->group_note_id)->first();
                    $get_out_group=DB::table('group_note')->whereId($get_out_transaction->group_note_id)->first();
//                    dd($get_out_group);
                    if($get_in_group != null  && $get_out_group != null )
                    {
                        $in_currency=Group::with('currency')->whereId($get_in_group->group_id)->first();
//                        dd($in_currency);
                        $out_currency=Group::with('currency')->whereId($get_out_group->group_id)->first();
                        if($in_currency != null && $out_currency != null )
                        {
//                            dd($in_currency->currency->name);
                            $transaction->in_currency=$in_currency->currency->name;
                            $transaction->out_currency=$out_currency->currency->name;
                        }
                    }
                }
//                dd($transaction);
            }
            elseif($transaction->status==="MMK_other"){
//                dd('a');
//                $get_in_transaction=DB::table('in_transaction_group_note')->where('transaction_id',$transaction->id)->first();
                $get_out_transaction=DB::table('out_transaction_group_note')->where('transaction_id',$transaction->id)->first();

                if( isset($get_out_transaction)  )
                {
//                    $get_in_group=DB::table('group_note')->whereId($get_in_transaction->group_note_id)->first();
                    $get_out_group=DB::table('group_note')->whereId($get_out_transaction->group_note_id)->first();

                    if( $get_out_group != null )
                    {
//                        $in_currency=Group::with('currency')->whereId($get_in_group->group_id)->first();
                        $out_currency=Group::with('currency')->whereId($get_out_group->group_id)->first();
//                        dd($out_currency);
                        if( $out_currency != null )
                        {
                            $transaction->in_currency="Myanmar Kyat";
                            $transaction->out_currency=$out_currency->currency->name;
                        }

                    }
                }
            }
            elseif($transaction->status==="other_MMK"){
                $get_in_transaction=DB::table('in_transaction_group_note')->where('transaction_id',$transaction->id)->first();
//                $get_out_transaction=DB::table('out_transaction_group_note')->where('transaction_id',$transaction->id)->first();
                if(isset($get_in_transaction) )
                {
                    $get_in_group=DB::table('group_note')->whereId($get_in_transaction->group_note_id)->first();
//                    dd($get_in_group);
//                    $get_out_group=DB::table('group_note')->whereId($get_out_transaction->group_note_id)->first();
                    if($get_in_group != null )
                    {
                        $in_currency=Group::with('currency')->whereId($get_in_group->group_id)->first();
//                        $out_currency=Group::with('currency')->whereId($get_out_group->group_id)->first();
                        if($in_currency != null )
                        {
                            $transaction->in_currency=$in_currency->currency->name;
                            $transaction->out_currency="Myanmar Kyat";
                        }
                    }
                }
            }


        }
//        dd($transactions);
        return $transactions;
    }

}
