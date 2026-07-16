@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1 class="mb-4">

        inicio Operaciones

    </h1>

    <div class="card mt-4 shadow-sm">

            <div class="card-header bg-dark text-white">

                <strong>

                    🚨 Centro de Alertas

                </strong>

            </div>

            <div class="card-body">

                @forelse($alertas as $alerta)

                    <div
                        class="alert alert-{{ $alerta['tipo'] }}"
                    >

                        {{ $alerta['mensaje'] }}

                    </div>

                @empty

                    <div
                        class="alert alert-success mb-0"
                    >

                        No existen alertas operativas.

                    </div>

                @endforelse

            </div>

        </div>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Servicios Activos

                    </h6>

                    <h2>

                        {{ $serviciosActivos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Plazas Totales

                    </h6>

                    <h2>

                        {{ $plazasTotales }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Plazas Cubiertas

                    </h6>

                    <h2>

                        {{ $plazasCubiertas }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Plazas Vacantes

                    </h6>

                    <h2>

                        {{ $plazasVacantes }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Cobertura Global

                    </h6>

                    <h2>

                        {{ $coberturaGlobal }}%

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Supervisiones Totales

                    </h6>

                    <h2>

                        {{ $supervisiones }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Supervisiones Hoy

                    </h6>

                    <h2>

                        {{ $supervisionesHoy }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Incidencias Abiertas

                    </h6>

                    <h2>

                        {{ $incidenciasAbiertas }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Vehiculos Activos

                    </h6>

                    <h2>

                        {{ $vehiculosActivos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Vehiculos En Taller

                    </h6>

                    <h2>

                        {{ $vehiculosTaller }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Mantenimientos Vencidos

                    </h6>

                    <h2>

                        {{ $mantenimientosVencidos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Guardias Activos

                    </h6>

                    <h2>

                        {{ $guardiasActivos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Guardias Asignados

                    </h6>

                    <h2>

                        {{ $guardiasAsignados }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Guardias Disponibles

                    </h6>

                    <h2>

                        {{ $guardiasDisponibles }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>

                        Dobletes Activos

                    </h6>

                    <h2>

                        {{ $dobletesActivos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="card mt-4">

            <div class="card-header">

                <strong>

                    Riesgos de Cobertura

                </strong>

            </div>

            <div class="card-body">

                @forelse(
                    $riesgosCobertura
                    as $servicio
                )

                    <div
                        class="alert alert-warning"
                    >

                        <strong>

                            {{ $servicio->nombre }}

                        </strong>

                        tiene

                        {{
                            $servicio
                            ->plazas
                            ->where(
                                'estado',
                                'vacante'
                            )
                            ->count()
                        }}

                        plaza(s) vacante(s).

                    </div>

                @empty

                    <div
                        class="alert alert-success"
                    >

                        No existen riesgos de cobertura.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection
