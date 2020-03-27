<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Year;

class Expired
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
        if ($request->user() != null && $request->path() != 'logout' && $request->user()->isStudent()
          && ($request->user()->group == null
                || $request->user()->group->year == null
                || $request->user()->group->year->id != Year::current()->id)
        )
          return response()->view('users.expired');
        return $next($request);
    }
}
