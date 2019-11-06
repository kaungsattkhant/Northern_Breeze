<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('Login.login');
    }
    public function makeLogin(Request $request)
    {
//        dd($request->all());
        $vData=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]))
        {
            return redirect('/staff');
        }
        else
//            return 'error';
            return redirect('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
