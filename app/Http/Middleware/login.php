<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class login
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
        if(Session::get('login')=='true')
        {
            return $next($request);
        }
        else
        {
            //dd(Session::get('user_type'));
            return Redirect::back();
        }
    }
}
