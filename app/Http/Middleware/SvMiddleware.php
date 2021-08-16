<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SvMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session('logged') && session('role') == 1){
            return $next($request);
        } else {
            return redirect(route('sv.login.view'));
        }
    }
}
