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
            if(Auth::user()->role_id === 1 || Auth::user()->role_id === 2  || Auth::user()->role_id === 3 )
            {
//                dd(Auth::user()->role_id);
                return $next($request);
            }
        }
        return redirect('login');
    }
}
