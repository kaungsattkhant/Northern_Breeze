<?php

namespace App\Http\Controllers\Web;

use App\Model\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyCurrencyController extends Controller
{
    public function index()
    {
        return view('DailyCurrency.index');
    }
    public function daily_currency_filter($id)
    {
        $groups=Group::with('notes','currency')->where('currency_id','=',$id)->get();
        $data=view('DailyCurrency.dailycurrency',compact('groups'));
//        dd($data);
        return $data;
    }
}
