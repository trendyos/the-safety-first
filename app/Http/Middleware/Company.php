<?php

namespace App\Http\Middleware;

use Closure;

class Company
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
        if(isset(auth()->user()->is_admin) && auth()->user()->is_admin ==  0){ 
            return $next($request);
        }
        return redirect('/company/login')->with('error',"You don't have direct access. Please login first");
    }
}
