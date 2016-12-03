<?php

namespace App\Http\Middleware;

use Closure;

class Student
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
    	if(\Auth::guest() || \Auth::user()->level != 2)
    	{
    		return redirect('/');
    	}
        return $next($request);
    }
}
