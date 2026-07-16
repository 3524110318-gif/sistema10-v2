<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\EntregaUniforme;
use Illuminate\Http\Request;

class EntregaUniformeController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        return view(
            'rh.uniformes.create',
            compact('empleado')
        );
    }

    public function store(
        Request $request,
        $empleadoId
    )
    {
        EntregaUniforme::create([

            'empleado_id' => $empleadoId,

            'articulo' => $request->articulo,

            'tipo' => $request->tipo,

            'fecha_entrega' =>
                $request->fecha_entrega,

            'observaciones' =>
                $request->observaciones,

        ]);

        return redirect()

            ->route(
                'rh.empleados.show',
                $empleadoId
            )

            ->with(
                'success',
                'Uniforme registrado'
            );
    }
}
