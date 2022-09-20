<?php

namespace App\Http\Middleware;

use Closure;

class Employees
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
        //echo "adfsadf";die;
        if(isset(auth()->user()->is_admin) && auth()->user()->is_admin ==  2){ 
            return $next($request);
        }
        if(isset(auth()->user()->is_admin) && auth()->user()->is_admin ==  4){ 
            return $next($request);
        }
        return redirect('/user/login')->with('error',"You don't have direct access. Please login first");
    }
}
