<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function stock_inventory()
    {
        return view('Stock.stock_inventory');
    }
}
