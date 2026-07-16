<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\Capacitacion;
use Illuminate\Http\Request;

class CapacitacionController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        return view(
            'rh.capacitaciones.create',
            compact('empleado')
        );
    }

    public function store(
        Request $request,
        $empleadoId
    )
    {
        Capacitacion::create([

            'empleado_id' =>
                $empleadoId,

            'curso' =>
                $request->curso,

            'fecha_capacitacion' =>
                $request->fecha_capacitacion,

            'calificacion' =>
                $request->calificacion,

            'vigencia_hasta' =>
                $request->vigencia_hasta,

        ]);

        return redirect()

            ->route(
                'rh.empleados.show',
                $empleadoId
            )

            ->with(
                'success',
                'Capacitación registrada'
            );
    }
}
