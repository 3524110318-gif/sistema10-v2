<?php

namespace App\Services;

use App\Models\Administracion\LogActividad;

class ActividadService
{
    /**
     * Registrar una acción en la auditoría.
     */
    public static function registrar(
        string $accion,
        ?array $valorAnterior = null,
        ?array $valorNuevo = null
    ): LogActividad {
        $usuario = auth()->user();

        return LogActividad::create([

            'user_id' =>
                $usuario?->id,

            'usuario' =>
                $usuario?->name
                ?? 'Sistema',

            'rol' =>
                $usuario?->rol
                ?? 'sistema',

            'accion' =>
                $accion,

            'valor_anterior' =>
                $valorAnterior,

            'valor_nuevo' =>
                $valorNuevo,

            'ip' =>
                request()->ip(),

            'user_agent' =>
                request()->userAgent(),

        ]);
    }
}