<?php

namespace App\Http\Controllers\Web;
use App\Http\Requests\StockInventoryCreateValidation;
use App\Model\Branch;
use App\Model\Group;
use App\Model\GroupNote;
use App\Model\Note;
use App\Model\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        return view('Stock.stock_inventory');
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
//                    dd($total_sheet[0]);
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
//        dd($stock_notes);

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
//        dd($request->all());
        $vData=$request->validated();
        dd($vData->errors());

//        if($vData->fails())
//        {
//        }
        $branch_id=Auth::user()->branch->id;
        $transfer=new Transfer();
        $transfer->from_branch_id=$branch_id;
        $request->branch != null ? $transfer->to_branch_id=$request->branch : $transfer->to_branch_id=null;
        $transfer->date_time=now();
        $transfer->save();
        $groups=array_unique($request->group);
        $note_id=$request->note_id;
        $notes=$request->notes;
        $note_array=array_combine($note_id,$notes);
        if($request->branch)
        {
            $branch=Branch::find($request->branch);

        }
         else
             $branch=Branch::find($branch_id);

        foreach($groups as $group)
        {
            foreach($note_array as $id=>$value)
            {
//                dd($value);
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
//                        ->where('branch_id',$branch_id)
                        ->pluck('sheet');
                    if($branch_note->isNotEmpty() && $request->branch ==null)
                    {
//
                        $value=$branch_note[0]+intval($value);
                        $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();

                    }
                    elseif($request->branch !=null && $branch_note->isNotEmpty())
                    {
                        if($branch_note[0]<intval($value))
                        {
                            return 'Not Enough';
                        }
                        else
                        {
                            $value=$branch_note[0]-intval($value);
                            $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        }

                    }
                    $branch->branch_group_note()->attach($group_note[0],['sheet'=>$value]);
                }

            }

        }
        return  redirect('stock');


    }
}
