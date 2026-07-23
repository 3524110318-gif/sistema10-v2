<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Asignacion;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with([
            'empleado',
            'plaza'
        ])
        ->latest()
        ->get();

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
        ->with('repse')
        ->get();


        foreach ($empleados as $empleado)
        {
            /*
            
            | VALIDACIÓN REPSE
            |--------------------------------------------------------------------------
            |
            | El empleado solo es apto si:
            |
            | 1. Tiene expediente REPSE
            | 2. Cumple los 4 requisitos
            |
            */

            $empleado->repse_apto =
                $empleado->repse &&
                $empleado->repse->cumpleRequisitos();


            /*
            |--------------------------------------------------------------------------
            | DOCUMENTOS FALTANTES
            |--------------------------------------------------------------------------
            */

            if (!$empleado->repse)
            {
                $empleado->repse_faltantes = [
                    'Expediente REPSE no registrado'
                ];
            }
            else
            {
                $empleado->repse_faltantes =
                    $empleado
                        ->repse
                        ->documentosFaltantes();
            }
        }


        $plazas = PlazaOperativa::where(
            'estado',
            'vacante'
        )
        ->get();


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
        /*
        
        | VALIDACIÓN DE DATOS
        
        */

        $request->validate([

            'empleado_id' =>
                'required|exists:empleados,id',

            'plaza_operativa_id' =>
                'required|exists:plaza_operativas,id',

            'fecha_inicio' =>
                'required|date',

        ]);


        /*
        
        | BUSCAR EMPLEADO CON REPSE
        
        */

        $empleado = Empleado::with('repse')
            ->findOrFail(
                $request->empleado_id
            );


        /*
        
        | BLOQUEO SI NO TIENE EXPEDIENTE REPSE
        
        */

        if (!$empleado->repse)
        {
            return back()
                ->withInput()
                ->withErrors([

                    'repse' =>
                        'Empleado bloqueado por REPSE. '
                        . 'No tiene un expediente REPSE registrado.'

                ]);
        }


        /*
        
        | BLOQUEO POR INCUMPLIMIENTO REPSE
        
        */

        if (
            !$empleado
                ->repse
                ->cumpleRequisitos()
        )
        {
            $faltantes =
                $empleado
                    ->repse
                    ->documentosFaltantes();


            return back()
                ->withInput()
                ->withErrors([

                    'repse' =>
                        'Empleado bloqueado por REPSE. '
                        . 'Faltan los siguientes requisitos: '
                        . implode(
                            ', ',
                            $faltantes
                        )

                ]);
        }


        /*
        
        | VALIDAR ASIGNACIÓN ACTIVA
        
        */

        $asignacionActiva =
            Asignacion::where(
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
                ->withInput()
                ->with(
                    'error',
                    'El empleado ya tiene una asignación activa.'
                );
        }


        /*
        
        | VALIDAR QUE LA PLAZA SIGA VACANTE
        
        */

        $plaza = PlazaOperativa::where(
            'id',
            $request->plaza_operativa_id
        )
        ->where(
            'estado',
            'vacante'
        )
        ->first();


        if (!$plaza)
        {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'La plaza seleccionada ya no está disponible.'
                );
        }


        /*
        
        | CREAR ASIGNACIÓN
        
        */

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


        /*
        
        | MARCAR PLAZA COMO CUBIERTA
        
        */

        $plaza->update([

            'estado' => 'cubierta'

        ]);


        return redirect()
            ->route(
                'operaciones.asignaciones.index'
            )
            ->with(
                'success',
                'Empleado asignado correctamente.'
            );
    }
}