<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Teacher
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
        if(Auth::guest() || !Auth::user()->isTeacher())
            return redirect('/');
        return $next($request);
    }
}
