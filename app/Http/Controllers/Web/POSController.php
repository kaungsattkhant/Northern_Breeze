<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    public function pos_member()
    {
        return view('Member.pos_member');
    }
    public function pos_non_member()
    {
        return view('Member.non_member');
    }
}
