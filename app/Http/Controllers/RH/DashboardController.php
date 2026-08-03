<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\RH\Vacacion;
use App\Models\RH\Incidencia;

class DashboardController extends Controller
{
    /**
     * DASHBOARD PRINCIPAL RH
     */
    public function index()
    {
        $empleados_activos = Empleado::where(
            'estado',
            'activo'
        )->count();

        $empleados_inactivos = Empleado::where(
            'estado',
            'inactivo'
        )->count();

        $total_empleados = Empleado::count();

        $vacaciones_pendientes = Vacacion::where(
            'estado',
            'pendiente'
        )->count();

        $incidencias_pendientes = Incidencia::where(
            'estado',
            'pendiente'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | EXPEDIENTES INCOMPLETOS
        |--------------------------------------------------------------------------
        | withCount evita consultar los documentos empleado por empleado.
        */

        $totalDocumentosRequeridos = count(
            Empleado::DOCUMENTOS_RH
        );

        $expedientes_incompletos = Empleado::where(
            'estado',
            'activo'
        )
        ->withCount('documentos')
        ->get()
        ->filter(function ($empleado) use (
            $totalDocumentosRequeridos
        ) {

            return $empleado->documentos_count
                < $totalDocumentosRequeridos;

        })
        ->count();


        return view(
            'rh.dashboard.index',
            compact(
                'empleados_activos',
                'empleados_inactivos',
                'total_empleados',
                'vacaciones_pendientes',
                'incidencias_pendientes',
                'expedientes_incompletos'
            )
        );
    }


    /**
     * MOSTRAR EXPEDIENTES INCOMPLETOS
     */
    public function expedientesIncompletos()
    {
        /*
        |--------------------------------------------------------------------------
        | CARGA ANTICIPADA
        |--------------------------------------------------------------------------
        | with('documentos') evita una consulta por cada empleado.
        */

        $empleados = Empleado::with('documentos')
            ->where(
                'estado',
                'activo'
            )
            ->orderBy('nombre')
            ->get();


        $empleadosIncompletos = [];

        foreach ($empleados as $empleado) {

            $documentosEntregados = $empleado
                ->documentos
                ->pluck('nombre')
                ->toArray();

            $documentosFaltantes = array_diff(
                Empleado::DOCUMENTOS_RH,
                $documentosEntregados
            );

            if (! empty($documentosFaltantes)) {

                $empleadosIncompletos[] = [

                    'empleado' => $empleado,

                    'faltantes' => $documentosFaltantes,

                ];

            }
        }


        return view(
            'rh.dashboard.expedientes-incompletos',
            compact('empleadosIncompletos')
        );
    }
}