<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {

        // VERIFICA SI EL USUARIO TIENE EL ROL CORRECTO
        if (Auth::user()->rol != $rol) {

        abort(403, 'ACCESO NO AUTORIZADO');
}

        // SI EL ROL ES CORRECTO, CONTINÚA
        return $next($request);
    }
}
