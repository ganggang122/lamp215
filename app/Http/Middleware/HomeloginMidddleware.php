<?php

namespace App\Http\Middleware;

use Closure;

class HomeloginMidddleware
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
        if( session('home_usersinfo') ) {
             return $next($request);
        } else {
            return redirect('home/login/index');
        } 
    }
}
