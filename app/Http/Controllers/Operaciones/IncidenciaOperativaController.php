<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operaciones\IncidenciaOperativa;
use App\Models\Operaciones\Servicio;
use App\Models\Operaciones\Supervision;

class IncidenciaOperativaController extends Controller
{
    public function index()
    {
        $incidencias = IncidenciaOperativa::with([
            'servicio',
            'supervision.asignacion.empleado',
            'supervision.asignacion.plaza',
        ])->latest()->get();

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
        $servicios = Servicio::all();

        $supervisiones = Supervision::with([
            'asignacion.empleado',
            'asignacion.plaza'
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

    public function createDesdeSupervision(Supervision $supervision)
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

                'supervision' => $supervision,

                'servicios' => Servicio::all(),

                'supervisiones' => Supervision::with([
                    'asignacion.empleado',
                    'asignacion.plaza'
                ])->latest()->get(),

            ]
        );
    }

    public function store(Request $request)
    {
        IncidenciaOperativa::create([

            'servicio_id' =>
                $request->servicio_id,

            'supervision_id' =>
                $request->supervision_id,

            'tipo' =>
                $request->tipo,

            'descripcion' =>
                $request->descripcion,

            'folio_fisico' =>
                $request->folio_fisico,

            'estado' =>
                'abierta',

        ]);

        return redirect()
            ->route(
                'operaciones.incidencias.index'
            );
    }

    public function cerrar(IncidenciaOperativa $incidencia)
    {
        $incidencia->update([

            'estado' => 'cerrada'

        ]);

        return redirect()
            ->route(
                'operaciones.incidencias.index'
            );
    }
}
