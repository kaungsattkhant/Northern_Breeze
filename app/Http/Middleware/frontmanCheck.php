<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class frontmanCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
//            dd(Auth::user());
            if(Auth::user()->role->id==1 || Auth::user()->role->id == 3 || Auth::user()->role->id == 2 )
            {
                return $next($request);
            }

        }
        return redirect('login');
    }
}
