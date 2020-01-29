<?php

namespace App\Http\Controllers\Web;

use App\Model\BuyClassGroupValue;
use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\ClassificationGroup;
use App\Model\ClassValue;
use App\Model\Currency;
use App\Model\Group;
use App\Model\Note;
use App\Model\SellClassGroupValue;
use App\Model\SellGroupValue;
use Carbon\Carbon;
use Dotenv\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Validator;
class DailyCurrencyController extends Controller
{

    public function test(){
        $results = json_decode(file_get_contents(public_path().'/daily-currency.json'));
        return response()->json([
            'results'=> $results
        ]);
    }

    public function index()
    {
        $date = now()->format('Y-m-d');
        $groups=Group::with('currency','classifications','notes')
            ->orderBy('currency_id','asc')->get();
        $us_currency_id=Currency::where('name','United States dollar')->first();

        foreach ($groups as $group){
            $classification_group=DB::table('classification_group')->where('group_id',$group->id)
                ->where('classification_id',1   )->first();
            if($classification_group!=null){
                $buy_values=BuyClassGroupValue::where('classification_group_id',$classification_group->id)
                    ->get();
                $sell_values=SellClassGroupValue::where('classification_group_id',$classification_group->id)
                    ->get();
            }else{
                $buy_values="";
                $sell_values="";
            }
//            dd($group->currency->id);
//            $us_currency_id=Currency::where('name','United States dollar')->first();
//            if($us_currency_id->id == $group->currency->id){
//                $classification_group=DB::table('classification_group')->where('group_id',$group->id)
//                    ->where('classification_id',1)->first();
//                if($classification_group!=null){
//                    $buy_values=BuyClassGroupValue::where('classification_group_id',$classification_group->id)
//                        ->get();
//                    $sell_values=SellClassGroupValue::where('classification_group_id',$classification_group->id)
//                        ->get();
//                }else{
//                    $buy_values="";
//                    $sell_values="";
//                }
//
//            }
//            else{
//                $buy_values = BuyGroupValue::where('group_id',$group->id)->get();
//                $sell_values = SellGroupValue::where('group_id',$group->id)->get();
//
//            }
//            $buy_values = BuyGroupValue::where('group_id',$group->id)->get();
//            $sell_values = SellGroupValue::where('group_id',$group->id)->get();
            if($buy_values!=null){
                $lastest_buy_value = collect($buy_values)->last();
                $group->detail_id=$lastest_buy_value['id'];
                $group->lastest_buy_value = $lastest_buy_value['value'];

            }else{
                $group->lastest_buy_value="$buy_values";
                }
            if($sell_values!=null){
                $lastest_sell_value = collect($sell_values)->last();
                $group->lastest_sell_value = $lastest_sell_value['value'];
            }else{
                $group->lastest_sell_value=$sell_values;
            }
        }
        return view('DailyCurrency.dailyindex',compact('groups'));
    }
    public function daily_currency_filter($id="1")
    {
//        $id=$request->currency_id;
//        $currency=Currency::find($id);
        $us_currency=Currency::where('name','United States dollar')->first();
//        $myan_currency=Currency::where('name','Myanmar Kyat')->first();
        if($us_currency->id==$id){
            $currency_type="us_currency";
        }else{
            $currency_type="other_currency";
        }
        $groups=Group::with('notes','currency')->where('currency_id','=',$id)->get();
        foreach($groups as $i=>$cg){
            $currency_group[$i]=new \stdClass();
            $currency_group[$i]->group_id=$cg->id;
            $currency_group[$i]->name=$cg->name;
            $group_note=DB::table('group_note')->where('group_id',$cg->id)->get();
            foreach($group_note as $n=>$gn){
                $note=Note::find($gn->note_id);
                $notes[$n]=new \stdClass();
                $notes[$n]->id=$gn->note_id;
                $notes[$n]->name=$note->name;
            }
            $currency_group[$i]->notes=$notes;
        }
        return response()->json([
            'currency_type'=>$currency_type,
            'class'=>Classification::all('id','name'),
            'groups'=>$currency_group,
        ]);
    }
    public function store(){
        $data=file_get_contents(storage_path().'/api/daily_currency_store.json');
        $decode_data=$data=json_decode($data);
        foreach($decode_data->daily_value as $daily_currency){
            foreach($daily_currency->class_group_value as $cgv)
            {
                $check_classification_group=DB::table('classification_group')
                    ->where('group_id',$daily_currency->group_id)
                    ->where(function ($query) use ($cgv){
                        $query->where('classification_id',$cgv->class_id);
                })->exists();
                if($check_classification_group ){
//                    dd('done');
                    $cg=DB::table('classification_group')
                        ->where('group_id',$daily_currency->group_id)
                        ->where(function ($query) use ($cgv){
                            $query->where('classification_id',$cgv->class_id);
                        })->first();
                }else{
                    if($cgv->value !=null){
                        $cg=ClassificationGroup::create([
                            'classification_id'=>$cgv->class_id,
                            'group_id'=>$daily_currency->group_id
                        ]);
                    }
                }
//                dd($cg);
                    if($daily_currency->type==="sell" && $cgv->value!=null){
                        $scgv=SellClassGroupValue::create([
                            'value'=>$cgv->value,
                            'date_time'=>Carbon::now()->format('Y-m-d H:i'),
                            'classification_group_id'=>$cg->id,
                        ]);
                    }elseif($daily_currency->type==="buy" && $cgv->value!=null){
                        $bcgv=BuyClassGroupValue::create([
                            'value'=>$cgv->value,
                            'date_time'=>Carbon::now()->format('Y-m-d H:i'),
                            'classification_group_id'=>$cg->id,
                        ]);
                    }
            }

        }
        return response()->json([
            'is_success'=>true,
        ]);
    }
    public function create()
    {
        return view('DailyCurrency.create');
    }
//    public function store(Request $request)
//    {
////        dd($request->all());
//        $us_currency_id=Currency::where('name','United States dollar')->first();
//        if($request->currency !=   $us_currency_id->id){
//            if(in_array(null,$request->buying_price))
//            {
//                return back()->with('error','There is a problem that required value in buying field .Try again!!');
//            }
//            elseif(in_array(null,$request->selling_price))
//            {
//                return back()->with('error','There is a problem that required  value in selling field .Try again!!');
//            }
//            $vData=Validator::make($request->all(),[
//                'buying_price.*'=>'numeric',
//                'selling_price.*'=>'numeric',
//            ]);
//
//            if($vData->fails())
//            {
//                return back()->withErrors($vData);
//            }
//
////        if($vData->passes())
////        {
////            dd($request->all());
//            for($i=0;$i<count($request->group_id);$i++)
//            {
//                $buying_price = new BuyGroupValue();
//                $buying_price->value =$request->buying_price[$i];
//                $buying_price->group_id=$request->group_id[$i];
//                $buying_price->date_time=Carbon::now()->format('Y-m-d H:i');
//                $buying_price->save();
//                $selling_price=new SellGroupValue();
//                $selling_price->value=$request->selling_price[$i];
//                $selling_price->group_id=$request->group_id[$i];
//                $selling_price->date_time=now()->format('Y-m-d H:i');
//                $selling_price->save();
////                }
////                else
////                    return back()->with('error','Something Wrong!!');
//            }
//        }else{
//            if($request->selling_classification_id)
//            {
//                $classification_all=Classification::all();
//                $classification_count=count($classification_all);
//                $ary=array_chunk($request->selling_classification_id,$classification_count);
//                $selling_class_value=array_chunk($request->selling_classification,$classification_count);
////                dd($class_value);
//                foreach($request->group_id as $i=>$group)
//                {
//                    $id=(int)$group;
//                    foreach($ary[$i] as $key=>$a)
//                    {
//                        if($selling_class_value[$i][$key]!=null)
//                        {
//                            $group=Group::with('classifications')->whereId($id)->firstOrfail();
//                            $is_exist =$group->classifications()-> wherePivot('classification_id',$a)->exists();
//                            if($is_exist  ==false)
//                            {
//                                $group->classifications()->attach($a);
////                        $all_classification= $group->classifications()->get();
////                        $group_classification = collect($all_classification)->last();
////                        $classification_group_id = $group_classification->pivot->id;
//                            }
//                            $classification_group_id=DB::table('classification_group')->where('group_id',$id)
//                                ->where('classification_id',$a)->pluck('id')->first();
//                            $sell_class_value=new SellClassGroupValue();
//                            $sell_class_value->value=$selling_class_value[$i][$key];
//                            $sell_class_value->date_time=now()->format('Y-m-d H:i');;
//                            $sell_class_value->classification_group_id = $classification_group_id;
//                            $sell_class_value->save();
//                        }
//
//                    }
//                }
//            }
//            if($request->buying_classification_id){
//                $classification_all=Classification::all();
//                $classification_count=count($classification_all);
//                $ary=array_chunk($request->buying_classification_id,$classification_count);
//                $class_value=array_chunk($request->buying_classification,$classification_count);
////                dd($class_value);
//                foreach($request->group_id as $i=>$group)
//                {
//                    $id=(int)$group;
//                    foreach($ary[$i] as $key=>$a)
//                    {
//                        if($class_value[$i][$key]!=null)
//                        {
//                            $group=Group::with('classifications')->whereId($id)->firstOrfail();
//                            $is_exist =$group->classifications()-> wherePivot('classification_id',$a)->exists();
//                            if($is_exist  ==false)
//                            {
//                                $group->classifications()->attach($a);
//                            }
//                            $classification_group_id=DB::table('classification_group')->where('group_id',$id)
//                                ->where('classification_id',$a)->pluck('id')->first();
//                            $buy_class_values=new BuyClassGroupValue();
//                            $buy_class_values->value=$class_value[$i][$key];
//                            $buy_class_values->date_time=now()->format('Y-m-d H:i');;
//                            $buy_class_values->classification_group_id = $classification_group_id;
//                            $buy_class_values->save();
//                        }
//
//                    }
//                }
//            }
//        }
//
//            return redirect('/daily_currency');
////        }
////        return view('DailyCurrency.create')->with('error','Something Wrong');
//
//
//    }
    public function daily_currency_datefilter(Request $request)
    {
        $request_date=$request->date;
        $groups=Group::with('currency','classifications','notes')
            ->orderBy('currency_id','asc')->get();
        if($groups->isNotEmpty()) {
            foreach ($groups as $group) {
//                $us_currency_id=Currency::where('name','United States dollar')->first();
//                if($us_currency_id->id == $group->currency->id){
                    $classification_group=DB::table('classification_group')->where('group_id',$group->id)
                        ->where('classification_id',1)->first();
                    if($classification_group!=null){
                        $buy_values=BuyClassGroupValue::where('classification_group_id',$classification_group->id)
                            ->whereDate('date_time', $request_date)
                            ->get();
                        $sell_values=SellClassGroupValue::where('classification_group_id',$classification_group->id)
                            ->whereDate('date_time', $request_date)
                            ->get();
                    }else{
                        $buy_values="";
                        $sell_values="";
                    }

//                }
//                else{
//                    $buy_values = BuyGroupValue::where('group_id', $group->id)->whereDate('date_time', $request_date)->get();
//                    $sell_values = SellGroupValue::where('group_id', $group->id)->whereDate('date_time', $request_date)->get();
//
//
//                }



//                $buy_values = BuyGroupValue::where('group_id', $group->id)->whereDate('date_time', $request_date)->get();
                if($buy_values!=null){
                    $lastest_buy_value = collect($buy_values)->last();
                    $group->detail_id=$lastest_buy_value['id'];
                    $group->lastest_buy_value = $lastest_buy_value['value'];
                }else{
                    $group->latest_buy_value='';
                }
                if($sell_values!=null){
                    $lastest_sell_value = collect($sell_values)->last();
                    $group->lastest_sell_value = $lastest_sell_value['value'];
                }else{
                    $group->latest_sell_value="";
                }
            }
//            return response()->json($groups);
            $result = view('DailyCurrency.dailycurrency_datefilter', compact('groups', 'request_date'));
            return $result;
        }
        return '<p style="padding-left: 400px;padding-top:40px;"><b>Empty </b></p>';

    }
//    public function daily_detail($group_id,$detail_id)
//    {
//        $group=Group::with('currency')->whereId($group_id)->firstOrfail();
//        $detail_date=BuyClassGroupValue::whereId($detail_id)->pluck('date_time');
//        $t=date("Y-m-d", strtotime($detail_date[0]));
//        if($detail_date->isNotEmpty())
//        {
//            $date=date("Y-m-d", strtotime($detail_date[0]));
//            foreach(Classification::all() as $c_key=>$c){
////                dd($key);
//                $class_value[$c_key]=new \stdClass();
//
//                $classification_group = DB::table('classification_group')->where('group_id', $group->id)
//                    ->where('classification_id',$c->id)->first();
//                if($classification_group!=null){
//                    $buy_values = BuyClassGroupValue::where('classification_group_id', $classification_group->id)
//                        ->whereDate('date_time', $date)
//                        ->orderBy('date_time', 'asc')
//                        ->get();
//                    $sell_values=SellClassGroupValue::where('classification_group_id',$classification_group->id)
//                        ->whereDate('date_time', $date)
//                        ->orderBy('date_time', 'asc')
//                        ->get();
//
//                    foreach ($sell_values as $sell_value){
//                        $sell_value->type = 'sell';
//                    }
//                    foreach ($buy_values as $buy_value) {
//                        $buy_value->type = 'buy';
//                    }
////                    $buy_values = collect($buy_values);
////                    $sell_values = collect($sell_values);
//                    $values = $buy_values->merge($sell_values);
//                    $grouped_values = $values->groupBy('date_time');
//                    foreach ($grouped_values as $key=>$grouped_value){
//                        $v = new \stdClass();
//                        $v->date = $grouped_value[0]->date_time;
//                        foreach ($grouped_value as $g_value){
//                            if($g_value->type == 'buy'){
//                                $v->buy_value= $g_value->value;
//                            }
//                            elseif($g_value->type=='sell')
//                            {
//                                $v->sell_value= $g_value->value;
//                            }
//                        }
//                        $c_name=Classification::find($c->id);
//                        $v->class=$c_name->name;
//                    }
////
//                }
//                $class_value[$c_key]->name=$v;
//
//            }
////            dd($class_value);
//            $data=view('DailyCurrency.detail_view',compact('class_value'));
//            return $data;
////            dd($class_value);
//
//        }
//        return '<tr><td>
//                    empty</td>
//                    <td>Empty</td>
//                    <td>Empty</td>
//                    </tr>';
//    }

    public function daily_detail($group_id,$detail_id)
    {
        $group=Group::with('currency')->whereId($group_id)->firstOrfail();
            $detail_date=BuyClassGroupValue::whereId($detail_id)->pluck('date_time');
        $t=date("Y-m-d", strtotime($detail_date[0]));
        if($detail_date->isNotEmpty())
        {
            $date=date("Y-m-d", strtotime($detail_date[0]));
//            foreach(Classification::all() as $c){
                $classification_group = DB::table('classification_group')->where('group_id', $group->id)
                    ->where('classification_id',1)->first();
                $buy_values = BuyClassGroupValue::where('classification_group_id', $classification_group->id)
                    ->whereDate('date_time', $date)
                    ->orderBy('date_time', 'asc')
                    ->get();
                $sell_values=SellClassGroupValue::where('classification_group_id',$classification_group->id)
                    ->whereDate('date_time', $date)
                    ->orderBy('date_time', 'asc')
                    ->get();

                foreach ($sell_values as $sell_value){
                    $sell_value->type = 'sell';
                }
                foreach ($buy_values as $buy_value) {
                    $buy_value->type = 'buy';
                }
                $buy_values = collect($buy_values);
                $sell_values = collect($sell_values);
                $values = $buy_values->merge($sell_values);
//                dd($values);
                $grouped_values = $values->groupBy('date_time');
                foreach ($grouped_values as $key=>$grouped_value){
                    $v = new \stdClass();
                    $v->date = $grouped_value[0]->date_time;
                    foreach ($grouped_value as $g_value){
                        if($g_value->type == 'buy'){
                            $v->buy_value= $g_value->value;
                        }
                        elseif($g_value->type=='sell')
                        {
                            $v->sell_value= $g_value->value;
                        }
                    }
                    $vs[] = $v;
                }
                $data=view('DailyCurrency.detail_view',compact('vs'));
                return $data;
            }

//        }
        return '<tr><td>
                    empty</td>
                    <td>Empty</td>
                    <td>Empty</td>
                    </tr>';
    }
}

