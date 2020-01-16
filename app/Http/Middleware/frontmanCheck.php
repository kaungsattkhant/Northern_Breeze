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
            if(Auth::user()->role_id === 1 || Auth::user()->role_id === 3 )
            {
//                abort(401,'This action is unauthorized');
                return $next($request);

            }

        }
//        return $next($request);

        return redirect('login');
    }
}
