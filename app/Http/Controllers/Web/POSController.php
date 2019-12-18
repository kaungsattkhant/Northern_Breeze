<?php

namespace App\Http\Controllers\Web;

use App\Http\Traits\CurrencyFilter;
use App\Http\Traits\ToExchangeFilter;
use App\Model\Branch;
use App\Model\BuyGroupValue;
//use http\Exception\BadUrlException;
use App\Model\Currency;
use App\Model\Group;
use App\Model\Note;
use App\Model\SellGroupValue;
use App\Model\Transaction;
use Carbon\Carbon;
use Carbon\Exceptions\BadUnitException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;


class POSController extends Controller
{
    use CurrencyFilter;
    use ToExchangeFilter;
    public function pos_member()
    {
        return view('Member.pos_member');
    }
    public function pos_non_member()
    {
        return view('Member.non_member');
    }
    public function non_member_from_exchange_filter($currency_id)
    {
//        dd(Currency::all());
//        dd($currency_id);

        return $this->currency_filter($currency_id);
    }
    public function non_member_to_exchange_filter($currency_id)
    {
        return $this->to_currency_filter($currency_id);
    }
    public function total_currency_value(Request $request)
    {

//        return response()->json($request->all());
        $g=Group::whereId($request->id)->first();
        $group_note=DB::table('group_note')->where('group_id',$request->id)->pluck('note_id');
        if($g->currency_id===11)
        {
            return response()->json([
                'value'=>"Myanmar Kyat",
            ]);
        }
        else
        {
//            dd($request->id);
            $value=BuyGroupValue::where('group_id',$request->id)->latest()->first();
//            dd($value);
            return response()->json([
                'value'=>$value->value,
            ]);

        }

    }
    public function getGroupValue($group_id)
    {
        $value=BuyGroupValue::where('group_id',$group_id)->latest()->first();
        return $value->value;
    }
    public function non_member_store(Request $request )
    {
//        dd($request->all());
        $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
            $from_note_id=$request->from_note_id;
        $from_notes=$request->from_notes;
        $groups=array_unique($request->from_group);
        $in_total_value=0;
        $in_value=0;
        $from_note_array=array_combine($from_note_id,$from_notes);
        $from_group_notes=array_combine($from_note_id,$request->from_group);
        foreach($from_group_notes as $note=>$group)
        {
            $buy_value=BuyGroupValue::where('group_id',$group)->latest()->first();
            $gp=Group::whereId($group)->first();
            $group_note=DB::table('group_note')->where('group_id',$group)->first();
            $group_note_id[]=$group_note->id;
            foreach($from_note_array as $id=>$n)
            {
                $notes=Note::whereId($id)->first();
                if($id==$note)
                {
                    if($gp->currency_id===11)
                    {
//                        $buy_value->value=1;
                        $in_total_value+=($n*(int)$notes->name);
                    }
                    else{
                        $in_total_value+=($n*(int)$notes->name)*$buy_value->value;

                    }
                }
            }
        }
        foreach($from_note_array as $note_id=>$sheet)
        {

            $note=Note::whereId($note_id)->first();

            $in_value+=(int)$note->name*$sheet;
        }
        $to_note_id=$request->to_note_id;
        $to_notes=$request->to_notes;
        $out_total_value=0;
        $out_value=0;
        $to_note_array=array_combine($to_note_id,$to_notes);
        $to_group_notes=array_combine($to_note_id,$request->to_group);
        foreach($to_group_notes as $note=>$group)
        {
            $gp=Group::whereId($group)->first();
            $buy_value=BuyGroupValue::where('group_id',$group)->latest()->first();
            foreach($to_note_array as $id=>$n)
            {
                $notes=Note::whereId($id)->first();

                if($id===$note)
                {
                    if($gp->currency_id===11)
                    {
//                        $buy_value->value=1;
                        $out_total_value+=($n*(int)$notes->name);

                    }
                    else
                    {
                        $out_total_value+=($n*(int)$notes->name)*$buy_value->value;

                    }
                }
            }
        }
        foreach($to_note_array as $note_id=>$sheet)
        {
            $note=Note::whereId($note_id)->first();

            $out_value+=(int)$note->name*$sheet;
        }
        if($in_total_value>=$out_total_value)
        {
           $changes= $in_total_value-$out_total_value;
        }
        else{
            return response()->json('Not Enough!');
        }
        $check_branch=DB::table('branch_group_note')->where('branch_id',Auth::user()->branch_id)->get();

        $transaction=new Transaction();
        $transaction->in_value=$in_value;
        $transaction->in_value_MMK=$in_total_value;
        $transaction->out_value=$out_value;
        $transaction->out_value_MMK=$out_total_value;
        $transaction->changes=$changes;
        $transaction->date_time=Carbon::now();
        if(intval($request->from_currency)=== $myanmar_currency->id)
        {
            $transaction->status="MyanmarToOther";
        }
        elseif(intval($request->to_currency)=== $myanmar_currency->id)
        {
            $transaction->status="OtherToMyanmar";
        }
        else
            $transaction->status="OtherToOther";
        $transaction->staff_id=Auth::user()->id;
        $transaction->member_id=null;
        if($check_branch->isNotEmpty() && $request->from_currency != null && $request->to_currency != null){
            $transaction->save();

        }else{
            return redirect('stock')->with('error','Something Wrong!Try agian');
            dd('Empty sheet in this branch!Please try again');
        }
        $branch=Branch::with('branch_group_note')->whereId(Auth::user()->branch_id)->first();

        if(intval($request->from_currency) === $myanmar_currency->id)
        {
//            dd('same');
            foreach($from_group_notes as $note=>$group_id)
            {
//                    $group_note=DB::table('group_note')->where('group_id',$group_id)
//                    ->where('note_id',$note)
//                    ->first();
                $group_note=$this->getGroupNote($group_id,$note);
//                    dd($group_note);
//                $a[]=$group_note->id;
                $branch_group_note=$this->getBranchGroupNote($branch->id,$group_note->id);
//                    dd($branch_group_note->group_note_id);
//                    $id[]=$branch_group_note->group_note_id;
//                    dd($branch_group_note->id)
//                $branch_group_note=DB::table('branch_group_note')->where('branch_id',$branch->id)
//                    ->where('group_note_id',$group_note->id)
//                    ->first();
                foreach($from_note_array as $note_id=>$notes)
                {
                    if($note_id==$note && $notes!=null)
                    {
                        if($branch_group_note!= null)
                        {
                            $result=(intval($branch_group_note->sheet)+intval($notes));
                            $branch->branch_group_note()->wherePivot('branch_id',$branch->id)
                                ->wherePivot('group_note_id',$branch_group_note->group_note_id)->detach();
                            $branch->branch_group_note()->attach($branch->id,['group_note_id'=>$branch_group_note->group_note_id,'sheet'=>$result]);
                            $transaction->in_MMK_group_note()->attach($transaction->id,['group_note_id'=>$group_note->id,'sheet'=>$notes]);
                        }else{
                            dd('Empty notes in the branch');
                        }
                    }
                }
            }
//            dd($a);
        }
        elseif(intval($request->from_currency) !== $myanmar_currency->id) {
            foreach($from_group_notes as $note=>$group_id)
            {
//                dd('not equal');
                $group_note=$this->getGroupNote($group_id,$note);
//                dd($group_note);
                $branch_group_note=$this->getBranchGroupNote($branch->id,$group_note->id);
//                dd($branch_group_note->sheet);

//                $branch_group_note
                foreach($from_note_array as $note_id=>$notes)
                {
                    if($note_id == $note && $notes!=null)
                    {
//                        dd($notes);
//                        dd($branch_group_note->sheet);

                        $result=(intval($branch_group_note->sheet)+intval($notes));
                        $branch->branch_group_note()->wherePivot('branch_id',$branch->id)
                            ->wherePivot('group_note_id',$group_note->id)->detach();
                        $branch->branch_group_note()->attach($transaction->id,['group_note_id'=>$group_note->id,'sheet'=>$result]);
                        $buy_value=BuyGroupValue::where('group_id',$group_note->group_id)->latest()->first();
                        $transaction->in_transaction_group_note()->attach($transaction->id,['group_note_id'=>$group_note->id,'buy_group_value_id'=>$buy_value->id,'sheet'=>$notes]);
                    }
                }
            }
        }


//        dd($b);
        if(intval($request->to_currency) === $myanmar_currency->id ){
//            dd('aaa');
            foreach($to_group_notes as $note_id=>$group_id)
            {
                $sell_group_note=$this->getGroupNote($group_id,$note_id);
                $branch_group_note=$this->getBranchGroupNote($branch->id,$sell_group_note->id);
                foreach($to_note_array as $id=>$value)
                {
                    if($note_id == $id && $value !=null)
                    {
//                        dd($value);
//                        dd($branch_group_note->sheet);
                        if(intval($branch_group_note->sheet)>=intval($value))
                        {
                            $result=intval($branch_group_note->sheet)-intval($value);
//                            dd($result);
                            $branch->branch_group_note()->wherePivot('branch_id',$branch->id)
                                ->wherePivot('group_note_id',$sell_group_note->id)->detach();
                            $branch->branch_group_note()->attach($transaction->id,['group_note_id'=>$sell_group_note->id,'sheet'=>$result]);
                            $transaction->out_MMK_group_note()->attach($transaction->id,['group_note_id'=>$sell_group_note->id,'sheet'=>$value]);
                        }else{
                            dd('Not enough to exchange currency in this branch');

                        }


                    }
                }

            }
        }

        else {
            foreach($to_group_notes as $note_id=>$group_id)
            {
                $sell_group_note=$this->getGroupNote($group_id,$note_id);
                $branch_group_note=$this->getBranchGroupNote($branch->id,$sell_group_note->id);
                foreach($to_note_array as $id=>$value)
                {
                    if($note_id == $id && $value !=null)
                    {
                        if(intval($branch_group_note->sheet)>=intval($value))
                        {
                            $r=intval($branch_group_note->sheet)-intval($value);
                            $branch->branch_group_note()->wherePivot('branch_id',$branch->id)
                                ->wherePivot('group_note_id',$sell_group_note->id)->detach();
                            $branch->branch_group_note()->attach($branch->id,['group_note_id'=>$sell_group_note->id,'sheet'=>$r]);
                            $sell_value=SellGroupValue::where('group_id',$sell_group_note->group_id)->latest()->first();
                            $transaction->out_transaction_group_note()->attach($transaction->id,['group_note_id'=>$sell_group_note->id,'sell_group_value_id'=>$sell_value->id,'sheet'=>$value]);
                        }else{
                            dd('Not enough to exchange currency in this branch');
                        }


                    }
                }
            }
        }

        return redirect('sale');

    }
    protected function getGroupNote($group_id,$note_id){
        $group_note=DB::table('group_note')->where('group_id',$group_id)
            ->Where('note_id',$note_id)
            ->first();
        return $group_note;
    }
    public function getBranchGroupNote($branch_id,$group_note_id){
        $branch_group_note=DB::table('branch_group_note')->where('branch_id',$branch_id)
            ->where('group_note_id',$group_note_id)
            ->first();
//        $a[]=$branch_group_note->group_note_id;
//        dd($branch_group_note);
        return $branch_group_note;
    }

}
