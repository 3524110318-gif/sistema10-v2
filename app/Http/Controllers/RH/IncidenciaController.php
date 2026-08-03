<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Empleado;
use App\Models\RH\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Services\ActividadService;

class IncidenciaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim(
            $request->input('buscar', '')
        );

        $incidencias = Incidencia::with('empleado')
            ->when(
                $buscar !== '',
                function ($query) use ($buscar) {

                    $query->where(function ($subquery) use ($buscar) {

                        $subquery
                            ->whereHas(
                                'empleado',
                                function ($empleadoQuery) use ($buscar) {

                                    $empleadoQuery
                                        ->where(
                                            'numero_control',
                                            'like',
                                            "%{$buscar}%"
                                        )
                                        ->orWhere(
                                            'nombre',
                                            'like',
                                            "%{$buscar}%"
                                        )
                                        ->orWhere(
                                            'apellido_paterno',
                                            'like',
                                            "%{$buscar}%"
                                        )
                                        ->orWhere(
                                            'apellido_materno',
                                            'like',
                                            "%{$buscar}%"
                                        );

                                }
                            )
                            ->orWhere(
                                'tipo',
                                'like',
                                "%{$buscar}%"
                            )
                            ->orWhere(
                                'estado',
                                'like',
                                "%{$buscar}%"
                            )
                            ->orWhere(
                                'fecha',
                                'like',
                                "%{$buscar}%"
                            );

                    });

                }
            )
            ->latest('fecha')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
        
        $totalIncidencias = Incidencia::count();

        $pendientes = Incidencia::where(
            'estado',
            'pendiente'
        )->count();

        $justificadas = Incidencia::where(
            'estado',
            'justificada'
        )->count();

        $injustificadas = Incidencia::where(
            'estado',
            'injustificada'
        )->count();

        return view(
            'rh.incidencias.index',
            compact(
                'incidencias',
                'buscar',
                'totalIncidencias',
                'pendientes',
                'justificadas',
                'injustificadas'
            )
        );
    }

    public function create()
    {
        $empleados = Empleado::where(
            'estado',
            'activo'
        )
            ->orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->get();

        return view(
            'rh.incidencias.create',
            compact('empleados')
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'empleado_id' => [
                    'required',
                    'integer',
                    'exists:empleados,id',
                ],

                'tipo' => [
                    'required',
                    Rule::in([
                        'falta',
                        'retardo',
                        'permiso',
                        'incapacidad',
                    ]),
                ],

                'fecha' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                ],

                'folio_incapacidad' => [
                    Rule::requiredIf(
                        $request->tipo === 'incapacidad'
                    ),
                    'nullable',
                    'string',
                    'max:100',
                ],

                'descripcion' => [
                    'nullable',
                    'string',
                    'max:2000',
                    function ($attribute, $value, $fail) {

                        if (
                            $value &&
                            str_word_count(
                                strip_tags($value)
                            ) > 300
                        ) {

                            $fail(
                                'La descripción no debe superar las 300 palabras.'
                            );

                        }

                    },
                ],
            ],
            [
                'empleado_id.required' =>
                    'Debes seleccionar un empleado.',

                'empleado_id.exists' =>
                    'El empleado seleccionado no existe.',

                'tipo.required' =>
                    'Debes seleccionar el tipo de incidencia.',

                'tipo.in' =>
                    'El tipo de incidencia seleccionado no es válido.',

                'fecha.required' =>
                    'La fecha de la incidencia es obligatoria.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'fecha.before_or_equal' =>
                    'La fecha de la incidencia no puede ser posterior al día de hoy.',

                'folio_incapacidad.required' =>
                    'Debes capturar el folio de la incapacidad.',

                'folio_incapacidad.max' =>
                    'El folio no debe superar los 100 caracteres.',

                'descripcion.string' =>
                    'La descripción ingresada no es válida.',

                'descripcion.max' =>
                    'La descripción no debe superar los 2,000 caracteres.',
            ]
        );

        $empleado = Empleado::findOrFail(
            $datos['empleado_id']
        );

        if ($empleado->estado !== 'activo') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No puedes registrar incidencias para un empleado inactivo.'
                );
        }

        $incidenciaDuplicada = Incidencia::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'tipo',
                $datos['tipo']
            )
            ->where(
                'fecha',
                $datos['fecha']
            )
            ->exists();

        if ($incidenciaDuplicada) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Esta incidencia ya fue registrada para el empleado en la misma fecha.'
                );
        }

        DB::transaction(function () use (
            $datos,
            $empleado
        ) {

            $incidencia = Incidencia::create([
                'empleado_id' =>
                    $empleado->id,

                'tipo' =>
                    $datos['tipo'],

                'fecha' =>
                    $datos['fecha'],
                
                'folio_incapacidad' =>
                    isset($datos['folio_incapacidad'])
                        ? trim($datos['folio_incapacidad'])
                        : null,

                'descripcion' =>
                    isset($datos['descripcion'])
                        ? trim($datos['descripcion'])
                        : null,

                'estado' =>
                    'pendiente',
            ]);

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Registró una incidencia de tipo ' .
                    $incidencia->tipo .
                    ' para el empleado ' .
                    $empleado->numero_control,
            ]);
        });

        return redirect()
            ->route('rh.incidencias.index')
            ->with(
                'success',
                'Incidencia registrada correctamente.'
            );
    }

    public function edit(Incidencia $incidencia)
    {
        if ($incidencia->estado !== 'pendiente') {

            return redirect()
                ->route('rh.incidencias.index')
                ->with(
                    'error',
                    'Solo se pueden editar incidencias pendientes.'
                );
        }

        $empleados = Empleado::query()
            ->where('estado', 'activo')
            ->orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->get();

        return view(
            'rh.incidencias.edit',
            compact(
                'incidencia',
                'empleados'
            )
        );
    }

    public function update(
    Request $request,
    Incidencia $incidencia
    )
    {
        if ($incidencia->estado !== 'pendiente') {

            return redirect()
                ->route('rh.incidencias.index')
                ->with(
                    'error',
                    'Solo se pueden editar incidencias pendientes.'
                );

        }

        $datos = $request->validate(

            [

                'empleado_id' => [
                    'required',
                    'exists:empleados,id',
                ],

                'tipo' => [
                    'required',
                    Rule::in([
                        'falta',
                        'retardo',
                        'permiso',
                        'incapacidad',
                    ]),
                ],

                'fecha' => [
                    'required',
                    'date',
                    'before_or_equal:today',
                ],

                'folio_incapacidad' => [

                    Rule::requiredIf(
                        $request->tipo === 'incapacidad'
                    ),

                    'nullable',
                    'string',
                    'max:100',

                ],

                'descripcion' => [
                    'nullable',
                    'string',
                    'max:2000',
                ],

            ],

            [

                'folio_incapacidad.required' =>
                    'El folio de incapacidad es obligatorio.',

                'folio_incapacidad.max' =>
                    'El folio no puede superar los 100 caracteres.',

            ]

        );


        $duplicada = Incidencia::query()

            ->where(
                'empleado_id',
                $datos['empleado_id']
            )

            ->where(
                'tipo',
                $datos['tipo']
            )

            ->where(
                'fecha',
                $datos['fecha']
            )

            ->whereKeyNot(
                $incidencia->id
            )

            ->exists();


        if ($duplicada) {

            return back()

                ->withInput()

                ->withErrors([

                    'fecha' =>
                        'Ya existe una incidencia igual para ese empleado.',

                ]);

        }


        $antes = $incidencia->getOriginal();


        DB::transaction(function () use (
            $incidencia,
            $datos,
            $antes
        ) {

            $incidencia->update([

                'empleado_id' =>
                    $datos['empleado_id'],

                'tipo' =>
                    $datos['tipo'],

                'fecha' =>
                    $datos['fecha'],

                'folio_incapacidad' =>
                    $datos['folio_incapacidad']
                        ?? null,

                'descripcion' =>
                    isset($datos['descripcion'])
                        ? trim($datos['descripcion'])
                        : null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | Conserva aquí el mismo método que ya usa tu proyecto.
            |--------------------------------------------------------------------------
            */

            ActividadService::registrar(

                'Actualizó la incidencia ID '
                . $incidencia->id,

                [

                    'id' => $incidencia->id,

                    'tipo' => $antes['tipo'] ?? null,

                    'estado' => $antes['estado'] ?? null,

                    'folio' => $antes['folio'] ?? null,

                ],

                [

                    'id' => $incidencia->id,

                    'tipo' => $incidencia->tipo,

                    'estado' => $incidencia->estado,

                    'folio' => $incidencia->folio,

                ]

            );

        });


        return redirect()

            ->route('rh.incidencias.index')

            ->with(
                'success',
                'Incidencia actualizada correctamente.'
            );

    }

    public function justificar(
        Incidencia $incidencia
    ) {
        if ($incidencia->estado !== 'pendiente') {

            return back()->with(
                'error',
                'Esta incidencia ya fue procesada.'
            );
        }

        DB::transaction(function () use (
            $incidencia
        ) {

            $incidencia->load('empleado');

            $incidencia->update([
                'estado' => 'justificada',
            ]);

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Justificó la incidencia de tipo ' .
                    $incidencia->tipo .
                    ' del empleado ' .
                    $incidencia->empleado->numero_control,
            ]);
        });

        return redirect()
            ->route('rh.incidencias.index')
            ->with(
                'success',
                'Incidencia justificada correctamente.'
            );
    }

    public function injustificar(
        Incidencia $incidencia
    ) {
        if ($incidencia->estado !== 'pendiente') {

            return back()->with(
                'error',
                'Esta incidencia ya fue procesada.'
            );
        }

        DB::transaction(function () use (
            $incidencia
        ) {

            $incidencia->load('empleado');

            $incidencia->update([
                'estado' => 'injustificada',
            ]);

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Marcó como injustificada la incidencia de tipo ' .
                    $incidencia->tipo .
                    ' del empleado ' .
                    $incidencia->empleado->numero_control,
            ]);
        });

        return redirect()
            ->route('rh.incidencias.index')
            ->with(
                'success',
                'Incidencia marcada como injustificada.'
            );
    }
}