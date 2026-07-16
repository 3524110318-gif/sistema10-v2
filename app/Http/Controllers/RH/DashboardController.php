<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use App\Models\RH\Vacacion;
use App\Models\RH\Incidencia;
use App\Models\RH\Documento;

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

        $expedientes_incompletos = 0;

        foreach (Empleado::all() as $empleado) {

            $documentosEntregados =
                $empleado->documentos->count();

            if (
                $documentosEntregados
                <
                count(Empleado::DOCUMENTOS_RH)
            ) {

                $expedientes_incompletos++;

            }
        }
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

    public function expedientesIncompletos()
    {
        $empleadosIncompletos = [];

        foreach (Empleado::all() as $empleado) {

            $documentosEntregados =
                $empleado->documentos
                    ->pluck('nombre')
                    ->toArray();

            $documentosFaltantes =
                array_diff(
                    Empleado::DOCUMENTOS_RH,
                    $documentosEntregados
                );

            if (count($documentosFaltantes) > 0) {

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
