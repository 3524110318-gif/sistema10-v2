<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\BajaEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\LogActividad;

class BajaEmpleadoController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );


        if ($empleado->estado === 'inactivo') {

            return redirect()
                ->route(
                    'rh.empleados.inactivos'
                )
                ->with(
                    'error',
                    'El empleado ya se encuentra inactivo.'
                );

        }


        if (
            BajaEmpleado::where(
                'empleado_id',
                $empleado->id
            )->exists()
        ) {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'El empleado ya cuenta con un registro de baja.'
                );

        }


        return view(
            'rh.bajas.create',
            compact('empleado')
        );
    }

    public function store(Request $request,$empleadoId)
    {
        $request->validate([

            'fecha_baja' => [
                'required',
                'date',
                'before_or_equal:today',
            ],

            'observaciones' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);


        $empleado = Empleado::findOrFail(
            $empleadoId
        );


        if ($empleado->estado === 'inactivo') {

            return redirect()
                ->route(
                    'rh.empleados.inactivos'
                )
                ->with(
                    'error',
                    'El empleado ya se encuentra inactivo.'
                );

        }


        if (
            BajaEmpleado::where(
                'empleado_id',
                $empleado->id
            )->exists()
        ) {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'Este empleado ya cuenta con un registro de baja.'
                );

        }


        DB::transaction(
            function () use (
                $request,
                $empleado
            ) {

                BajaEmpleado::create([

                    'empleado_id' =>
                        $empleado->id,

                    'fecha_baja' =>
                        $request->fecha_baja,

                    'uniforme_devuelto' =>
                        $request->boolean(
                            'uniforme_devuelto'
                        ),

                    'botas_devueltas' =>
                        $request->boolean(
                            'botas_devueltas'
                        ),

                    'credencial_devuelta' =>
                        $request->boolean(
                            'credencial_devuelta'
                        ),

                    'radio_devuelto' =>
                        $request->boolean(
                            'radio_devuelto'
                        ),

                    'carta_renuncia' =>
                        $request->boolean(
                            'carta_renuncia'
                        ),

                    'finiquito_entregado' =>
                        $request->boolean(
                            'finiquito_entregado'
                        ),

                    'observaciones' =>
                        $request->observaciones,

                ]);


                $empleado->update([

                    'estado' => 'inactivo',

                ]);

                LogActividad::create([

                    'usuario' => auth()->user()->rol,

                    'accion' => 'Dio de baja al empleado ' .
                        $empleado->numero_control .
                        ' - ' .
                        $empleado->nombre .
                        ' ' .
                        $empleado->apellido_paterno,

                ]);

            }
        );


        return redirect()
            ->route(
                'rh.empleados.inactivos'
            )
            ->with(
                'success',
                'Empleado dado de baja correctamente.'
            );
    }
}
