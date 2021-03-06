<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
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
        if(!\Auth::guest() && !\Auth::user()->passwordChanged)
            return redirect('changerMdp')->with('error','Vous devez changer le mot de passe par défault');
        return $next($request);
    }
}
