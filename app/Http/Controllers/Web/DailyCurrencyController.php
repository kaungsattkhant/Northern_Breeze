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
//        dd($request->all());
        $vData=$request->validate([
            'buying_price'=>'required',
            'selling_price'=>'required',
//            'classification_id'=>'required',
            'group_id'=>'required',
        ]);
        for($i=0;$i<count($request->group_id);$i++)
        {
            $buying_price = new BuyGroupValue();
            $buying_price->value =$request->buying_price[$i];
            $buying_price->group_id=$request->group_id[$i];
            $buying_price->date_time=now();
            $buying_price->save();

            $selling_price=new SellGroupValue();
            $selling_price->value=$request->selling_price[$i];
            $selling_price->group_id=$request->group_id[$i];
            $selling_price->date_time=now();
            $selling_price->save();
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
        $buy=BuyGroupValue::whereDate('date_time',$request_date)->get();
        $result=view('DailyCurrency.dailycurrency_datefilter',compact('buy'));
        return $result;
//        return response()->json($buy);
    }



//    public function ss( Request $request)
//    {
//        $j=0;
//        $gp=0;
//        while($gp<count($request->group_id))
//        {
//            for($i=0;$i<count($request->classification);$i++) {
//                if($request->classification[$i]!=null)
//                {
//                    if(isset($request->group_id[$gp]))
//                    {
//                        $group=Group::with('classifications')->whereId($request->group_id[$gp])->firstOrfail();
//                        $group->classifications()->attach($ary[$i]);
//
//                        foreach($group->classifications as $key=>$classification)
//                        {
//                            $a[] = $class_value[$i];
//
//                            $class_value=new ClassValue();
//                            $class_value->value=$class_value[$i];
//                            $class_value->date_time=Carbon::now();
//                            $class_value->classification_group_id=$classification->pivot->id;
//                            $class_value->save();
//
//                        }
//
//                    }
//
//                }
//
//
//                if($i+1==count($request->classification)/count($request->group_id) || $i+1==count($request->classification))
//                {
//                    $gp++;
//                }
//            }
//            $j++;
//        }
//    }
}
