<?php

namespace App\Http\Controllers\Web;
use App\Http\Requests\StockInventoryCreateValidation;
use App\Model\Branch;
use App\Model\BuyGroupValue;
use App\Model\Group;
use App\Model\GroupNote;
use App\Model\Note;
use App\Model\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {

        $branches=Branch::all();
        $branch_id=Auth::user()->branch->id;
        $transfers=Transfer::with('currency','group_note')
            ->where('from_branch_id',$branch_id)
            ->orWhere('to_branch_id',$branch_id)
            ->whereDate('date_time',Carbon::today())
            ->orderBy('id','desc')
            ->paginate(10);
        if($transfers->isNotEmpty())
        {
            foreach($transfers as $transfer)
            {

                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                {
                    $transfer->transfer_status="Add";
                }
                elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
                {
                    $transfer->transfer_status="In";
                }
                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
                    $transfer->transfer_status="Out";

                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);;

            }
            return view('Stock.stock_inventory',compact('branches','transfers'));

        }
        return view('Stock.stock_inventory',compact('branches','transfers'));

//        return 'Not Transfer Today';

    }

    public function create()
    {
        return view('Stock.add');
    }
    public function transfer()
    {

    }
    public function currency_filter($id)
    {
        $groups=Group::with('notes')->where('currency_id',$id)->get();
        $stock_notes=array();
        $total=0;
        $branch_id=Auth::user()->branch->id;

        foreach($groups as $group)
        {
            $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
            foreach ($note_id as $id)
            {
                $note=Note::whereId($id)->get();
                foreach ($note as $n)
                {
//                    dd($n->id);
                    $group_note_id=DB::table('group_note')->where('note_id',$n->id)
                        ->where('group_id',$group->id)
                        ->pluck('id');
                    $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                        ->where('branch_id',$branch_id)
                        ->sum('sheet');
//                    dd($total_sheet);
                    $n->group_id=$group->id;
                    $n->total_sheet=$total_sheet;
                    $total+=$total_sheet;
                    array_push($stock_notes,$n);
                }
            }
        }
        asort($stock_notes);

        $data=view('Stock.stock_currency_filter',compact('stock_notes','total'));
        return $data;
    }
    public function stock_transfer()
    {
        return view('Stock.transfer');
    }
//    public function store(Request $request)
//    {
//        dd(Auth::user()->branch->id);
//
//        dd('success');
//    }
    public function store(StockInventoryCreateValidation $request)
    {
        $vData=$request->validated();
        $branch_id=Auth::user()->branch->id;
        $transfer=new Transfer();
        $transfer->from_branch_id=$branch_id;
        $transfer->currency_id=$request->currency;
        $request->branch != null ? $transfer->to_branch_id=$request->branch : $transfer->to_branch_id=$branch_id;
        $transfer->date_time=now();
        $transfer->save();
        $groups=array_unique($request->group);
        $note_id=$request->note_id;
        $notes=$request->notes;
        $note_array=array_combine($note_id,$notes);
//        if($request->branch)
//        {
//            $to_branch=Branch::find($request->branch);
//        }
             $branch=Branch::find($branch_id);

        foreach($groups as $group)
        {
            foreach($note_array as $id=>$value)
            {
                if($value==null)
                {
                    $value=0;
                }
                $group_note=GroupNote::where('note_id',$id)
                    ->where('group_id',$group)
                    ->pluck('id');
                if(isset($group_note[0]))
                {
                    $transfer->group_note()->attach($group_note[0],['sheet'=>$value]);
                    $branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note[0])
                        ->where('branch_id',$branch_id)
                        ->pluck('sheet');
                    if( $request->branch==null)
                    {


                        if($branch_note->isEmpty())
                        {
                            $branch_note[0]=0;
                            $result=$branch_note[0]+intval($value);
                        }
                        else
                        {
                            $result=$branch_note[0]+intval($value);
                        }

                            $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        $branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);

                    }
                    elseif( isset($branch_note[0]) && $request->branch != null)
                    {

                        if($branch_note[0]<intval($value))
                        {
                            return 'Not Enough';
                        }
                        else
                        {
                            $result=$branch_note[0]-intval($value);
                            $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        }

                        if($request->branch)
                        {
                            $to_branch=$this->to_branch_store($request->branch,$group_note[0],$value);

                        }

                        $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        $branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);

                    }
                }

            }

        }
        return  redirect('stock');


    }
    public function stock_detail($transfer_id)
    {
        $transfers=Transfer::whereId($transfer_id)->first();
        $total_transfer_value=$this->total_transfer_value($transfer_id);
        foreach($transfers as $transfer)
        {
            $group_note_transfer=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
//            dd($group_note_transfer);
            foreach($group_note_transfer as $gnt)
            {
                $group_note=DB::table('group_note')->whereId($gnt->group_note_id)->first();
                $sheet[]=$gnt->sheet;
                $notes=Note::whereId($group_note->note_id)->first();
                $note[]=$notes->name;
            }
            $transfer_note=array_filter(array_combine($note,$sheet));
        }
        $data=view('Stock.detail_view',compact('transfers','transfer_note','total_transfer_value'));
        return $data;
    }
    public function total_transfer_value($transfer_id)
    {
        $total_value=0;
        $group_note_transfer=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
        foreach($group_note_transfer as $gnt)
        {
            $group_note=GroupNote::whereId($gnt->group_note_id)->first();
            $value=BuyGroupValue::where('group_id',$group_note->group_id)
                ->orderBy('date_time','DESC')
                ->first();
            if($value != null)
            {
                $total_value+=$value->value*$gnt->sheet;
            }
        }
        return $total_value;
    }
    public function to_branch_store($to_branch_id,$group_note_id,$value)
    {
        $to_branch=Branch::find($to_branch_id);
        $to_branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note_id)
            ->where('branch_id',$to_branch_id)
            ->pluck('sheet');

        if($to_branch_note->isNotEmpty())
        {
            $to_result=$to_branch_note[0]+intval($value);
            $to_branch->branch_group_note()->wherePivot('group_note_id',$group_note_id)->detach();
            $to_branch->branch_group_note()->attach($group_note_id,['sheet'=>$to_result]);

        }
        elseif($to_branch_note->isEmpty()   )
        {
            $to_branch_note[0]=0;
            $to_result=$to_branch_note[0]+intval($value);
            $to_branch->branch_group_note()->attach($group_note_id,['sheet'=> $to_result]);
        }
    }
}
