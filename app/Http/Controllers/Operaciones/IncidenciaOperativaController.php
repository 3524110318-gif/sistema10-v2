<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\IncidenciaOperativa;
use App\Models\Operaciones\Servicio;
use App\Models\Operaciones\Supervision;
use App\Services\ActividadService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class IncidenciaOperativaController extends Controller
{
    public function index()
    {
        $incidencias = IncidenciaOperativa::with([

            'servicio',

            'supervision.asignacion.empleado',

            'supervision.asignacion.plaza',

        ])
        ->latest()
        ->get();

        return view(
            'operaciones.incidencias.index',
            compact('incidencias')
        );
    }

    public function show(IncidenciaOperativa $incidencia)
    {
        $incidencia->load([

            'servicio',

            'supervision.asignacion.empleado',

            'supervision.asignacion.plaza',

        ]);

        return view(
            'operaciones.incidencias.show',
            compact('incidencia')
        );
    }

    public function create()
    {
        $servicios = Servicio::orderBy('nombre')->get();

        $supervisiones = Supervision::with([

            'asignacion.empleado',

            'asignacion.plaza',

        ])
        ->latest()
        ->get();

        return view(
            'operaciones.incidencias.create',
            compact(
                'servicios',
                'supervisiones'
            )
        );
    }

    public function createDesdeSupervision(
        Supervision $supervision
    )
    {
        if ($supervision->incidencia)
        {
            return redirect()
                ->route(
                    'operaciones.incidencias.index'
                )
                ->with(
                    'error',
                    'Esta supervisión ya tiene una incidencia registrada.'
                );
        }

        return view(
            'operaciones.incidencias.create',
            [

                'supervision' =>
                    $supervision,

                'servicios' =>
                    Servicio::orderBy('nombre')->get(),

                'supervisiones' =>
                    Supervision::with([

                        'asignacion.empleado',

                        'asignacion.plaza',

                    ])
                    ->latest()
                    ->get(),

            ]
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            [

                'servicio_id' => [
                    'required',
                    'integer',
                    'exists:servicios,id',
                ],

                'supervision_id' => [
                    'nullable',
                    'integer',
                    'exists:supervisions,id',
                    'unique:incidencia_operativas,supervision_id',
                ],

                'tipo' => [
                    'required',
                    Rule::in([

                        'ausencia',

                        'retardo',

                        'cliente',

                        'robo',

                        'accidente',

                        'novedad',

                    ]),
                ],

                'descripcion' => [
                    'required',
                    'string',
                ],

                'folio_fisico' => [
                    Rule::requiredIf(
                        in_array(
                            $request->tipo,
                            [
                                'robo',
                                'accidente',
                            ],
                            true
                        )
                    ),
                    'nullable',
                    'string',
                    'max:100',
                ],

            ],
            [

                'servicio_id.required' =>
                    'Debes seleccionar un servicio.',

                'servicio_id.exists' =>
                    'El servicio seleccionado no existe.',

                'supervision_id.exists' =>
                    'La supervisión seleccionada no existe.',

                'supervision_id.unique' =>
                    'La supervisión seleccionada ya tiene una incidencia registrada.',

                'tipo.required' =>
                    'Debes seleccionar el tipo de incidencia.',

                'tipo.in' =>
                    'El tipo de incidencia seleccionado no es válido.',

                'descripcion.required' =>
                    'Debes escribir la descripción de la incidencia.',

                'folio_fisico.required' =>
                    'El folio físico es obligatorio para robos y accidentes.',

                'folio_fisico.max' =>
                    'El folio físico no debe superar los 100 caracteres.',

            ]
        );

        $cantidadPalabras = str_word_count(
            strip_tags($datos['descripcion'])
        );

        if ($cantidadPalabras > 300)
        {
            throw ValidationException::withMessages(
                [

                    'descripcion' =>
                        'La descripción no puede superar las 300 palabras. Actualmente contiene '
                        . $cantidadPalabras
                        . ' palabras.',

                ]
            );
        }

        $incidencia = IncidenciaOperativa::create(
            [

                'servicio_id' =>
                    $datos['servicio_id'],

                'supervision_id' =>
                    $datos['supervision_id'] ?? null,

                'tipo' =>
                    $datos['tipo'],

                'descripcion' =>
                    $datos['descripcion'],

                'folio_fisico' =>
                    $datos['folio_fisico'] ?? null,

                'estado' =>
                    'abierta',

            ]
        );

        ActividadService::registrar(

            'Registró la incidencia operativa ID '
            . $incidencia->id,

            null,

            [

                'id' =>
                    $incidencia->id,

                'servicio_id' =>
                    $incidencia->servicio_id,

                'supervision_id' =>
                    $incidencia->supervision_id,

                'tipo' =>
                    $incidencia->tipo,

                'folio_fisico' =>
                    $incidencia->folio_fisico,

                'estado' =>
                    $incidencia->estado,

            ]

        );

        return redirect()
            ->route(
                'operaciones.incidencias.index'
            )
            ->with(
                'success',
                'La incidencia se registró correctamente.'
            );
    }

    public function cerrar(
        IncidenciaOperativa $incidencia
    )
    {
        if ($incidencia->estado === 'cerrada')
        {
            return redirect()
                ->route(
                    'operaciones.incidencias.index'
                )
                ->with(
                    'error',
                    'La incidencia ya se encuentra cerrada.'
                );
        }

        $valorAnterior = [

            'id' =>
                $incidencia->id,

            'estado' =>
                $incidencia->estado,

        ];

        $incidencia->update(
            [

                'estado' =>
                    'cerrada',

            ]
        );

        ActividadService::registrar(

            'Cerró la incidencia operativa ID '
            . $incidencia->id,

            $valorAnterior,

            [

                'id' =>
                    $incidencia->id,

                'estado' =>
                    'cerrada',

            ]

        );

        return redirect()
            ->route(
                'operaciones.incidencias.index'
            )
            ->with(
                'success',
                'La incidencia se cerró correctamente.'
            );
    }
}