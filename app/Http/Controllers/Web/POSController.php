<?php

namespace App\Http\Controllers\Web;

use App\Http\Traits\CurrencyFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    use CurrencyFilter;
    public function pos_member()
    {
        return view('Member.pos_member');
    }
    public function pos_non_member()
    {
        return view('Member.non_member');
    }
    public function non_member_from_exchange_filter($currency_id)
    {
//        dd('aaa');
        return $this->currency_filter($currency_id);
    }
    public function non_member_to_exchange_filter($currency_id)
    {
//        dd('aaa');
        return $this->currency_filter($currency_id);
    }
}
