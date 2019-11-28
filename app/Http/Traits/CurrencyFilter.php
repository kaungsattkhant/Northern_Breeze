<?php


namespace App\Http\Traits;


use App\Model\BuyGroupValue;
use App\Model\Group;
use App\Model\Note;
use Illuminate\Support\Facades\Auth;
use DB;

trait CurrencyFilter
{
    public function currency_filter($id)
    {
        $groups=Group::with('notes')->where('currency_id',$id)->get();
        $stock_notes=array();
        $total=0;
        $branch_id=Auth::user()->branch_id;

        foreach($groups as $group)
        {
            $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
            foreach ($note_id as $id)
            {
                $note=Note::whereId($id)->get();
                foreach ($note as $n)
                {
                    $group_note_id=DB::table('group_note')
//                        ->orderBy('id','asc')
                        ->where('note_id',$n->id)
                        ->where('group_id',$group->id)
                        ->pluck('id');
                    $g[]=$group_note_id[0];
                    $buying_value=BuyGroupValue::where('group_id',$group->id)
                        ->orderBy('date_time','DESC')
                        ->first();
//                    dd($buying_value);
                    if($buying_value!=null)
                    {
                        $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                            ->where('branch_id',$branch_id)
                            ->sum('sheet');
                        $n->group_id=$group->id;
                        $n->total_sheet=$total_sheet;
                        $total+=intval($total_sheet)*$buying_value->value;
                        array_push($stock_notes,$n);
                    }
                    else
                    {
                        return 'Empty buying value for this currency';

                    }



                }
            }
//            dd($g);
        }
//        dd($total);
        asort($stock_notes);

        $data=view('Member.pos_non_member_to_exchange_filter',compact('stock_notes','total'));
        return $data;
    }
}
