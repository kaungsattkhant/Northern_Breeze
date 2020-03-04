<?php

namespace App\Http\Controllers\Web;
use App\Model\Currency;
use App\Model\InTransactionGroupNote;
use App\Model\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(){
        $us_currency=config('global.us_currency');
        $now=Carbon::now();
        $dayInMonth=Carbon::now()->daysInMonth;
        $days=[];
        for($i=1;$i<=$dayInMonth;$i++){
            array_push($days,$i);
        }
        $currency=[];
        $currencies=Currency::all();
        foreach($currencies as $c){
            array_push($currency,$c->name);
        }
        $transactions=[];

        return view('Report.index',compact('currency','days'));
    }
}
