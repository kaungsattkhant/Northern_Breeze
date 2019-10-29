<?php

namespace App\Http\Controllers\Web;
use App\Model\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyGroupController extends Controller
{
    public function index()
    {

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
        dd('success');
//        dd($request->all());
    }
    public function update()
    {

    }
}
