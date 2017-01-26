<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class admin
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
        if(Session::get('user_type')=='admin')
        {
            return $next($request);
        }
        else
        {
            return Redirect::back();
        }
    }
}
