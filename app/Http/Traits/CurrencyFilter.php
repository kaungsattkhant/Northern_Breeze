<?php


namespace App\Http\Traits;


use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\Currency;
use App\Model\Group;
use App\Model\Note;
use Illuminate\Support\Facades\Auth;
use DB;

trait CurrencyFilter
{
    public function currency_filter($currency_id)
    {
        $us_currency=Currency::where('name','United States dollar')->first();
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        $stock_notes=array();
        $total=0;
        $branch_id = Auth::user()->branch_id ? Auth::user()->branch_id : null;
            foreach($groups as $group)
        {
            $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
            foreach ($note_id as $id)
            {
                $note=Note::whereId($id)->get();

                foreach ($note as $n)
                {
                    $group_note_id=DB::table('group_note')
                        ->where('note_id',$n->id)
                        ->where('group_id',$group->id)
                        ->pluck('id');
                    $g[]=$group_note_id[0];
                    $buying_value=BuyGroupValue::where('group_id',$group->id)
                        ->orderBy('date_time','DESC')
                        ->first();

                    $n->group_id=$group->id;

//                    if($buying_value!=null)
//                    {
                        $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                            ->where('branch_id',$branch_id)
                            ->sum('sheet');
//                        $n->group_id=$group->id;
//                        $n->total_sheet=$total_sheet;
//                        $total+=intval($total_sheet)*$buying_value->value;
                        array_push($stock_notes,$n);
//                    }
//

                }
            }
        }
//        dd($group);
        asort($stock_notes);
        if($stock_notes == null)
        {
            $data="<i style='color: red;'>First,need to establish notes as group in currency.Try again!</i>";
        }
//        else{
//            if(intval($currency_id) === $us_currency->id)
//            {
//                $classification=Classification::all();
//                $data=view('Member.non_member_us_exchange_filter',compact('stock_notes','total','classification'));
//            }
//            else
//            {
//                $data=view('Member.pos_non_member_from_exchange_filter',compact('stock_notes','total'));
//
//
//            }
//        }
//        dd($stock_notes);
         return $stock_notes;
    }
}
