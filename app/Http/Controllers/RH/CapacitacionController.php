<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Capacitacion;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CapacitacionController extends Controller
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
                    'No puedes registrar capacitaciones para un empleado inactivo.'
                );

        }

        return view(
            'rh.capacitaciones.create',
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
                    'No puedes registrar capacitaciones para un empleado inactivo.'
                );

        }

        $datos = $request->validate(
            [
                'curso' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'fecha_capacitacion' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                ],

                'calificacion' => [
                    'nullable',
                    'integer',
                    'min:0',
                    'max:100',
                ],

                'vigencia_hasta' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_capacitacion',
                ],

                'evidencia' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120',
                ],

                'dc3' => [
                    'nullable',
                    'file',
                    'mimes:pdf',
                    'max:5120',
                ],
            ],
            [
                'curso.required' =>
                    'El nombre del curso es obligatorio.',

                'curso.string' =>
                    'El nombre del curso no es válido.',

                'curso.max' =>
                    'El nombre del curso no debe superar los 150 caracteres.',

                'fecha_capacitacion.required' =>
                    'La fecha de capacitación es obligatoria.',

                'fecha_capacitacion.date' =>
                    'La fecha de capacitación no es válida.',

                'fecha_capacitacion.before_or_equal' =>
                    'La fecha de capacitación no puede ser posterior al día de hoy.',

                'calificacion.integer' =>
                    'La calificación debe ser un número entero.',

                'calificacion.min' =>
                    'La calificación no puede ser menor a 0.',

                'calificacion.max' =>
                    'La calificación no puede ser mayor a 100.',

                'vigencia_hasta.date' =>
                    'La fecha de vigencia no es válida.',

                'vigencia_hasta.after_or_equal' =>
                    'La vigencia no puede ser anterior a la fecha de capacitación.',

                'evidencia.file' =>
                    'La evidencia debe ser un archivo válido.',

                'evidencia.mimes' =>
                    'La evidencia debe ser un archivo PDF, JPG, JPEG o PNG.',

                'evidencia.max' =>
                    'La evidencia no debe superar los 5 MB.',

                'dc3.file' =>
                    'La constancia DC3 debe ser un archivo válido.',

                'dc3.mimes' =>
                    'La constancia DC3 debe ser un archivo PDF.',

                'dc3.max' =>
                    'La constancia DC3 no debe superar los 5 MB.',
            ]
        );

        $capacitacionDuplicada = Capacitacion::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'curso',
                trim($datos['curso'])
            )
            ->where(
                'fecha_capacitacion',
                $datos['fecha_capacitacion']
            )
            ->exists();

        if ($capacitacionDuplicada) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Esta capacitación ya fue registrada para el empleado en la misma fecha.'
                );

        }

        $evidencia = null;
        $dc3 = null;

        try {

            if ($request->hasFile('evidencia')) {

                $evidencia = $request
                    ->file('evidencia')
                    ->store(
                        'capacitaciones/evidencias',
                        'public'
                    );

            }

            if ($request->hasFile('dc3')) {

                $dc3 = $request
                    ->file('dc3')
                    ->store(
                        'capacitaciones/dc3',
                        'public'
                    );

            }

            DB::transaction(function () use (
                $datos,
                $empleado,
                $evidencia,
                $dc3
            ) {

                $capacitacion = Capacitacion::create([
                    'empleado_id' =>
                        $empleado->id,

                    'curso' =>
                        trim($datos['curso']),

                    'fecha_capacitacion' =>
                        $datos['fecha_capacitacion'],

                    'calificacion' =>
                        $datos['calificacion'] ?? null,

                    'vigencia_hasta' =>
                        $datos['vigencia_hasta'] ?? null,

                    'evidencia' =>
                        $evidencia,

                    'dc3' =>
                        $dc3,
                ]);

                LogActividad::create([
                    'usuario' =>
                        Auth::user()->rol,

                    'accion' =>
                        'Registró la capacitación "' .
                        $capacitacion->curso .
                        '" para el empleado ' .
                        $empleado->numero_control,
                ]);

            });

        } catch (\Throwable $error) {

            if (
                $evidencia &&
                Storage::disk('public')->exists($evidencia)
            ) {

                Storage::disk('public')->delete(
                    $evidencia
                );

            }

            if (
                $dc3 &&
                Storage::disk('public')->exists($dc3)
            ) {

                Storage::disk('public')->delete(
                    $dc3
                );

            }

            report($error);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No fue posible registrar la capacitación. Inténtalo nuevamente.'
                );

        }

        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Capacitación registrada correctamente.'
            );
    }
}