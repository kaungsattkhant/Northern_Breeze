<?php

namespace App\Http\Controllers\Web;
use App\Model\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyGroupController extends Controller
{
    public function index()
    {
        $currency_groups=Group::with('currency','notes')->orderBy('id','desc')->get();
//        dd($currency_groups);
//        if($currency_groups->isEmpty())
//        {
//            $currency_groups=null;
//        }
        return view('Currency.index',compact('currency_groups'));
    }
    public function store(Request $request)
    {
        $vData=$request->validate([
            'currency'=>'required',
            'group_name'=>'required',
            'notes'=>'required',
        ]);
        $currency_group=new Group();
        $currency_group->name=$request->group_name;
        $currency_group->currency_id=$request->currency;
        $currency_group->save();
        $currency_group->notes()->attach($request->notes);
        return redirect('/currency_group');
    }
    public function update()
    {

    }
}
