<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class isAdmin
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
        if(Auth::check() && !Auth::user()->hasRole('admin')){
            return redirect()->route('login_index');
        }

        if(!Auth::check()){
            return redirect()->route('login_index');
        }

        return $next($request);
    }
}
