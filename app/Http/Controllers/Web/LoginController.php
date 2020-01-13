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
            'email'=>'required|exists:staff,email',
            'password'=>'required',
        ]);
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]))
        {
//            dd(Auth::user());
//            dd('a');
//            dd(Auth::user()->role_id);
            if(Auth::user()->role_id== 1)
            {
                return redirect('/staff');

            }
            else if(Auth::user()->role_id== 2)
            {
                return redirect ('/stock');
            }
            else if(Auth::user()->role_id== 3)
            {
                return redirect ('/daily_currency');
            }

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
