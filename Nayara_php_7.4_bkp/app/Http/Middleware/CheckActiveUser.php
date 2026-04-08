<?php
 
namespace App\Http\Middleware;
 
use Closure;
 
class CheckActiveUser
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
    if (strpos($request->path, '..') !== false || strpos($request->input('path'), '..') !== false) {
        abort(403, 'Unauthorized path');
    }
 
    return $next($request);
}
}