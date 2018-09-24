<?php

namespace App\Http\Middleware;

use Closure;

class Poll
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
        if (!config('app.enable_poll'))
          return redirect()->back();
        return $next($request);
    }
}
