<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsVendor
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
        //dd(Auth::user()->payment_status);
       if (Auth::user() &&  Auth::user()->user_type == 2 && Auth::user()->role == 1 && Auth::user()->payment_status == 0) {
          return redirect('pay');  
       }
        
       return $next($request);
            
       //return redirect('pay');
           
    }
}
