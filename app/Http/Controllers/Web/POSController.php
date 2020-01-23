<?php

namespace App\Http\Controllers\Web;

use App\Http\Traits\CurrencyFilter;
use App\Http\Traits\ToExchangeFilter;
use App\Model\Branch;
use App\Model\BuyClassGroupValue;
use App\Model\BuyGroupValue;
//use http\Exception\BadUrlException;
use App\Model\Classification;
use App\Model\ClassValue;
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

    public function currency_group(Request $request)
    {
//        dd($request->currency_id);

        if ($request->currency_id===12) {
            $results = json_decode(file_get_contents(public_path().'/mm_currency_group.json'));
            return response()->json([
                'results'=> $results
            ]);
        }

        if($request->currency_id===23) {
            $results = json_decode( file_get_contents(public_path().'/us_currency_group.json'));
            return response()->json([
                'results'=> $results
            ]);
        } else{
            $results = json_decode( file_get_contents(public_path().'/currency_group.json'));
            return response()->json([
                'results'=> $results
            ]);
        }

    }

    public function currency_results(Request $request)
    {
//        dd(json_encode($request->all()) );
        return response()->json([
            'is_success' => true
        ]);
    }

    public function pos_member()
    {
        $currencies  = Currency::all();
        return view('Member.pos_member',compact('currencies'));
    }
    public function pos_non_member()
    {
        $currencies  = Currency::all();
        return view('Member.non_member',compact('currencies'));
    }
    public function non_member_from_exchange_filter($currency_id)

    {
        $classification=Classification::all('id','name');
        $us_currency_id=Currency::where('name','United States dollar')->first();
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        $branch_id = Auth::user()->branch_id ? Auth::user()->branch_id : 1;
        foreach($groups as $key=>$group){
            $new[$key]=new \stdClass();
            $new[$key]->group_id=$group->id;
            $new[$key]->group_name=$group->name;

            $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
            foreach ($note_id as $i=>$id)
            {
                $note=Note::whereId($id)->first();
                $group_note_id=DB::table('group_note')
                    ->where('note_id',$id)
                    ->where('group_id',$group->id)
                    ->first();
//                $a[]=$group_note_id-
                $notes[$key][$i]=new \stdClass();
                $notes[$key][$i]->group_note_id=$group_note_id->id;
                  $notes[$key][$i]->note_name=$note->name;
                if($us_currency_id->id == $currency_id) {
                    $class_total_sheet=0;
                    foreach($classification as $bc=>$class){
                        $class_sheet[$bc]=new \stdClass();

                        $branch_class_sheet=DB::table('branch_group_note_class')
                            ->where('branch_id',$branch_id)
                            ->where('class_id',$class->id)
                            ->where('group_note_id',$group_note_id->id)->first();
                        if($branch_class_sheet==null){
                            $class_sheet[$bc]->class_id=$class->id;
                            $class_sheet[$bc]->sheet=0;
                        }else{
                            $class_sheet[$bc]->class_id=$branch_class_sheet->class_id;
                            $class_sheet[$bc]->sheet=$branch_class_sheet->sheet;
                        }
                        $class_total_sheet+=(int)$class_sheet[$bc]->sheet;
                    }
                    $notes[$key][$i]->class_sheet=$class_sheet;
                    $notes[$key][$i]->total_sheet=$class_total_sheet;

                }else{
                    $total_sheet = DB::table('branch_group_note')->where('group_note_id', $group_note_id->id)
                        ->where('branch_id', $branch_id)
                        ->sum('sheet');
                    $notes[$key][$i]->total_sheet = $total_sheet;
                }
            }
            if($us_currency_id->id == $currency_id) {
                foreach($classification as $c=>$class){
                    $classification_group_id = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                        ->where('classification_id', $class->id)->first();
                    $buy_class_value= BuyClassGroupValue::where('classification_group_id', $classification_group_id->id)
                        ->latest()
                        ->first();
                    $currency_value[]=new \stdClass();
                    $currency_value[$c]->id=$buy_class_value->id;
                    $currency_value[$c]->class_id=$class->id;
                    $currency_value[$c]->value=$buy_class_value->value;
                }
                $new[$key]->class_currency_value=$currency_value;
                $new[$key]->currency_value=null;

            }else{
                $currency_value=new \stdClass();
                $group_currency_value=BuyGroupValue::where('group_id',$group->id)->latest()->first();
                $currency_value->id=$group_currency_value->id;
                $currency_value->value=$group_currency_value->value;
                $new[$key]->currency_value=$currency_value;
                $new[$key]->class_currency_value=null;


            }
        }
        foreach($new as $k=>$n){
            $new[$k]->notes=$notes[$k];
        }
//        dd($new);
        return response()->json([
                'class'=>$classification,
                'group'=>
                    $new,
            ]);
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
        if($g->currency_id === 11)
        {
            return response()->json([
                'value'=>"Myanmar Kyat",
            ]);
        }
        else
        {
            $value=BuyGroupValue::where('group_id',$request->id)->latest()->first();
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
        dd($request->all());
        $b=array_unique($request->from_classification_id);
//        $from_group_notes = array_combine($from_note_id, $request->from_group);
        $from_class_note=array_unique($request->from_class_note_id);
        $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
        $us_currency=Currency::where('name','United States dollar')->first();
        $in_total_value=0;
        $out_total_value=0;
        $in_value=0;
        $out_value=0;

        if($request->from_currency == $us_currency->id)
        {
//            dd('a');
            $from_class_group_id=$request->from_class_group_id;
            $from_class_note_id=$request->from_class_note_id;
            $from_classification=$request->from_classification;
            $class_note_group=array_combine($request->from_class_note_id,$request->from_class_group_id);
//            dd($class_note_group);
            foreach($request->from_note_id as $note_id)
            {
                $classification_values[]=array_combine($b,$request->input('from_classification'.'_'.$note_id));
            }
            $classification_value=array_combine($from_class_note,$classification_values);
//            dd($classification_value);
            foreach($classification_value as $key=>$values){
                foreach($values as $sheet){
                    $in_value +=(int)$key * (int)$sheet;
                }

            }
//            dd($in_value);
            foreach($class_note_group as $note=>$group)
            {
//                dd($note);
                foreach($classification_value as $key=>$values){
//                    $key=note_id
                    if($key== $note){
                        foreach($values as $class_id=>$sheet){
//                        dd($sheet);
                            $a[]=$sheet;
                            $class_group=DB::table('classification_group')->where('group_id',$group)
                                ->where('classification_id',$class_id)->first();
//                        dd($class_id);
                            $class_value=ClassValue::where('classification_group_id',$class_group->id)->latest('date_time')->first();
                        $in_total_value +=((int)$note * $sheet)*$class_value->value;
//                        dd($in_value);
                        }
                    }


                }
            }
//            dd($in_total_value);

        }

        else {
//            **************************start in value for other currency8*********************
            $from_note_id = $request->from_note_id;
            $from_notes = $request->from_notes;
            $groups = array_unique($request->from_group);
            $in_total_value = 0;
            $in_value = 0;
            $from_note_array = array_combine($from_note_id, $from_notes);
            $from_group_notes = array_combine($from_note_id, $request->from_group);
            foreach ($from_group_notes as $note => $group) {
                $buy_value = BuyGroupValue::where('group_id', $group)->latest()->first();
//            dd($buy_value);
                $gp = Group::whereId($group)->first();
                $group_note = DB::table('group_note')->where('group_id', $group)->first();
                $group_note_id[] = $group_note->id;
                foreach ($from_note_array as $id => $n) {
                    $notes = Note::whereId($id)->first();
                    if ($id == $note) {
                        if ($gp->currency_id === $myanmar_currency->id) {
//                        $buy_value->value=1;
                            $in_total_value += ($n * (int)$notes->name);
                        } else {
                            $in_total_value += ($n * (int)$notes->name) * $buy_value->value;

                        }
                    }
                }
            }

            foreach ($from_note_array as $note_id => $sheet) {
                $note = Note::whereId($note_id)->first();
                $in_value += (int)$note->name * $sheet;
            }
        }

//            ****************************end in value for other currency*******************
//        *******************start us currency exchange **********************************
        if($request->to_currency==$us_currency->id)
        {
//            dd($request->all());
            $to_class_note=array_unique($request->to_class_note_id);
            $to_class_group_id=$request->to_class_group_id;
            $to_class_note_id=$request->to_class_note_id;
            $from_classification=$request->to_classification;
            $to_class_note_group=array_combine($request->to_class_note_id,$request->to_class_group_id);
//            dd($class_note_group);
            foreach($request->to_note_id as $note_id)
            {
                $to_classification_values[]=array_combine($b,$request->input('from_classification'.'_'.$note_id));
            }
            $to_classification_value=array_combine($from_class_note,$to_classification_values);
//            dd($classification_value);
            foreach($to_classification_value as $key=>$values){
                foreach($values as $sheet){
                    $out_value +=(int)$key * (int)$sheet;
                }

            }
//            dd($in_value);
            foreach($to_class_note_group as $note=>$group)
            {
//                dd($note);
                foreach($to_classification_value as $key=>$values){
//                    $key=note_id
                    if($key== $note){
                        foreach($values as $class_id=>$sheet){
//                        dd($sheet);
                            $a[]=$sheet;
                            $to_class_group=DB::table('classification_group')->where('group_id',$group)
                                ->where('classification_id',$class_id)->first();
//                        dd($class_id);
                            $to_class_value=ClassValue::where('classification_group_id',$to_class_group->id)->latest('date_time')->first();
                            $out_total_value +=((int)$note * $sheet)*$to_class_value->value;
//                        dd($in_value);
                        }
                    }


                }
            }

        }
//            ****************************start out value for  other currency ******************
        else{
            $to_note_id = $request->to_note_id;
            $to_notes = $request->to_notes;
            $out_total_value = 0;
            $out_value = 0;
            $to_note_array =    array_combine($to_note_id, $to_notes);
            $to_group_notes = array_combine($to_note_id, $request->to_group);
            foreach ($to_group_notes as $note => $group) {
                $gp = Group::whereId($group)->first();
                $buy_value = BuyGroupValue::where('group_id', $group)->latest()->first();
                foreach ($to_note_array as $id => $n) {
                    $notes = Note::whereId($id)->first();

                    if ($id === $note) {
                        if ($gp->currency_id === $myanmar_currency->id) {
//                        $buy_value->value=1;
                            $out_total_value += ($n * (int)$notes->name);

                        } else {
                            $out_total_value += ($n * (int)$notes->name) * $buy_value->value;

                        }
                    }
                }
            }
            foreach ($to_note_array as $note_id => $sheet) {
                $note = Note::whereId($note_id)->first();

                $out_value += (int)$note->name * $sheet;
            }
        }
//            **************end out value for other currency**************************
            if ($in_total_value >= $out_total_value) {
                $changes = $in_total_value - $out_total_value;
            } else {
                return response()->json('Not Enough!');
            }
            $check_branch = DB::table('branch_group_note')->where('branch_id', Auth::user()->branch_id)->get();
//            dd($in_value);
            $transaction = new Transaction();
            $transaction->in_value = $in_value;
            $transaction->in_value_MMK = $in_total_value;
            $transaction->out_value = $out_value;
            $transaction->out_value_MMK = $out_total_value;
            $transaction->changes = $changes;
            $transaction->date_time = Carbon::now();
            if (intval($request->from_currency) === $myanmar_currency->id) {
                $transaction->status = "MyanmarToOther";
            } elseif (intval($request->to_currency) === $myanmar_currency->id) {
                $transaction->status = "OtherToMyanmar";
            } else
                $transaction->status = "OtherToOther";
            $transaction->staff_id = Auth::user()->id;
            $transaction->member_id = null;
            if ($check_branch->isNotEmpty() && $request->from_currency != null && $request->to_currency != null) {
                $transaction->save();

            } else {
                return redirect('stock')->with('error', 'Something Wrong!Try agian');
                dd('Empty sheet in this branch!Please try again');
            }
            $branch = Branch::with('branch_group_note')->whereId(Auth::user()->branch_id)->first();

            if (intval($request->from_currency) === $myanmar_currency->id) {
                foreach ($from_group_notes as $note => $group_id) {
//                    $group_note=DB::table('group_note')->where('group_id',$group_id)
//                    ->where('note_id',$note)
//                    ->first();
                    $group_note = $this->getGroupNote($group_id, $note);
//                    dd($group_note);
//                $a[]=$group_note->id;
                    $branch_group_note = $this->getBranchGroupNote($branch->id, $group_note->id);
//                    dd($branch_group_note->group_note_id);
//                    $id[]=$branch_group_note->group_note_id;
//                    dd($branch_group_note->id)
//                $branch_group_note=DB::table('branch_group_note')->where('branch_id',$branch->id)
//                    ->where('group_note_id',$group_note->id)
//                    ->first();
                    foreach ($from_note_array as $note_id => $notes) {
                        if ($note_id == $note && $notes != null) {
                            if ($branch_group_note != null) {
                                $result = (intval($branch_group_note->sheet) + intval($notes));
                                $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                    ->wherePivot('group_note_id', $branch_group_note->group_note_id)->detach();
                                $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $branch_group_note->group_note_id, 'sheet' => $result]);
                                $transaction->in_MMK_group_note()->attach($transaction->id, ['group_note_id' => $group_note->id, 'sheet' => $notes]);
                            } else {
                                dd('Empty notes in the branch');
                            }
                        }
                    }
                }
            }
//            elseif (intval($request->from_currency) !== $myanmar_currency->id) {
//                foreach ($from_group_notes as $note => $group_id) {
////                dd('not equal');
//                    $group_note = $this->getGroupNote($group_id, $note);
////                dd($group_note);
//                    $branch_group_note = $this->getBranchGroupNote($branch->id, $group_note->id);
////                dd($branch_group_note->sheet);
//
////                $branch_group_note
//                    foreach ($from_note_array as $note_id => $notes) {
//                        if ($note_id == $note && $notes != null) {
////                        dd($notes);
////                        dd($branch_group_note->sheet);
//
//                            $result = (intval($branch_group_note->sheet) + intval($notes));
//                            $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                ->wherePivot('group_note_id', $group_note->id)->detach();
//                            $branch->branch_group_note()->attach($transaction->id, ['group_note_id' => $group_note->id, 'sheet' => $result]);
//                            $buy_value = BuyGroupValue::where('group_id', $group_note->group_id)->latest()->first();
//                            $transaction->in_transaction_group_note()->attach($transaction->id, ['group_note_id' => $group_note->id, 'buy_group_value_id' => $buy_value->id, 'sheet' => $notes]);
//                        }
//                    }
//                }
//            }


//        dd($b);
            if (intval($request->to_currency) === $myanmar_currency->id) {
                foreach ($to_group_notes as $note_id => $group_id) {
                    $sell_group_note = $this->getGroupNote($group_id, $note_id);
                    $branch_group_note = $this->getBranchGroupNote($branch->id, $sell_group_note->id);
                    foreach ($to_note_array as $id => $value) {
                        if ($note_id == $id && $value != null) {
//                        dd($value);
//                        dd($branch_group_note->sheet);
                            if (intval($branch_group_note->sheet) >= intval($value)) {
                                $result = intval($branch_group_note->sheet) - intval($value);
//                            dd($result);
                                $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                    ->wherePivot('group_note_id', $sell_group_note->id)->detach();
                                $branch->branch_group_note()->attach($transaction->id, ['group_note_id' => $sell_group_note->id, 'sheet' => $result]);
                                $transaction->out_MMK_group_note()->attach($transaction->id, ['group_note_id' => $sell_group_note->id, 'sheet' => $value]);
                            } else {
                                dd('Not enough to exchange currency in this branch');

                            }


                        }
                    }

                }
            }
//            else {
//                foreach ($to_group_notes as $note_id => $group_id) {
//                    $sell_group_note = $this->getGroupNote($group_id, $note_id);
//                    $branch_group_note = $this->getBranchGroupNote($branch->id, $sell_group_note->id);
//                    foreach ($to_note_array as $id => $value) {
//                        if ($note_id == $id && $value != null) {
//                            if (intval($branch_group_note->sheet) >= intval($value)) {
//                                $r = intval($branch_group_note->sheet) - intval($value);
//                                $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                    ->wherePivot('group_note_id', $sell_group_note->id)->detach();
//                                $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $sell_group_note->id, 'sheet' => $r]);
//                                $sell_value = SellGroupValue::where('group_id', $sell_group_note->group_id)->latest()->first();
//                                $transaction->out_transaction_group_note()->attach($transaction->id, ['group_note_id' => $sell_group_note->id, 'sell_group_value_id' => $sell_value->id, 'sheet' => $value]);
//                            } else {
//                                dd('Not enough to exchange currency in this branch');
//                            }
//
//
//                        }
//                    }
//                }
//            }

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
