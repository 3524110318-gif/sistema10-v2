<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Empleado;
use App\Models\RH\Vigencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VigenciaController extends Controller
{
    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar vigencias para un empleado inactivo.'
                );

        }

        return view(
            'rh.vigencias.create',
            compact('empleado')
        );
    }

    public function store(
        Request $request,
        $empleadoId
    ) {

        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar vigencias para un empleado inactivo.'
                );

        }

        $datos = $request->validate(

            [

                'documento' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'otro_documento' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'fecha_vencimiento' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'evidencia' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120',
                ],

            ],

            [

                'documento.required' =>
                    'Debes seleccionar un documento.',

                'otro_documento.max' =>
                    'El nombre del documento no debe superar los 150 caracteres.',

                'fecha_vencimiento.required' =>
                    'La fecha de vencimiento es obligatoria.',

                'fecha_vencimiento.after_or_equal' =>
                    'La fecha de vencimiento no puede ser anterior al día de hoy.',

                'evidencia.mimes' =>
                    'La evidencia debe ser PDF, JPG, JPEG o PNG.',

                'evidencia.max' =>
                    'La evidencia no debe superar los 5 MB.',

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | DOCUMENTO
        |--------------------------------------------------------------------------
        */

        if ($datos['documento'] === 'Otro') {

            $documento = trim(
                $datos['otro_documento']
            );

        } else {

            $documento = trim(
                $datos['documento']
            );

        }

        $documento = preg_replace(
            '/\s+/',
            ' ',
            $documento
        );

        if ($documento === '') {

            return back()
                ->withInput()
                ->withErrors([

                    'otro_documento' =>
                        'Debes escribir el nombre del documento.',

                ]);

        }

        /*
        |--------------------------------------------------------------------------
        | DUPLICADOS
        |--------------------------------------------------------------------------
        */

        $duplicado = Vigencia::where(
            'empleado_id',
            $empleado->id
        )
        ->where(
            'documento',
            $documento
        )
        ->where(
            'fecha_vencimiento',
            $datos['fecha_vencimiento']
        )
        ->exists();

        if ($duplicado) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Esta vigencia ya fue registrada.'
                );

        }

        /*
        |--------------------------------------------------------------------------
        | SUBIR EVIDENCIA
        |--------------------------------------------------------------------------
        */

        $rutaEvidencia = null;

        if ($request->hasFile('evidencia')) {

            $rutaEvidencia = $request
                ->file('evidencia')
                ->store(
                    'vigencias',
                    'public'
                );

        }

        try {

            DB::transaction(function () use (

                $empleado,
                $documento,
                $datos,
                $rutaEvidencia

            ) {

                $vigencia = Vigencia::create([

                    'empleado_id' =>
                        $empleado->id,

                    'documento' =>
                        $documento,

                    'fecha_vencimiento' =>
                        $datos['fecha_vencimiento'],

                    'evidencia' =>
                        $rutaEvidencia,

                ]);

                LogActividad::create([

                    'usuario' =>
                        Auth::user()->rol,

                    'accion' =>
                        'Registró la vigencia "' .
                        $vigencia->documento .
                        '" para el empleado ' .
                        $empleado->numero_control .

                        '.',

                ]);

            });

        } catch (\Throwable $e) {

            if (

                $rutaEvidencia &&
                Storage::disk('public')->exists(
                    $rutaEvidencia
                )

            ) {

                Storage::disk('public')
                    ->delete(
                        $rutaEvidencia
                    );

            }

            throw $e;

        }

        return redirect()

            ->route(
                'rh.empleados.show',
                $empleado->id
            )

            ->with(
                'success',
                'Vigencia registrada correctamente.'
            );

    }
}