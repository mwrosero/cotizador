<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Redirect;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next){
        if ($this->isReading($request) || $this->tokensMatch($request) || $this->inExceptArray($request)) {
            return $this->addCookieToResponse($request, $next($request));
        }

        if (!$request->session()->has('_token')) {
            return $this->addCookieToResponse($request, $next($request));
        }

        $token = $request->session()->token();

        if ($request->input('_token') !== $token) {
            return redirect()->back()->withErrors([
                'csrf_token' => 'El token CSRF ha expirado. Vuelve a enviar el formulario.'
            ]);
        }

        return $this->addCookieToResponse($request, $next($request));
    }
}
