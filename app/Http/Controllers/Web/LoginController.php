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
            'email'=>'required|string|email|max:255|exists:staff,email',
            'password'=>'required',
        ]);
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]))
        {

            if(Auth::user()->role_id== 1)
            {
                return redirect('/staff');
            }
            elseif(Auth::user()->role_id == 2)
            {
                return redirect ('/stock');
            }
            elseif(Auth::user()->role_id== 3)
            {
                return redirect ('/pos/non_member');
            }
        }
        else
            return redirect('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
