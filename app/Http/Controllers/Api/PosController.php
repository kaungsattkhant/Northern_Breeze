<?php

namespace App\Http\Controllers\Api;

use App\Model\BuyClassGroupValue;
use App\Model\ClassificationGroup;
use App\Model\Currency;
use App\Model\Group;
use App\Model\SellClassGroupValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{

    public function transaction(){
        $data=file_get_contents(storage_path().'/api/transaction_store.json');
        $decode_data=json_decode($data);
//        dd($decode_data);
        return response()->json($decode_data);
    }
    public function get_currency_exchange($c_name="Australian dollar"){
        $currency=Currency::where('name',$c_name)->first();
        $group=Group::where('currency_id',$currency->id)->first();
        if($group!=null){
            $cg=ClassificationGroup::where('group_id',$group->id)
                ->where('classification_id',1)->first();
            $scg=SellClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
            $bcg=BuyClassGroupValue::where('classification_group_id',$cg->id)->latest()->first();
            return response()->json([
                'sell_value'=>$scg->value,
                'buy_value'=>$bcg->value,
            ]);
        }else{
            return response()->json([
                'error'=>"Doesn't not have currency group",
            ]);
        }
    }
}
