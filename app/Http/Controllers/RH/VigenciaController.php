<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\Vigencia;
use Illuminate\Http\Request;

class VigenciaController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        return view(
            'rh.vigencias.create',
            compact('empleado')
        );
    }

    public function store(
        Request $request,
        $empleadoId
    )
    {
        Vigencia::create([

            'empleado_id' =>
                $empleadoId,

            'documento' =>
                $request->documento,

            'fecha_vencimiento' =>
                $request->fecha_vencimiento,

        ]);

        return redirect()

            ->route(
                'rh.empleados.show',
                $empleadoId
            )

            ->with(
                'success',
                'Vigencia registrada'
            );
    }
}

