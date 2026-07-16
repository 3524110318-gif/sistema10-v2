<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\BajaEmpleado;
use Illuminate\Http\Request;

class BajaEmpleadoController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        return view(
            'rh.bajas.create',
            compact('empleado')
        );
    }

    public function store(
        Request $request,
        $empleadoId
    )
    {
        BajaEmpleado::create([

            'empleado_id' => $empleadoId,

            'fecha_baja' =>
                $request->fecha_baja,

            'uniforme_devuelto' =>
                $request->has(
                    'uniforme_devuelto'
                ),

            'botas_devueltas' =>
                $request->has(
                    'botas_devueltas'
                ),

            'credencial_devuelta' =>
                $request->has(
                    'credencial_devuelta'
                ),

            'radio_devuelto' =>
                $request->has(
                    'radio_devuelto'
                ),

            'carta_renuncia' =>
                $request->has(
                    'carta_renuncia'
                ),

            'finiquito_entregado' =>
                $request->has(
                    'finiquito_entregado'
                ),

            'observaciones' =>
                $request->observaciones,

        ]);

        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        $empleado->update([
            'estado' => 'inactivo'
        ]);

        return redirect()

            ->route(
                'rh.empleados.show',
                $empleadoId
            )

            ->with(
                'success',
                'Empleado dado de baja'
            );
    }
}
