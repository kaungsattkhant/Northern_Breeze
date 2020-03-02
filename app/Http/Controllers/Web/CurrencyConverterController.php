<?php

namespace App\Http\Controllers\Web;

use App\Model\BuyClassGroupValue;
use App\Model\ClassificationGroup;
use App\Model\Group;
use App\Model\SellClassGroupValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyConverterController extends Controller
{
    public function index(){
        return view('CurrencyConverter.index');
    }
    public function convert_amount(Request $request){
        $myanmar_currency_id=config('global.myanmar_currency');
        $from_group=Group::where('currency_id',$request->from_exchange)->first();
        $to_group=Group::where('currency_id',$request->to_exchange)->first();

        if($from_group!=null && $to_group !=null){
            $from_cg=ClassificationGroup::where('group_id',$from_group->id)
                ->where('classification_id',1)->first();
            $to_cg=ClassificationGroup::where('group_id',$to_group->id)
                ->where('classification_id',1)->first();
            if($request->from_exchange != $myanmar_currency_id) {
                $bcg = BuyClassGroupValue::where('classification_group_id', $from_cg->id)->latest()->first();
                $from_exchange_amount=($bcg->value*$request->amount);
            }else{
                $from_exchange_amount=$request->amount;
            }
            if($request->to_exchange != $myanmar_currency_id){
                $scg=SellClassGroupValue::where('classification_group_id',$to_cg->id)->latest()->first();
                $result=$from_exchange_amount/$scg->value;
            }else{
                $result=$from_exchange_amount;
            }
            return response()->json([
                'result'=>$result,

            ]);
        }
        else{
            return response()->json([
                'error'=>'Something wrong',
            ]);
        }

    }
}
