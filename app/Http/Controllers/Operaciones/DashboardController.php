<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Asignacion;
use App\Models\Operaciones\Contrato;
use App\Models\Operaciones\Doblete;
use App\Models\Operaciones\IncidenciaOperativa;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\Operaciones\Servicio;
use App\Models\Operaciones\Supervision;
use App\Models\Operaciones\Vehiculo;
use App\Models\RH\Empleado;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Servicios
        |--------------------------------------------------------------------------
        */

        $serviciosActivos = Servicio::where(
            'estado',
            'activo'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Plazas
        |--------------------------------------------------------------------------
        */

        $plazasTotales =
            PlazaOperativa::count();

        $plazasCubiertas =
            PlazaOperativa::where(
                'estado',
                'cubierta'
            )->count();

        $plazasVacantes =
            PlazaOperativa::where(
                'estado',
                'vacante'
            )->count();

        $coberturaGlobal =
            $plazasTotales > 0
            ? round(
                (
                    $plazasCubiertas /
                    $plazasTotales
                ) * 100,
                2
            )
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Supervisiones
        |--------------------------------------------------------------------------
        */

        $supervisiones =
            Supervision::count();

        $supervisionesHoy =
            Supervision::whereDate(
                'fecha_supervision',
                today()
            )->count();

        /*
        |--------------------------------------------------------------------------
        | Incidencias
        |--------------------------------------------------------------------------
        */

        $incidenciasAbiertas =
            IncidenciaOperativa::where(
                'estado',
                'abierta'
            )->count();

        /*
        |--------------------------------------------------------------------------
        | Vehículos
        |--------------------------------------------------------------------------
        */

        $vehiculosActivos =
            Vehiculo::where(
                'estado',
                'activo'
            )->count();

        $vehiculosTaller =
            Vehiculo::where(
                'estado',
                'taller'
            )->count();

        $mantenimientosVencidos = 0;

        $vehiculos =
            Vehiculo::with(
                'mantenimientos'
            )->get();

        foreach ($vehiculos as $vehiculo)
        {
            $ultimo =
                $vehiculo
                ->mantenimientos
                ->sortByDesc('fecha')
                ->first();

            if (
                $ultimo &&
                $vehiculo->kilometraje_actual >=
                $ultimo->proximo_mantenimiento
            )
            {
                $mantenimientosVencidos++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Riesgos de Cobertura
        |--------------------------------------------------------------------------
        */

        $riesgosCobertura =
            Servicio::with(
                'plazas'
            )->get()->filter(
                function ($servicio)
                {
                    return
                        $servicio
                        ->plazas
                        ->where(
                            'estado',
                            'vacante'
                        )
                        ->count() > 0;
                }
            );

        /*
        |--------------------------------------------------------------------------
        | ISS
        |--------------------------------------------------------------------------
        */

        $issServicios =
            Servicio::with([
                'plazas',
                'incidencias'
            ])->get();

        /*
        |--------------------------------------------------------------------------
        | Guardias
        |--------------------------------------------------------------------------
        */

        $guardiasActivos =
            Empleado::where(
                'estado',
                'activo'
            )->count();

        $guardiasAsignados =
            Asignacion::where(
                'estado',
                'activa'
            )->count();

        $guardiasDisponibles =
            $guardiasActivos -
            $guardiasAsignados;

        /*
        |--------------------------------------------------------------------------
        | Dobletes
        |--------------------------------------------------------------------------
        */

        $dobletesActivos =
            Doblete::where(
                'estado',
                'activo'
            )->count();

                /*
        |--------------------------------------------------------------------------
        | Centro de Alertas
        |--------------------------------------------------------------------------
        */

        $alertas = collect();

        $contratosPorVencer = Contrato::where(
            'estado',
            'activo'
        )
        ->whereNotNull(
            'fecha_fin'
        )
        ->whereDate(
            'fecha_fin',
            '<=',
            Carbon::now()->addDays(60)
        )
        ->get();

        foreach (
            $contratosPorVencer
            as $contrato
        )
        {
            $dias = Carbon::now()
                ->diffInDays(
                    $contrato->fecha_fin,
                    false
                );

            $alertas->push([

                'tipo' =>
                    'danger',

                'mensaje' =>
                    'El contrato '
                    .
                    $contrato->numero_contrato
                    .
                    ' vence en '
                    .
                    $dias
                    .
                    ' día(s).',

            ]);
        }

        if (
            $incidenciasAbiertas > 0
        )
        {
            $alertas->push([

                'tipo' =>
                    'danger',

                'mensaje' =>
                    'Existen '
                    .
                    $incidenciasAbiertas
                    .
                    ' incidencia(s) abierta(s).',

            ]);
        }

        if (
            $mantenimientosVencidos > 0
        )
        {
            $alertas->push([

                'tipo' =>
                    'warning',

                'mensaje' =>
                    'Hay '
                    .
                    $mantenimientosVencidos
                    .
                    ' vehículo(s) que requieren mantenimiento.',

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Vista
        |--------------------------------------------------------------------------
        */

        return view(
            'operaciones.dashboard',
            compact(

                'serviciosActivos',

                'plazasTotales',

                'plazasCubiertas',

                'plazasVacantes',

                'coberturaGlobal',

                'supervisiones',

                'supervisionesHoy',

                'incidenciasAbiertas',

                'vehiculosActivos',

                'vehiculosTaller',

                'mantenimientosVencidos',

                'riesgosCobertura',

                'guardiasActivos',

                'guardiasAsignados',

                'guardiasDisponibles',

                'dobletesActivos',

                'alertas',

                'issServicios'

            )
        );
    }
}
