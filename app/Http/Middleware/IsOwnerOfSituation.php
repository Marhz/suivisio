<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Situation;

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
/*
        if(\Auth::user()->isTeacher())
            return $next($request);
        return ($situation->user_id == \Auth::user()->id) ? $next($request) : redirect()->back();
*/

        $situation = Situation::find($request->route()->parameters()['situation']);
        return /*(\Auth::user()->can('view', $situation))
          ? */$next($request)
          /*: redirect()->back()*/;
    }
}
