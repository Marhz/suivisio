<?php

namespace App\Http\Middleware;

use Closure;

class IsOwnerOfSituation
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
        if(\Auth::user()->isTeacher())
            return $next($request);
        $situation = \App\Situation::find($request->route()->parameters()['situation']);
        return ($situation->user_id == \Auth::user()->id) ? $next($request) : redirect()->back();
    }
}
