<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\BajaEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Storage;
use Throwable;
use App\Services\ActividadService;

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

        return view(
            'rh.bajas.create',
            compact('empleado')
        );
    }

    public function store(
    Request $request,
    $empleadoId
    ) {
        $datos = $request->validate(
            [

                'fecha_baja' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                ],

                'uniforme_devuelto' => [
                    'accepted',
                ],

                'botas_devueltas' => [
                    'accepted',
                ],

                'credencial_devuelta' => [
                    'accepted',
                ],

                'radio_devuelto' => [
                    'accepted',
                ],

                'carta_renuncia' => [
                    'accepted',
                ],

                'finiquito_entregado' => [
                    'accepted',
                ],

                'archivo_carta_renuncia' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'archivo_finiquito' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

            ],
            [

                'fecha_baja.required' =>
                    'La fecha de baja es obligatoria.',

                'fecha_baja.before_or_equal' =>
                    'La fecha de baja no puede ser posterior al día de hoy.',

                'uniforme_devuelto.accepted' =>
                    'Debes confirmar la devolución del uniforme.',

                'botas_devueltas.accepted' =>
                    'Debes confirmar la devolución de las botas.',

                'credencial_devuelta.accepted' =>
                    'Debes confirmar la devolución de la credencial.',

                'radio_devuelto.accepted' =>
                    'Debes confirmar la devolución del radio.',

                'carta_renuncia.accepted' =>
                    'Debes confirmar que la carta de renuncia fue recibida.',

                'finiquito_entregado.accepted' =>
                    'Debes confirmar que el finiquito fue entregado.',

                'archivo_carta_renuncia.required' =>
                    'Debes subir la carta de renuncia.',

                'archivo_carta_renuncia.mimes' =>
                    'La carta de renuncia debe ser PDF, JPG, JPEG, PNG o WEBP.',

                'archivo_carta_renuncia.max' =>
                    'La carta de renuncia no debe superar los 5 MB.',

                'archivo_finiquito.required' =>
                    'Debes subir el finiquito firmado.',

                'archivo_finiquito.mimes' =>
                    'El finiquito debe ser PDF, JPG, JPEG, PNG o WEBP.',

                'archivo_finiquito.max' =>
                    'El finiquito no debe superar los 5 MB.',

            ]
        );

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

        $rutaCarta = null;
        $rutaFiniquito = null;

        try {

            $rutaCarta = $request
                ->file('archivo_carta_renuncia')
                ->store(
                    'bajas/carta_renuncia',
                    'public'
                );

            $rutaFiniquito = $request
                ->file('archivo_finiquito')
                ->store(
                    'bajas/finiquitos',
                    'public'
                );

            DB::transaction(
                function () use (
                    $request,
                    $empleado,
                    $rutaCarta,
                    $rutaFiniquito
                ) {

                    $empleadoBloqueado = Empleado::lockForUpdate()
                        ->findOrFail(
                            $empleado->id
                        );

                    if (
                        $empleadoBloqueado->estado
                        === 'inactivo'
                    ) {

                        throw new \RuntimeException(
                            'El empleado ya se encuentra inactivo.'
                        );

                    }

                    BajaEmpleado::create([

                        'empleado_id' =>
                            $empleadoBloqueado->id,

                        'fecha_baja' =>
                            $request->fecha_baja,

                        'uniforme_devuelto' =>
                            true,

                        'botas_devueltas' =>
                            true,

                        'credencial_devuelta' =>
                            true,

                        'radio_devuelto' =>
                            true,

                        'carta_renuncia' =>
                            true,

                        'archivo_carta_renuncia' =>
                            $rutaCarta,

                        'finiquito_entregado' =>
                            true,

                        'archivo_finiquito' =>
                            $rutaFiniquito,

                        'observaciones' =>
                            $request->observaciones,

                        'user_id' =>
                            auth()->id(),

                    ]);

                    $empleadoBloqueado->update([

                        'estado' => 'inactivo',

                    ]);

                    ActividadService::registrar(

                        'Dio de baja al empleado '
                        . $empleadoBloqueado->numero_control
                        . ' - '
                        . $empleadoBloqueado->nombre
                        . ' '
                        . $empleadoBloqueado->apellido_paterno,

                        [

                            'id' => $empleadoBloqueado->id,

                            'numero_control' =>
                                $empleadoBloqueado->numero_control,

                            'estado' =>
                                'activo',

                        ],

                        [

                            'id' => $empleadoBloqueado->id,

                            'numero_control' =>
                                $empleadoBloqueado->numero_control,

                            'estado' =>
                                'inactivo',

                        ]

                    );

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

        } catch (Throwable $e) {

            if (
                $rutaCarta
                && Storage::disk('public')->exists(
                    $rutaCarta
                )
            ) {

                Storage::disk('public')->delete(
                    $rutaCarta
                );

            }

            if (
                $rutaFiniquito
                && Storage::disk('public')->exists(
                    $rutaFiniquito
                )
            ) {

                Storage::disk('public')->delete(
                    $rutaFiniquito
                );

            }

            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e instanceof \RuntimeException
                        ? $e->getMessage()
                        : 'No fue posible registrar la baja del empleado.'
                );

        }
    }

    public function show(
    BajaEmpleado $baja
    ) {
        $baja->load([
            'empleado',
            'usuario',
        ]);

        return view(
            'rh.bajas.show',
            compact('baja')
        );
    }
}
