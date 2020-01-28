<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class managerCheck
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
//            dd(Auth::user()->isManager());
            if(Auth::user()->role_id == 2 || Auth::user()->role_id == 1 )
            {
//                dd('manager');
                        return $next($request);
            }
        }
        return redirect('login');
    }
}
