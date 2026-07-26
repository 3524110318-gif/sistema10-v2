<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\RH\Empleado;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\Operaciones\Servicio;

class GerenciaController extends Controller
{
    /**
     * Muestra el dashboard principal de Gerencia.
     */
    public function dashboard()
    {
        /*
        |--------------------------------------------------------------------------
        | ESTADO DE FUERZA
        |--------------------------------------------------------------------------
        |
        | Total de empleados activos registrados en Recursos Humanos.
        |
        */

        $estadoFuerza = Empleado::where(
            'estado',
            'activo'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | COBERTURA OPERATIVA
        |--------------------------------------------------------------------------
        |
        | Se obtiene el total de plazas y se descuentan las plazas vacantes.
        |
        */

        $totalPlazas = PlazaOperativa::count();

        $plazasVacantes = PlazaOperativa::where(
            'estado',
            'vacante'
        )->count();

        $plazasCubiertas = $totalPlazas - $plazasVacantes;

        $coberturaOperativa = $totalPlazas > 0
            ? round(
                ($plazasCubiertas / $totalPlazas) * 100,
                2
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | ÍNDICE DE SALUD DEL SERVICIO
        |--------------------------------------------------------------------------
        |
        | Utiliza directamente el método calcularISS() que ya existe
        | en el modelo Servicio.
        |
        */

        $servicios = Servicio::with([
            'plazas',
            'incidencias',
        ])->get();

        $indiceSaludServicio = $servicios->count() > 0
            ? round(
                $servicios->avg(
                    fn ($servicio) => $servicio->calcularISS()
                ),
                2
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | ROTACIÓN CRÍTICA
        |--------------------------------------------------------------------------
        |
        | Se mantiene temporalmente en cero hasta revisar cómo se relacionan
        | las bajas de empleados con cada servicio.
        |
        */

        $rotacionCritica = 0;


        return view(
            'gerencia.dashboard',
            compact(
                'estadoFuerza',
                'indiceSaludServicio',
                'coberturaOperativa',
                'rotacionCritica',
                'totalPlazas',
                'plazasCubiertas',
                'plazasVacantes'
            )
        );
    }
}