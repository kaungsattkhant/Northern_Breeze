<?php

namespace App\Http\Controllers\Web;

use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\ClassValue;
use App\Model\Currency;
use App\Model\Group;
use App\Model\SellGroupValue;
use Carbon\Carbon;
use Dotenv\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DailyCurrencyController extends Controller
{
    public function index()
    {
//        $buy=BuyGroupValue::with('group')
//            ->with('group.notes','group.currency')
//            ->orderBy('date_time','desc')
//            ->get();



        $date = now()->format('Y-m-d');
        $groups=Group::with('currency','classifications','notes')
            ->orderBy('currency_id','asc')->get();

        foreach ($groups as $group){
            $buy_values = BuyGroupValue::where('group_id',$group->id)->whereDate('date_time',$date)->get();
            $lastest_buy_value = collect($buy_values)->last();
            $group->lastest_buy_value = $lastest_buy_value['value'];
            $sell_values = SellGroupValue::where('group_id',$group->id)->whereDate('date_time',$date)->get();
            $lastest_sell_value = collect($sell_values)->last();
            $group->lastest_sell_value = $lastest_sell_value['value'];
        }
//        dd($groups);
        return view('DailyCurrency.dailyindex',compact('groups'));
    }
    public function daily_currency_filter($id)
    {
        $groups=Group::with('notes','currency')->where('currency_id','=',$id)->get();
        $data=view('DailyCurrency.dailycurrency',compact('groups'));
        return $data;
    }
    public function create()
    {
        return view('DailyCurrency.create');
    }
    public function store(Request $request)
    {
//        dd(now());
        if(in_array(null,$request->buying_price))
        {
            return back()->with('error','Something Wrong!!');

        }
        elseif(in_array(null,$request->buying_price))
        {
            return back()->with('error','Something Wrong!!');

        }
//        dd($selling_price);
//        dd($request->all());
        $vData=$request->validate([
            'buying_price'=>'required',
            'selling_price'=>'required',
//            'classification_id'=>'required',
            'group_id'=>'required',
        ]);


        for($i=0;$i<count($request->group_id);$i++)
        {
            if($request->buying_price[$i]!=null)
            {
                $buying_price = new BuyGroupValue();
                $buying_price->value =$request->buying_price[$i];
                $buying_price->group_id=$request->group_id[$i];
                $buying_price->date_time=Carbon::now()->format('Y-m-d H:i');
                $buying_price->save();
            }
            if($request->selling_price[$i]!=null)
            {
                $selling_price=new SellGroupValue();
                $selling_price->value=$request->selling_price[$i];
                $selling_price->group_id=$request->group_id[$i];
                $selling_price->date_time=now()->format('Y-m-d H:i');
                $selling_price->save();
            }
            else
                return back()->with('error','Something Wrong!!');

        }
        if($request->classification_id)
        {
            $classification_all=Classification::all();
            $classification_count=count($classification_all);
            $ary=array_chunk($request->classification_id,$classification_count);
            $class_value=array_chunk($request->classification,$classification_count);

            foreach($request->group_id as $i=>$group)
            {
                $id=(int)$group;
                foreach($ary[$i] as $key=>$a)
                {
                    if($class_value[$i][$key]!=null)
                    {
                        $group=Group::with('classifications')->whereId($id)->firstOrfail();
                        $is_exist =$group->classifications()-> wherePivot('classification_id',$a)->exists();
                        if($is_exist  ==false)
                        {
                            $group->classifications()->attach($a);
//                        $all_classification= $group->classifications()->get();
//                        $group_classification = collect($all_classification)->last();
//                        $classification_group_id = $group_classification->pivot->id;
                        }
                        $classification_group_id=DB::table('classification_group')->where('group_id',$id)
                            ->where('classification_id',$a)->pluck('id')->first();
                        $class_values=new ClassValue();
                        $class_values->value=$class_value[$i][$key];
                        $class_values->date_time=now();
                        $class_values->classification_group_id = $classification_group_id;
                        $class_values->save();
                    }

                }
            }
        }
        return redirect('/daily_currency');
    }
    public function daily_currency_datefilter(Request $request)
    {

        $request_date=$request->date;
        $groups=Group::with('currency','classifications','notes')
            ->orderBy('currency_id','asc')->get();

        foreach ($groups as $group){
            $buy_values = BuyGroupValue::where('group_id',$group->id)->whereDate('date_time',$request_date)->get();
            $lastest_buy_value = collect($buy_values)->last();
            $group->lastest_buy_value = $lastest_buy_value['value'];
            $sell_values = SellGroupValue::where('group_id',$group->id)->whereDate('date_time',$request_date)->get();
            $lastest_sell_value = collect($sell_values)->last();
            $group->lastest_sell_value = $lastest_sell_value['value'];
        }
        $result=view('DailyCurrency.dailycurrency_datefilter',compact('groups'));
        return $result;
//        return response()->json($buy);
    }
    public function daily_detail($currency_id,$group_id)
    {

        $date = now()->format('Y-m-d');

            $buy_values = BuyGroupValue::where('group_id',$group_id)->whereDate('date_time',$date)->orderBy('date_time','asc')
                ->get();
            foreach ($buy_values as $buy_value){
                $buy_value->type = 'buy';
            }
            $sell_values = SellGroupValue::where('group_id',$group_id)->whereDate('date_time',$date)->orderBy('date_time','asc')
                ->get();
            foreach ($sell_values as $sell_value){
                $sell_value->type = 'sell';
            }
            $buy_values = collect($buy_values);
            $sell_values = collect($sell_values);
            $values = $buy_values->merge($sell_values);
            $grouped_values = $values->groupBy('date_time');
            foreach ($grouped_values as $key=>$grouped_value){
                $v = new \stdClass();
                $v->date = $grouped_value[0]->date_time;
//                dd($v->date);
                foreach ($grouped_value as $g_value){
                    if($g_value->type == 'buy'){
                        $v->buy_value= $g_value->value;
                    }
                    else
                        {
                            $v->sell_value= $g_value->value;

                        }

                }
//                dd($v);
                $vs[] = $v;

            }
//        dd($vs);

        $data=view('DailyCurrency.detail_view',compact('vs'));

        return $data;
    }
}
