<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Empleado;
use App\Models\RH\Vacacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\RH\CalendarioLaboral;

class VacacionController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim(
            $request->input('buscar', '')
        );

        $vacaciones = Vacacion::with('empleado')
            ->when(
                $buscar !== '',
                function ($consulta) use ($buscar) {

                    $consulta->where(function ($query) use ($buscar) {

                        $query
                            ->where(
                                'estado',
                                'like',
                                '%' . $buscar . '%'
                            )
                            ->orWhereHas(
                                'empleado',
                                function ($empleado) use ($buscar) {

                                    $empleado
                                        ->where(
                                            'nombre',
                                            'like',
                                            '%' . $buscar . '%'
                                        )
                                        ->orWhere(
                                            'apellido_paterno',
                                            'like',
                                            '%' . $buscar . '%'
                                        )
                                        ->orWhere(
                                            'apellido_materno',
                                            'like',
                                            '%' . $buscar . '%'
                                        )
                                        ->orWhere(
                                            'numero_control',
                                            'like',
                                            '%' . $buscar . '%'
                                        );

                                }
                            );

                    });

                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'rh.vacaciones.index',
            compact(
                'vacaciones',
                'buscar'
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
            ->get();

        return view(
            'rh.vacaciones.create',
            compact('empleados')
        );
    }

    public function edit(Vacacion $vacacion)
    {
        if ($vacacion->estado !== 'pendiente') {

            return redirect()
                ->route('rh.vacaciones.index')
                ->with(
                    'error',
                    'Solo pueden editarse solicitudes pendientes.'
                );

        }

        $empleados = Empleado::where(
            'estado',
            'activo'
        )
            ->orderBy('nombre')
            ->get();

        return view(
            'rh.vacaciones.edit',
            compact(
                'vacacion',
                'empleados'
            )
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

                'fecha_inicio' => [
                    'required',
                    'date',
                ],

                'fecha_fin' => [
                    'required',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'empleado_id.required' =>
                    'Debes seleccionar un empleado.',

                'empleado_id.exists' =>
                    'El empleado seleccionado no existe.',

                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_fin.required' =>
                    'La fecha de finalización es obligatoria.',

                'fecha_fin.after_or_equal' =>
                    'La fecha final no puede ser anterior a la fecha de inicio.',

                'observaciones.max' =>
                    'Las observaciones no deben superar los 1,000 caracteres.',
            ]
        );


        $fechaInicio = Carbon::parse(
            $datos['fecha_inicio']
        );

        $fechaFin = Carbon::parse(
            $datos['fecha_fin']
        );

        $totalDiasPeriodo =
            $fechaInicio->diffInDays(
                $fechaFin
            ) + 1;


        $diasNoLaborables = CalendarioLaboral::whereBetween(
            'fecha',
            [
                $fechaInicio->format('Y-m-d'),
                $fechaFin->format('Y-m-d'),
            ]
        )
            ->whereIn(
                'tipo',
                [
                    'festivo',
                    'descanso',
                ]
            )
            ->count();


        $datos['dias'] =
            $totalDiasPeriodo -
            $diasNoLaborables;


        if ($datos['dias'] <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El periodo seleccionado solamente contiene días festivos o de descanso.'
                );

        }

        $empleado = Empleado::findOrFail(
            $datos['empleado_id']
        );


        if ($empleado->estado !== 'activo') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No puedes registrar vacaciones para un empleado inactivo.'
                );

        }


        if (
            $datos['dias'] >
            $empleado->vacacionesRestantes()
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El empleado solamente tiene ' .
                    $empleado->vacacionesRestantes() .
                    ' días de vacaciones disponibles.'
                );

        }


        $periodoOcupado = Vacacion::where(
            'empleado_id',
            $empleado->id
        )
            ->whereIn(
                'estado',
                [
                    'pendiente',
                    'aprobada',
                ]
            )
            ->where(function ($consulta) use ($datos) {

                $consulta
                    ->whereBetween(
                        'fecha_inicio',
                        [
                            $datos['fecha_inicio'],
                            $datos['fecha_fin'],
                        ]
                    )
                    ->orWhereBetween(
                        'fecha_fin',
                        [
                            $datos['fecha_inicio'],
                            $datos['fecha_fin'],
                        ]
                    )
                    ->orWhere(function ($periodo) use ($datos) {

                        $periodo
                            ->where(
                                'fecha_inicio',
                                '<=',
                                $datos['fecha_inicio']
                            )
                            ->where(
                                'fecha_fin',
                                '>=',
                                $datos['fecha_fin']
                            );

                    });

            })
            ->exists();


        if ($periodoOcupado) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El empleado ya tiene una solicitud pendiente o aprobada que coincide con esas fechas.'
                );

        }


        DB::transaction(function () use (
            $datos,
            $empleado
        ) {

            $vacacion = Vacacion::create([

                'empleado_id' =>
                    $empleado->id,

                'fecha_inicio' =>
                    $datos['fecha_inicio'],

                'fecha_fin' =>
                    $datos['fecha_fin'],

                'dias' =>
                    $datos['dias'],

                'estado' =>
                    'pendiente',

                'observaciones' =>
                    $datos['observaciones'] ?? null,

            ]);


            LogActividad::create([

                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Registró solicitud de vacaciones de ' .
                    $vacacion->dias .
                    ' días para el empleado ' .
                    $empleado->numero_control,

            ]);

        });


        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Solicitud de vacaciones registrada correctamente.'
            );
    }

    public function update(Request $request, Vacacion $vacacion)
    {
        if ($vacacion->estado !== 'pendiente') {

            return redirect()
                ->route('rh.vacaciones.index')
                ->with(
                    'error',
                    'Solo pueden editarse solicitudes pendientes.'
                );

        }


        $datos = $request->validate(
            [
                'empleado_id' => [
                    'required',
                    'integer',
                    'exists:empleados,id',
                ],

                'fecha_inicio' => [
                    'required',
                    'date',
                ],

                'fecha_fin' => [
                    'required',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'empleado_id.required' =>
                    'Debes seleccionar un empleado.',

                'empleado_id.exists' =>
                    'El empleado seleccionado no existe.',

                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_fin.required' =>
                    'La fecha de finalización es obligatoria.',

                'fecha_fin.after_or_equal' =>
                    'La fecha final no puede ser anterior a la fecha de inicio.',

                'observaciones.max' =>
                    'Las observaciones no deben superar los 1,000 caracteres.',
            ]
        );


        $fechaInicio = Carbon::parse(
            $datos['fecha_inicio']
        );

        $fechaFin = Carbon::parse(
            $datos['fecha_fin']
        );


        $totalDiasPeriodo =
            $fechaInicio->diffInDays(
                $fechaFin
            ) + 1;


        $diasNoLaborables = CalendarioLaboral::whereBetween(
            'fecha',
            [
                $fechaInicio->format('Y-m-d'),
                $fechaFin->format('Y-m-d'),
            ]
        )
            ->whereIn(
                'tipo',
                [
                    'festivo',
                    'descanso',
                ]
            )
            ->count();


        $datos['dias'] =
            $totalDiasPeriodo -
            $diasNoLaborables;


        if ($datos['dias'] <= 0) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El periodo seleccionado solamente contiene días festivos o de descanso.'
                );

        }


        $empleado = Empleado::findOrFail(
            $datos['empleado_id']
        );


        if ($empleado->estado !== 'activo') {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'No puedes registrar vacaciones para un empleado inactivo.'
                );

        }


        if (
            $datos['dias'] >
            $empleado->vacacionesRestantes()
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El empleado solamente tiene ' .
                    $empleado->vacacionesRestantes() .
                    ' días de vacaciones disponibles.'
                );

        }


        $periodoOcupado = Vacacion::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'id',
                '!=',
                $vacacion->id
            )
            ->whereIn(
                'estado',
                [
                    'pendiente',
                    'aprobada',
                ]
            )
            ->where(function ($consulta) use ($datos) {

                $consulta
                    ->whereBetween(
                        'fecha_inicio',
                        [
                            $datos['fecha_inicio'],
                            $datos['fecha_fin'],
                        ]
                    )
                    ->orWhereBetween(
                        'fecha_fin',
                        [
                            $datos['fecha_inicio'],
                            $datos['fecha_fin'],
                        ]
                    )
                    ->orWhere(function ($periodo) use ($datos) {

                        $periodo
                            ->where(
                                'fecha_inicio',
                                '<=',
                                $datos['fecha_inicio']
                            )
                            ->where(
                                'fecha_fin',
                                '>=',
                                $datos['fecha_fin']
                            );

                    });

            })
            ->exists();


        if ($periodoOcupado) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'El empleado ya tiene una solicitud pendiente o aprobada que coincide con esas fechas.'
                );

        }


        DB::transaction(function () use (
            $datos,
            $empleado,
            $vacacion
        ) {

            $vacacion->update([

                'empleado_id' =>
                    $empleado->id,

                'fecha_inicio' =>
                    $datos['fecha_inicio'],

                'fecha_fin' =>
                    $datos['fecha_fin'],

                'dias' =>
                    $datos['dias'],

                'estado' =>
                    'pendiente',

                'observaciones' =>
                    isset($datos['observaciones'])
                        ? trim($datos['observaciones'])
                        : null,

            ]);


            LogActividad::create([

                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Actualizó solicitud de vacaciones de ' .
                    $vacacion->dias .
                    ' días para el empleado ' .
                    $empleado->numero_control,

            ]);

        });


        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Solicitud de vacaciones actualizada correctamente.'
            );
    }

    public function aprobar(Vacacion $vacacion)
    {
        if ($vacacion->estado !== 'pendiente') {

            return back()->with(
                'error',
                'Solamente pueden aprobarse solicitudes pendientes.'
            );

        }

        DB::transaction(function () use ($vacacion) {

            $solicitud = Vacacion::with('empleado')
                ->lockForUpdate()
                ->findOrFail($vacacion->id);

            if ($solicitud->estado !== 'pendiente') {

                abort(
                    409,
                    'La solicitud ya fue procesada.'
                );

            }

            $empleado = Empleado::lockForUpdate()
                ->findOrFail(
                    $solicitud->empleado_id
                );

            if ($empleado->estado !== 'activo') {

                abort(
                    422,
                    'No pueden aprobarse vacaciones de un empleado inactivo.'
                );

            }

            if (
                $solicitud->dias >
                $empleado->vacacionesRestantes()
            ) {

                abort(
                    422,
                    'El empleado ya no cuenta con días suficientes.'
                );

            }

            $solicitud->update([
                'estado' => 'aprobada',
            ]);

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Aprobó vacaciones del empleado ' .
                    $empleado->numero_control .
                    ' por ' .
                    $solicitud->dias .
                    ' días',
            ]);

        });

        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Vacaciones aprobadas correctamente.'
            );
    }

    public function rechazar(Vacacion $vacacion)
    {
        if ($vacacion->estado !== 'pendiente') {

            return back()->with(
                'error',
                'Solamente pueden rechazarse solicitudes pendientes.'
            );

        }

        DB::transaction(function () use ($vacacion) {

            $vacacion->update([
                'estado' => 'rechazada',
            ]);

            $vacacion->load('empleado');

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Rechazó vacaciones del empleado ' .
                    $vacacion->empleado->numero_control .
                    ' por ' .
                    $vacacion->dias .
                    ' días',
            ]);

        });

        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Vacaciones rechazadas correctamente.'
            );
    }

    public function cancelar(Vacacion $vacacion)
    {
        if ($vacacion->estado !== 'pendiente') {

            return back()->with(
                'error',
                'Solamente pueden cancelarse solicitudes pendientes.'
            );

        }

        DB::transaction(function () use ($vacacion) {

            $vacacion->update([
                'estado' => 'cancelada',
            ]);

            $vacacion->load('empleado');

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Canceló la solicitud de vacaciones del empleado ' .
                    $vacacion->empleado->numero_control .
                    ' por ' .
                    $vacacion->dias .
                    ' días',
            ]);

        });

        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Solicitud cancelada correctamente.'
            );
    }
}