<?php

namespace App\Http\Controllers\Web;

use App\Http\Traits\CurrencyFilter;
use App\Http\Traits\ToExchangeFilter;
use App\Model\Member;
use App\Model\BuyCustomClassGroupValue;
use App\Model\ClassificationGroup;
use App\Model\MemberType;
use App\Model\OutTransactionGroupNote;
use App\Model\Branch;
use App\Model\BuyClassGroupValue;
use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\ClassValue;
use App\Model\Currency;
use App\Model\Group;
use App\Model\Note;
use App\Model\SellClassGroupValue;
use App\Model\SellCustomClassGroupValue;
//use App\Model\SellGroupValue;
use App\Model\Transaction;
use App\Model\InTransactionGroupNote;
use Carbon\Carbon;
use Carbon\Exceptions\BadUnitException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use App\Http\Traits\MemberPoint;
use App\Http\Traits\MemberPointYear;


class POSController extends Controller
{
    use MemberPoint;
    use MemberPointYear;



    public function pos_member()
    {
        $this->member_point_year();
        $currencies  = Currency::all();
        return view('Member.pos_member',compact('currencies'));
    }
    public function pos_non_member()
    {
        $this->member_point_year();

        $currencies  = Currency::all();
        return view('Member.non_member',compact('currencies'));
    }
    public function getMember(Request $request){
        $member=Member::with('member_type')->whereId($request->search)->get();
        return $member;
    }
    public function currency_group(Request $request){

        $currency_id=$request->currency_id;
        $classification=Classification::orderBy('id','asc')->get('id','name');
        $us_currency_id=Currency::where('name','United States dollar')->first();
        $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        if($currency_id==$myanmar_currency->id){
            $status="MMK";
        }elseif($currency_id==$us_currency_id->id) {
            $status="other";
        }else{
            $status="other";
        }
        $branch_id =Auth::user()->branch_id ;
        if($groups->isNotEmpty()){
            foreach($groups as $key=>$group){
                $new[$key]=new \stdClass();
                $new[$key]->group_id=$group->id;
                $new[$key]->group_name=$group->name;

                $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
                foreach ($note_id as $i=>$id)
                {
//                    dd($id);
                    $note=Note::whereId($id)->first();
//                    dd($note);
                    $group_note_id=DB::table('group_note')
                        ->where('note_id',$id)
                        ->where('group_id',$group->id)
                        ->first();
                    $notes[$key][$i]=new \stdClass();
                    $notes[$key][$i]->group_note_id=$group_note_id->id;
                    $notes[$key][$i]->note_name=$note->name;
                    $total_sheet=0;

                    if($currency_id==$myanmar_currency->id){
//                        dd('aa');
                        $bgn=DB::table('branch_group_note')->where('branch_id',$branch_id)
                            ->where('group_note_id',$group_note_id->id)->first();
                        if($bgn==null){
                            $total_sheet=0;
                        }else{
                            $total_sheet+=(int)$bgn->sheet;
                        }
                        $class_sheet=null;
                    }else{
                        foreach($classification as $bc=>$class){
//                            $class_sheet[$bc]=new \stdClass();

                            $branch_class_sheet=DB::table('branch_group_note_class')
                                ->where('branch_id',$branch_id)
                                ->where('class_id',$class->id)
                                ->where('group_note_id',$group_note_id->id)->first();
                            $cg_id = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                                ->where('classification_id', $class->id)->first();
//                            $aaaaa[] = $cg_id;
                            if($cg_id !=null ){
                                $class_sheet[$bc]=new \stdClass();
                                if($branch_class_sheet == null){
                                    $class_sheet[$bc]->class_id=$class->id;
                                    $class_sheet[$bc]->sheet=0;
                                }else{
                                    $class_sheet[$bc]->class_id=$branch_class_sheet->class_id;
                                    $class_sheet[$bc]->sheet=$branch_class_sheet->sheet;
                                    $total_sheet+=(int)$class_sheet[$bc]->sheet;
                                }
                            }

                        }


                    }
//                    dd($total_sheet);

                    $notes[$key][$i]->class_sheet=$class_sheet;
                    $notes[$key][$i]->total_sheet=$total_sheet;

                }
                if($currency_id== $myanmar_currency->id){
                    $currency_value=new \stdClass();
                    $currency_value->id="null";
                    $currency_value->value="null";
                    $currency_value=null;
                } else{
                    foreach($classification as $c=>$class){
                        $classification_group_id = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                            ->where('classification_id', $class->id)->first();
                        if($classification_group_id!=null){
                            if($request->status==="buy"){
                                $buy_class_value= BuyClassGroupValue::where('classification_group_id', $classification_group_id->id)
                                    ->latest()
                                    ->first();
                                $currency_value[$c]=new \stdClass();
                                $currency_value[$c]->id=$buy_class_value->id;
                                $currency_value[$c]->class_id=$class->id;
                                $currency_value[$c]->value=$buy_class_value->value;
                            }elseif($request->status==="sell"){
                                $sell_class_value= SellClassGroupValue::where('classification_group_id', $classification_group_id->id)
                                    ->latest()
                                    ->first();
                                $currency_value[$c]=new \stdClass();
                                $currency_value[$c]->id=$sell_class_value->id;
                                $currency_value[$c]->class_id=$class->id;
                                $currency_value[$c]->value=$sell_class_value->value;
                            }

                        }
                    }
                }
                $new[$key]->class_currency_value=$currency_value;

            }
            foreach($new as $k=>$n){
                $new[$k]->notes=$notes[$k];
            }
//            dd($new);
            if($currency_id==$us_currency_id->id){
                return response()->json([
                    'class'=>$classification,
                    'status'=>$status,
                    'groups'=> $new,
                ]);
            }else{
                return response()->json([
                    'class'=>null,
                    'status'=>$status,
                    'groups'=> $new,
                ]);
            }
        }
        else{
            return response()->json([
                'is_success'=>false,
                'message'=>'First,make notes as a group',
            ]);
        }
    }
    public function transaction_store(Request $request){
//        if(Auth::user()->isFrontMan()){
            $data=json_encode($request->all());
            $decode_data=json_decode($data);
//            dd($decode_data);
            $branch=Branch::whereId(Auth::user()->branch_id)->firstOrfail();
            $t=$decode_data->transaction;
            $transaction=new Transaction();
            $transaction->in_value=$t->in_value;
            $transaction->out_value=$t->out_value;
            $transaction->in_value_MMK=$t->in_value_MMK;
            $transaction->out_value_MMK=$t->out_value_MMK;
            $transaction->changes=$t->changes;
            $transaction->status=$t->status;
            $transaction->staff_id=Auth::user()->id;
            $transaction->date_time=now();
            $transaction->save();

            $groups=$decode_data->groups;
            $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
            $us_currency=Currency::where('name','United States dollar')->first();
            foreach($groups as $group) {
                $check_currency = Group::find($group->group_id);
                foreach ($group->notes as $note) {
                    if ($t->status == "MMK_other") {
                        if ($group->type == "buy") {
                            if($note->total_sheet!=0){
                                $transaction->in_MMK_group_note()->attach($note->group_note_id, ['sheet' => $note->total_sheet]);
                                $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
                                if ($bgn != null) {
                                    $result = (intval($bgn->sheet) + intval($note->total_sheet));
                                }else {
                                    $result = $note->total_sheet;
                                        }
                                    $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                        ->wherePivot('group_note_id', $note->group_note_id)->detach();
                                    $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
//                                }
                            }
                        } elseif ($group->type == "sell") {
                                foreach ($note->class_sheet as $class_sheet) {
                                    if ($class_sheet->sheet != 0) {
//                                    dd($class_sheet->id);
                                        $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                            ->where('group_id', $group->group_id)->first();
                                        $sgv = SellClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                        $sg=SellClassGroupValue::find($sgv->id);
                                        $out_transaction = new OutTransactionGroupNote();
                                        $out_transaction->transaction_id = $transaction->id;
                                        $out_transaction->group_note_id = $note->group_note_id;
                                        $out_transaction->sheet = $note->total_sheet;
                                        $sg->sell_classes()->save($out_transaction);
                                        $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                        if($bcgn!=null){
                                            if((int)$bcgn->sheet>= (int)$class_sheet->sheet){
                                                $result=(int)$bcgn->sheet-(int)$class_sheet->sheet;
                                                $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                                    ->wherePivot('group_note_id',$note->group_note_id)
                                                    ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                                if($result!=0){
                                                    $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                                                }
                                            }
                                        }
                                    }
                                }
//                            else {
//                                if($note->total_sheet!=0){
//                                    $sv = SellGroupValue::where('group_id', $group->group_id)->latest('date_time')->first();
//                                    $s=SellGroupValue::find($sv->id);
//                                    $out_transaction = new OutTransactionGroupNote();
//                                    $out_transaction->transaction_id = $transaction->id;
//                                    $out_transaction->group_note_id = $note->group_note_id;
//                                    $out_transaction->sheet = $note->total_sheet;
//                                    $s->classes()->save($out_transaction);
//                                    $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
//                                    if ($bgn != null) {
//                                        if($bgn->sheet>=$note->total_sheet){
//                                            $result = (intval($bgn->sheet) - intval($note->total_sheet));
//                                            $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                                ->wherePivot('group_note_id', $bgn->group_note_id)->detach();
//                                            $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $bgn->group_note_id, 'sheet' => $result]);
//                                        }
//                                    }
//                                }
//
//                            }
                        }
                    } elseif ($t->status == "other_MMK") {
                        if ($group->type == "buy") {
                                foreach ($note->class_sheet as $class_sheet) {
                                    if ($class_sheet->sheet != null) {
                                        $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                            ->where('group_id', $group->group_id)->first();
                                        $sgv = BuyClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                        $sg = BuyClassGroupValue::find($sgv->id);
                                        $in_transaction = new InTransactionGroupNote();
                                        $in_transaction->transaction_id = $transaction->id;
                                        $in_transaction->group_note_id = $note->group_note_id;
                                        $in_transaction->sheet = $note->total_sheet;
                                        $sg->buy_classes()->save($in_transaction);
//                                        dd($class_sheet->class_id);
                                        $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                        if($bcgn!=null) {
                                            $result = (int)$bcgn->sheet + (int)$class_sheet->sheet;
                                        }else{
                                            $result=$class_sheet->sheet;
                                        }
                                            $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                                ->wherePivot('group_note_id',$note->group_note_id)
                                                ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                            $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                                    }
                                }
//                            else {
//                                if($note->total_sheet!=null){
//                                    $sv = BuyGroupValue::where('group_id',  $group->group_id)->latest()->first();
//                                    $s=BuyGroupValue::find($sv->id);
//                                    $in_transaction = new InTransactionGroupNote();
//                                    $in_transaction->transaction_id = $transaction->id;
//                                    $in_transaction->group_note_id = $note->group_note_id;
//                                    $in_transaction->sheet = $note->total_sheet;
//                                    $s->classes()->save($in_transaction);
//                                    $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
//                                    if ($bgn != null) {
//                                        $result = (intval($bgn->sheet) + intval($note->total_sheet));
//                                    }else{
//                                        $result=$note->total_sheet;
//                                    }
//                                        $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                            ->wherePivot('group_note_id', $note->group_note_id)->detach();
//                                        $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
////                                    }
//                                }
//
//                            }
                        } elseif ($group->type == "sell") {
                            if($note->total_sheet!=null){
                                $transaction->out_MMK_group_note()->attach($note->group_note_id, ['sheet' => $note->total_sheet]);
                                $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
                                if ($bgn != null) {
                                    if($bgn->sheet>=$note->total_sheet){
                                        $result = (intval($bgn->sheet) - intval($note->total_sheet));
                                        $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                            ->wherePivot('group_note_id', $note->group_note_id)->detach();
                                        $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
                                    }
                                }
                            }
                        }
                    } elseif ($t->status == "other_other") {
                        if ($group->type == "buy") {
                                foreach ($note->class_sheet as $class_sheet) {
                                    if ($class_sheet->sheet != null) {
                                        $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                            ->where('group_id', $group->group_id)->first();
                                        $sgv = BuyClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                        $sg = BuyClassGroupValue::find($sgv->id);
                                        $in_transaction = new InTransactionGroupNote();
                                        $in_transaction->transaction_id = $transaction->id;
                                        $in_transaction->group_note_id = $note->group_note_id;
                                        $in_transaction->sheet = $note->total_sheet;
                                        $sg->buy_classes()->save($in_transaction);

                                        $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                        if($bcgn!=null) {
                                            $result = (int)$bcgn->sheet + (int)$class_sheet->sheet;
                                        }else{
                                            $result=$class_sheet->sheet;
                                        }
                                            $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                                ->wherePivot('group_note_id',$note->group_note_id)
                                                ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                            $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
//                                        }
                                    }

                                }
//                            else {
//                                $sv = BuyGroupValue::where('group_id',  $group->group_id)->latest()->first();
//                                $in_transaction = new InTransactionGroupNote();
//                                $in_transaction->transaction_id = $transaction->id;
//                                $in_transaction->group_note_id = $note->group_note_id;
//                                $in_transaction->sheet = $note->total_sheet;
//                                $sv->classes()->save($in_transaction);
////                                        dd('success');
//                                $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
////                                dd($bgn);
//                                if ($bgn != null) {
//                                    $result = (intval($bgn->sheet) + intval($note->total_sheet));
//                                }else{
//                                    $result=$note->total_sheet;
//                                }
//                                    $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                        ->wherePivot('group_note_id', $note->group_note_id)->detach();
//                                    $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
//                            }
                        } elseif ($group->type == "sell") {
                                foreach ($note->class_sheet as $class_sheet) {
                                    if ($class_sheet->sheet != null) {
                                        $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                            ->where('group_id', $group->group_id)->first();
                                        $sgv = SellClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                        $sg=SellClassGroupValue::find($sgv->id);
                                        $out_transaction = new OutTransactionGroupNote();
                                        $out_transaction->transaction_id = $transaction->id;
                                        $out_transaction->group_note_id = $note->group_note_id;
                                        $out_transaction->sheet = $note->total_sheet;
                                        $sg->sell_classes()->save($out_transaction);
                                        $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                        if($bcgn!=null){
                                            if((int)$bcgn->sheet>= (int)$class_sheet->sheet){
                                                $result=(int)$bcgn->sheet-(int)$class_sheet->sheet;
                                                $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                                    ->wherePivot('group_note_id',$note->group_note_id)
                                                    ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                                $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                                            }
                                        }
                                    }
                                }
//                            else {
//                                $sv = SellGroupValue::where('group_id',  $group->group_id)->latest()->first();
//                                $s=SellGroupValue::find($sv->id);
//                                $out_transaction = new OutTransactionGroupNote();
//                                $out_transaction->transaction_id = $transaction->id;
//                                $out_transaction->group_note_id = $note->group_note_id;
//                                $out_transaction->sheet = $note->total_sheet;
//                                $s->classes()->save($out_transaction);
//                                $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
//                                if ($bgn != null) {
//                                    if($bgn->sheet>=$note->total_sheet){
//                                        $result = (intval($bgn->sheet) - intval($note->total_sheet));
//                                        $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
//                                            ->wherePivot('group_note_id', $bgn->group_note_id)->detach();
//                                        $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $bgn->group_note_id, 'sheet' => $result]);
//                                    }
//                                }
//                            }
                        }
                    }
                }

            }
            return response()->json([
                'is_success'=>true,
            ]);
//        }else{
//            dd('cannot accept ');
////            return response()->json([
////                'error_message'=>"Your role can't access "
////            ]);
//        }

    }
    public function member_store(Request $request){
//        dd($request->all());
        $data=json_encode($request->all());
        $decode_data=json_decode($data);
//            dd($decode_data);
        $branch=Branch::whereId(Auth::user()->branch_id)->firstOrfail();
        $t=$decode_data->transaction;
        $transaction=new Transaction();
        $transaction->in_value=$t->in_value;
        $transaction->out_value=$t->out_value;
        $transaction->in_value_MMK=$t->in_value_MMK;
        $transaction->out_value_MMK=$t->out_value_MMK;
        $transaction->changes=$t->changes;
        $transaction->status=$t->status;
        if($t->member_id!=null){
            $transaction->member_id=$t->member_id;
        }
        $transaction->staff_id=Auth::user()->id;
        $transaction->date_time=now();
        $transaction->save();
        $groups=$decode_data->groups;
        $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
        $us_currency=Currency::where('name','United States dollar')->first();
        $us_group=Group::where('currency_id',$us_currency->id)->get();

        $us_group=Group::where('currency_id',$us_currency->id)->first();
        if($us_group!=null){
            $us_classification_gp=ClassificationGroup::where('group_id',$us_group->id)
                ->where('classification_id',1)->first();
            $us_buy_price=BuyClassGroupValue::where('classification_group_id',$us_classification_gp->id)->latest()->first();
//            dd($us_buy_price);
            $exchanged_point=$transaction->in_value_MMK/100000;
            if($exchanged_point>=0){
                $member=Member::whereId($transaction->member_id)->firstOrfail();
                $member->update(['points'=>($member->points+(int)$exchanged_point)]);
                $this->member_point($t->member_id);
            }
        }

        foreach($groups as $group) {
            $check_currency = Group::find($group->group_id);
            if($group->class_currency_value!=null){
                foreach($group->class_currency_value as $c_currency_value){
                    $classification_group=ClassificationGroup::where('group_id',$group->group_id)
                        ->where('classification_id',$c_currency_value->class_id)->first();
                    if($group->type=="buy"){
                        $buy_custom_value=BuyCustomClassGroupValue::create([
                            'value'=>$c_currency_value->value,
                            'classification_group_id'=>$classification_group->id,
                            'date_time'=>now(),
                        ]);
                    }elseif($group->type=="sell"){
                        $sell_custom_value=SellCustomClassGroupValue::create([
                            'value'=>$c_currency_value->value,
                            'classification_group_id'=>$classification_group->id,
                            'date_time'=>now(),
                        ]);
                    }
                }
            }
            foreach ($group->notes as $note) {
                if ($t->status == "MMK_other") {
                    if ($group->type == "buy") {
                        if($note->total_sheet!=0){
                            $transaction->in_MMK_group_note()->attach($note->group_note_id, ['sheet' => $note->total_sheet]);
                            $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
                            if ($bgn != null) {
                                $result = (intval($bgn->sheet) + intval($note->total_sheet));
                            }else {
                                $result = $note->total_sheet;
                            }
                            $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                ->wherePivot('group_note_id', $note->group_note_id)->detach();
                            $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
//                                }
                        }
                    } elseif ($group->type == "sell") {
                        foreach ($note->class_sheet as $class_sheet) {
                            if ($class_sheet->sheet != 0) {
//                                    dd($class_sheet->id);
                                $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                    ->where('group_id', $group->group_id)->first();
                                $sgv = SellCustomClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                $sg=SellCustomClassGroupValue::find($sgv->id);
                                $out_transaction = new OutTransactionGroupNote();
                                $out_transaction->transaction_id = $transaction->id;
                                $out_transaction->group_note_id = $note->group_note_id;
                                $out_transaction->sheet = $note->total_sheet;
                                $sg->sell_custom_classes()->save($out_transaction);
                                $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                if($bcgn!=null){
                                    if((int)$bcgn->sheet>= (int)$class_sheet->sheet){
                                        $result=(int)$bcgn->sheet-(int)$class_sheet->sheet;
                                        $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                            ->wherePivot('group_note_id',$note->group_note_id)
                                            ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                        if($result!=0){
                                            $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                                        }
                                    }
                                }
                            }
                        }

                    }
                } elseif ($t->status == "other_MMK") {
                    if ($group->type == "buy") {
                        foreach ($note->class_sheet as $class_sheet) {
                            if ($class_sheet->sheet != null) {
                                $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                    ->where('group_id', $group->group_id)->first();
                                $sgv = BuyCustomClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                $sg = BuyCustomClassGroupValue::find($sgv->id);
                                $in_transaction = new InTransactionGroupNote();
                                $in_transaction->transaction_id = $transaction->id;
                                $in_transaction->group_note_id = $note->group_note_id;
                                $in_transaction->sheet = $note->total_sheet;
                                $sg->buy_custom_classes()->save($in_transaction);
//                                        dd($class_sheet->class_id);
                                $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                if($bcgn!=null) {
                                    $result = (int)$bcgn->sheet + (int)$class_sheet->sheet;
                                }else{
                                    $result=$class_sheet->sheet;
                                }
                                $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                    ->wherePivot('group_note_id',$note->group_note_id)
                                    ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                            }
                        }

                    } elseif ($group->type == "sell") {
                        if($note->total_sheet!=null){
                            $transaction->out_MMK_group_note()->attach($note->group_note_id, ['sheet' => $note->total_sheet]);
                            $bgn = $this->getBranchGroupNote($branch->id, $note->group_note_id);
                            if ($bgn != null) {
                                if($bgn->sheet>=$note->total_sheet){
                                    $result = (intval($bgn->sheet) - intval($note->total_sheet));
                                    $branch->branch_group_note()->wherePivot('branch_id', $branch->id)
                                        ->wherePivot('group_note_id', $note->group_note_id)->detach();
                                    $branch->branch_group_note()->attach($branch->id, ['group_note_id' => $note->group_note_id, 'sheet' => $result]);
                                }
                            }
                        }
                    }
                } elseif ($t->status == "other_other") {
                    if ($group->type == "buy") {
                        foreach ($note->class_sheet as $class_sheet) {
                            if ($class_sheet->sheet != null) {
                                $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                    ->where('group_id', $group->group_id)->first();
                                $sgv = BuyCustomClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                $sg = BuyCustomClassGroupValue::find($sgv->id);
                                $in_transaction = new InTransactionGroupNote();
                                $in_transaction->transaction_id = $transaction->id;
                                $in_transaction->group_note_id = $note->group_note_id;
                                $in_transaction->sheet = $note->total_sheet;
                                $sg->buy_custom_classes()->save($in_transaction);

                                $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                if($bcgn!=null) {
                                    $result = (int)$bcgn->sheet + (int)$class_sheet->sheet;
                                }else{
                                    $result=$class_sheet->sheet;
                                }
                                $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                    ->wherePivot('group_note_id',$note->group_note_id)
                                    ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
//                                        }
                            }

                        }

                    } elseif ($group->type == "sell") {
                        foreach ($note->class_sheet as $class_sheet) {
                            if ($class_sheet->sheet != null) {
                                $cg = DB::table('classification_group')->where('classification_id', $class_sheet->class_id)
                                    ->where('group_id', $group->group_id)->first();
                                $sgv = SellCustomClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
                                $sg=SellCustomClassGroupValue::find($sgv->id);
                                $out_transaction = new OutTransactionGroupNote();
                                $out_transaction->transaction_id = $transaction->id;
                                $out_transaction->group_note_id = $note->group_note_id;
                                $out_transaction->sheet = $note->total_sheet;
                                $sg->sell_custom_classes()->save($out_transaction);
                                $bcgn = $this->getBranchClassGroupNote($branch->id, $note->group_note_id, $class_sheet->class_id);
                                if($bcgn!=null){
                                    if((int)$bcgn->sheet>= (int)$class_sheet->sheet){
                                        $result=(int)$bcgn->sheet-(int)$class_sheet->sheet;
                                        $branch->branch_group_note_class()->wherePivot('branch_id',$branch->id)
                                            ->wherePivot('group_note_id',$note->group_note_id)
                                            ->wherePivot('class_id',$class_sheet->class_id)->detach();
                                        $branch->branch_group_note_class()->attach($branch->id,['group_note_id' => $note->group_note_id,'class_id'=>$class_sheet->class_id, 'sheet' => $result]);
                                    }
                                }
                            }
                        }

                    }
                }
            }

        }
        return response()->json([
            'is_success'=>true,
        ]);
    }
    protected function getBranchClassGroupNote($branch,$group_note_id,$class_id){
        $bcgn=DB::table('branch_group_note_class')->where('branch_id',$branch)
            ->where('group_note_id',$group_note_id)
            ->where('class_id',$class_id)
            ->first();
        return $bcgn;
    }
    public function total_currency_value(Request $request)
    {

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
        return $branch_group_note;
    }

}
