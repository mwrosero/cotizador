<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class IsmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*if (Session::has('userData')) {
            // El valor está presente en la sesión, continuar con el siguiente middleware o ruta
            return $next($request);
        } else {
            // El valor no está presente en la sesión, redirigir o responder según sea necesario
            return redirect()->route('login');
        }*/
        return $next($request);

    }
}
