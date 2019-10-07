<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('Member.index');
    }
    public function non_member()
    {
        return view('Member.non_member');
    }
}
