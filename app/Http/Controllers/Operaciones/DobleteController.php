<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Operaciones\Doblete;
use App\Models\RH\Empleado;
use App\Models\Operaciones\PlazaOperativa;

class DobleteController extends Controller
{
    public function index()
    {
        $dobletes = Doblete::with([
            'empleado',
            'plaza'
        ])->latest()->get();

        return view(
            'operaciones.dobletes.index',
            compact('dobletes')
        );
    }

    public function create()
    {
        $empleados = Empleado::with([
            'asignaciones.plaza.servicio'
        ])
        ->where(
            'estado',
            'activo'
        )->whereHas(
            'asignaciones',
            function ($query) {
                $query->where(
                    'estado',
                    'activa'
                );
            }
        )->get();

        $plazas = PlazaOperativa::with([
            'servicio',
            'asignaciones.empleado'
        ])
        ->where(
            'estado',
            'cubierta'
        )
        ->get();

        return view(
            'operaciones.dobletes.create',
            compact(
                'empleados',
                'plazas'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate(

            [

                'empleado_id' =>
                    'required|exists:empleados,id',

                'plaza_operativa_id' =>
                    'required|exists:plaza_operativas,id',

                'fecha' =>
                    'required|date|after_or_equal:today',

                'motivo' =>
                    'required',

            ],

            [

                'empleado_id.required' =>
                    'Selecciona un guardia de reemplazo.',

                'plaza_operativa_id.required' =>
                    'Selecciona una plaza a cubrir.',

                'fecha.required' =>
                    'Selecciona una fecha.',

                'fecha.after_or_equal' =>
                    'La fecha no puede ser anterior al día de hoy.',

                'motivo.required' =>
                    'Escribe el motivo del doblete.',

            ]

        );

        $existe = Doblete::where(
            'empleado_id',
            $request->empleado_id
        )
        ->where(
            'fecha',
            $request->fecha
        )
        ->where(
            'estado',
            'activo'
        )
        ->exists();

        if ($existe)
        {
            return back()
                ->withErrors([
                    'empleado_id' =>
                        'Este guardia ya tiene un doblete activo para esa fecha.'
                ])
                ->withInput();
        }

        $plazaOcupada = Doblete::where(
            'plaza_operativa_id',
            $request->plaza_operativa_id
        )
        ->where(
            'fecha',
            $request->fecha
        )
        ->where(
            'estado',
            'activo'
        )
        ->exists();

        if ($plazaOcupada)
        {
            return back()
                ->withErrors([

                    'plaza_operativa_id' =>
                        'Esta plaza ya tiene un doblete activo para esa fecha.'

                ])
                ->withInput();
        }

        Doblete::create([

            'empleado_id' =>
                $request->empleado_id,

            'plaza_operativa_id' =>
                $request->plaza_operativa_id,

            'guardia_ausente' =>
                $request->guardia_ausente,

            'fecha' =>
                $request->fecha,

            'motivo' =>
                $request->motivo,

            'estado' =>
                'activo',

        ]);

        return redirect()
            ->route(
                'operaciones.dobletes.index'
            );
    }

    public function finalizar(Doblete $doblete)
    {
        $doblete->update([

            'estado' =>
                'finalizado'

        ]);

        return back();
    }
}
