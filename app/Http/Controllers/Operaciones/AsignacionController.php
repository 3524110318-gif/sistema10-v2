<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Asignacion;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\RH\Empleado;
use App\Models\RH\Documento;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with([
            'empleado',
            'plaza'
        ])->latest()->get();

        return view(
            'operaciones.asignaciones.index',
            compact('asignaciones')
        );
    }

    public function create()
    {
        $empleados = Empleado::where(
            'estado',
            'activo'
        )
        ->whereDoesntHave(
            'asignaciones',
            function ($query)
            {
                $query->where(
                    'estado',
                    'activa'
                );
            }
        )
        ->get();

        foreach (
            $empleados as $empleado
        )
        {
            $documentosObligatorios = [

                'CURP',

                'RFC',

                'NSS',

                'Contrato laboral',

            ];

            $apto = true;

            foreach (
                $documentosObligatorios
                as $documento
            )
            {
                $existe = Documento::where(
                    'empleado_id',
                    $empleado->id
                )
                ->where(
                    'nombre',
                    $documento
                )
                ->where(
                    'entregado',
                    1
                )
                ->exists();

                if (!$existe)
                {
                    $apto = false;
                    break;
                }
            }

            $empleado->repse_apto =
                $apto;
        }

        $plazas = PlazaOperativa::where(
            'estado',
            'vacante'
        )->get();

        return view(
            'operaciones.asignaciones.create',
            compact(
                'empleados',
                'plazas'
            )
        );
    }

    public function store(Request $request)
    {
        $documentosObligatorios = [

            'CURP',

            'RFC',

            'NSS',

            'Contrato laboral',

        ];

        $faltantes = [];

        foreach (
            $documentosObligatorios
            as $documento
        ) {

            $existe = Documento::where(
                'empleado_id',
                $request->empleado_id
            )
            ->where(
                'nombre',
                $documento
            )
            ->where(
                'entregado',
                1
            )
            ->exists();

            if (!$existe) {

                $faltantes[] =
                    $documento;

            }
        }

        if (
            count($faltantes) > 0
        ) {

            return back()
                ->withErrors([

                    'repse' =>
                        'Empleado bloqueado por REPSE. Faltan: '
                        . implode(
                            ', ',
                            $faltantes
                        )

                ]);
        }

        $asignacionActiva = Asignacion::where(
            'empleado_id',
            $request->empleado_id
        )
        ->where(
            'estado',
            'activa'
        )
        ->exists();

        if ($asignacionActiva)
        {
            return back()
                ->with(
                    'error',
                    'El empleado ya tiene una asignación activa.'
                );
        }

        Asignacion::create([

            'plaza_operativa_id' =>
                $request->plaza_operativa_id,

            'empleado_id' =>
                $request->empleado_id,

            'fecha_inicio' =>
                $request->fecha_inicio,

            'estado' =>
                'activa',

        ]);

        PlazaOperativa::where(
            'id',
            $request->plaza_operativa_id
        )->update([

            'estado' => 'cubierta'

        ]);

        return redirect()
            ->route(
                'operaciones.asignaciones.index'
            );
    }
}
