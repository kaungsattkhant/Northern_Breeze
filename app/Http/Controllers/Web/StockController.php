<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index()
    {
        return view('Stock.new');
    }
    public function create()
    {
        return view('Stock.stock_inventory');
    }
}
