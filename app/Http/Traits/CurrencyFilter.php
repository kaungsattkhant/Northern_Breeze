<?php


namespace App\Http\Traits;


use App\Model\BuyClassGroupValue;
use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\Currency;
use App\Model\Group;
use App\Model\Note;
use Illuminate\Support\Facades\Auth;
use DB;

trait CurrencyFilter
{
//    public function currency_filter($id)
//    {
        public function currency_filter($currency_id,$branch_id)
    {
//        $currency_id=$;
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        $currency=Currency::find($currency_id);
        $stock_notes=array();
        $total=0;
//        $total_sheet_per_class=0;
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
                    if($currency->name==="Myanmar Kyat")
                    {
                        $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                            ->where('branch_id',$branch_id)
                            ->sum('sheet');
                        $n->group_id=$group->id;
                        $n->total_sheet=$total_sheet;
                        $total+=intval($total_sheet);
                        array_push($stock_notes,$n);
                    }
//                    elseif($currency->name==="United States dollar"){
//                        dd('a');
//                    }
                    else{
//                        dd($group->id);
                        $us_currency_id=Currency::where('name','United States dollar')->first();
                        if($us_currency_id->id == $currency_id) {
                            $classification_group = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                                ->where('classification_id', 1)->first();
                            $buying_value = BuyClassGroupValue::where('classification_group_id', $classification_group->id)
                                ->orderBy('date_time', 'DESC')
                                ->first();
                            $total_sheet_per_class=0;
                            foreach(Classification::all() as $c){
                                $class_sheet=DB::table('branch_group_note_class')->where('group_note_id',$group_note_id[0])
                                    ->where('branch_id',$branch_id)
                                    ->where('class_id',$c->id)
                                    ->first();
                                $total_sheet_per_class+=$class_sheet->sheet;
                            }
                            $n->total_sheet=$total_sheet_per_class;
                        }else{
                            $buying_value=BuyGroupValue::where('group_id',$group->id)
                                ->orderBy('date_time','DESC')
                                ->first();
                            $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                                ->where('branch_id',$branch_id)
                                ->sum('sheet');
                            $n->total_sheet=$total_sheet;
                        }

//                    dd($buying_value);
//                        if($buying_value!=null )
//                        {

                        $n->group_id=$group->id;
                        $n->daily_value=$buying_value->value;
//                            $total+=intval($total_sheet)*$buying_value->value;
                        array_push($stock_notes,$n);
//                        }
//                        else
//                        {
//                            return 'Empty buying value for this currency';
//
//                        }

                    }

                }
            }
        }
        asort($stock_notes);
        $c=collect($stock_notes);
        $stock_notes=$c->groupBy('group_id');
//        dd($stock_notes);
        $data=view('Stock.stock_currency_filter',compact('stock_notes','total','currency_id'));
        return $data;
    }

//        dd($stock_notes);
//        $data=view('Stock.stock_currency_filter',compact('stock_notes','total','currency_id'));
//        return $data;
//    }
}
