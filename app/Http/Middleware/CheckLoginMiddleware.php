<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;



use Closure;
use Illuminate\Http\Request;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guest()) {//Valida si el usuario esta logueado
            return redirect('/login')->with('fail','Es necesario que inicie sesión');//Si no esta logueado, lo redirige a la página login
        }
        return $next($request);
    }
}
