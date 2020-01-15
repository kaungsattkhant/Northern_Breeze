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
            if(Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
            {
//                abort(401,'This action is unauthorized');
                        return $next($request);

            }
        }
//
        return redirect('login');
    }
}