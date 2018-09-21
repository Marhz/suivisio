<?php

namespace App\Http\Middleware;

use Closure;

class MacAddress
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
        if (!config('app.collect_mac_addresses'))
          return redirect()->back();
        return $next($request);
    }
}
