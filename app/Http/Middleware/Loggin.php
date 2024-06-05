<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Loggin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Determinar la acción basada en el método HTTP
        $action = null;
        if ($request->isMethod('post')) {
            $action = 'A'; // Alta
        } elseif ($request->isMethod('delete')) {
            $action = 'B'; // Baja
        } elseif ($request->isMethod('put') || $request->isMethod('patch')) {
            $action = 'M'; // Modificación
        }

        if ($action) {
            // Obtener el ID del usuario autenticado, si hay uno
            $userId = auth()->id();

            // Registrar solo si hay un usuario autenticado
            if ($userId) {
                DB::table('loggins')->insert([
                    'user_id' => $userId,
                    'ip_computer' => $request->ip(),
                    'browser' => $_SERVER['HTTP_SEC_CH_UA'],
                    'action' => $action,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return $response;
    }
}
