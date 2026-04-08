<?php

namespace App\Http\Middleware;

use Closure;

class AuthShareholder
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
        if(session()->exists('isShareholder') && session()->get('isShareholder')){

            return $next($request);
        }
        else{

            session()->put('isShareholder', false);

            return $next($request);
        }
    }
}
