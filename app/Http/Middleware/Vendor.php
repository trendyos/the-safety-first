<?php

namespace App\Http\Middleware;

use Closure;

class Vendor
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
        if(isset(auth()->user()->is_admin) && auth()->user()->is_admin ==  3){ 
            return $next($request);
        }
        return redirect('/vendor/login')->with('error',"You don't have direct access. Please login first");
    }
}
