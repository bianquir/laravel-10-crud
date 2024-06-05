<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){  //verifica que el usuario esta registrado(admin o user)
            if(Auth::user()->role ==='admin'){
                return $next($request);
            }
        }
        return abort(403, 'No tienes permiso para acceder a esta pagina');
    }
}
