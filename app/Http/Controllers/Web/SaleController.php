<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function sale_record()
    {
        return view('Sale.sale_record');
    }
}
