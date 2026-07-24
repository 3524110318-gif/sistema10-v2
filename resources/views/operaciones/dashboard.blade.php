@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-speedometer2 me-2"></i>

                Datos Generales de Operaciones

            </h2>

            <p class="gtri-page-subtitle">

                Consulta el estado general de servicios, plazas, supervisiones,
                incidencias, vehículos y personal operativo.

            </p>

        </div>

    </div>


    {{-- CENTRO DE ALERTAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Centro de alertas

        </div>


        <div class="row g-3">

            @forelse($alertas as $alerta)

                <div class="col-12">

                    <div
                        class="
                            alert
                            alert-{{ $alerta['tipo'] }}
                            mb-0
                            d-flex
                            align-items-center
                            gap-2
                        "
                    >

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        <span>

                            {{ $alerta['mensaje'] }}

                        </span>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div
                        class="
                            alert
                            alert-success
                            mb-0
                            d-flex
                            align-items-center
                            gap-2
                        "
                    >

                        <i class="bi bi-check-circle-fill"></i>

                        <span>

                            No existen alertas operativas.

                        </span>

                    </div>

                </div>

            @endforelse

        </div>

    </div>


    {{-- INDICADORES PRINCIPALES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Indicadores principales

        </div>


        <div class="row g-4">

            {{-- SERVICIOS ACTIVOS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Servicios activos

                            </div>

                            <div class="display-6 fw-bold text-light mt-2">

                                {{ $serviciosActivos }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-building-check"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PLAZAS TOTALES --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Plazas totales

                            </div>

                            <div class="display-6 fw-bold text-light mt-2">

                                {{ $plazasTotales }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-geo-alt"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PLAZAS CUBIERTAS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Plazas cubiertas

                            </div>

                            <div class="display-6 fw-bold text-success mt-2">

                                {{ $plazasCubiertas }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PLAZAS VACANTES --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Plazas vacantes

                            </div>

                            <div class="display-6 fw-bold text-danger mt-2">

                                {{ $plazasVacantes }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-exclamation-circle"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- COBERTURA GLOBAL --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Cobertura global

                            </div>

                            <div class="display-6 fw-bold text-warning mt-2">

                                {{ $coberturaGlobal }}%

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-pie-chart"></i>

                        </div>

                    </div>


                    <div class="progress mt-3">

                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="
                                width:
                                {{ min(100, $coberturaGlobal) }}%;
                                background:#D4AF37;
                            "
                            aria-valuenow="{{ $coberturaGlobal }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        ></div>

                    </div>

                </div>

            </div>


            {{-- SUPERVISIONES TOTALES --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Supervisiones totales

                            </div>

                            <div class="display-6 fw-bold text-light mt-2">

                                {{ $supervisiones }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-clipboard-check"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SUPERVISIONES HOY --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Supervisiones hoy

                            </div>

                            <div class="display-6 fw-bold text-info mt-2">

                                {{ $supervisionesHoy }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- INCIDENCIAS ABIERTAS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >

                        <div>

                            <div class="text-secondary small">

                                Incidencias abiertas

                            </div>

                            <div class="display-6 fw-bold text-danger mt-2">

                                {{ $incidenciasAbiertas }}

                            </div>

                        </div>


                        <div class="gtri-stat-icon">

                            <i class="bi bi-exclamation-triangle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- RECURSOS OPERATIVOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Recursos operativos

        </div>


        <div class="row g-4">

            {{-- VEHÍCULOS ACTIVOS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Vehículos activos

                    </div>

                    <div class="display-6 fw-bold text-success mt-2">

                        {{ $vehiculosActivos }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-car-front fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- VEHÍCULOS EN TALLER --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Vehículos en taller

                    </div>

                    <div class="display-6 fw-bold text-warning mt-2">

                        {{ $vehiculosTaller }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-wrench-adjustable fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- MANTENIMIENTOS VENCIDOS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Mantenimientos vencidos

                    </div>

                    <div class="display-6 fw-bold text-danger mt-2">

                        {{ $mantenimientosVencidos }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-tools fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- DOBLETES ACTIVOS --}}
            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Dobletes activos

                    </div>

                    <div class="display-6 fw-bold text-light mt-2">

                        {{ $dobletesActivos }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-clock-history fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- GUARDIAS ACTIVOS --}}
            <div class="col-xl-4 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Guardias activos

                    </div>

                    <div class="display-6 fw-bold text-light mt-2">

                        {{ $guardiasActivos }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-shield-check fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- GUARDIAS ASIGNADOS --}}
            <div class="col-xl-4 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Guardias asignados

                    </div>

                    <div class="display-6 fw-bold text-info mt-2">

                        {{ $guardiasAsignados }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-person-check fs-3"></i>

                    </div>

                </div>

            </div>


            {{-- GUARDIAS DISPONIBLES --}}
            <div class="col-xl-4 col-md-6">

                <div class="gtri-card h-100">

                    <div class="text-secondary small">

                        Guardias disponibles

                    </div>

                    <div class="display-6 fw-bold text-success mt-2">

                        {{ $guardiasDisponibles }}

                    </div>

                    <div class="mt-3 text-warning">

                        <i class="bi bi-person-plus fs-3"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- RIESGOS DE COBERTURA --}}
    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>04</span>

            Riesgos de cobertura

        </div>


        <div class="row g-3">

            @forelse(
                $riesgosCobertura
                as $servicio
            )

                <div class="col-md-6">

                    <div
                        class="
                            p-4
                            rounded-3
                            h-100
                        "
                        style="
                            background:#111827;
                            border:
                                1px solid
                                rgba(212,175,55,.30);
                        "
                    >

                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-start
                                gap-3
                            "
                        >

                            <div>

                                <h5 class="text-light mb-1">

                                    {{ $servicio->nombre }}

                                </h5>

                                <p class="text-secondary mb-0">

                                    Presenta plazas sin cobertura.

                                </p>

                            </div>


                            <span
                                class="
                                    badge
                                    bg-warning
                                    text-dark
                                    fs-6
                                "
                            >

                                {{
                                    $servicio
                                    ->plazas
                                    ->where(
                                        'estado',
                                        'vacante'
                                    )
                                    ->count()
                                }}

                            </span>

                        </div>


                        <div class="mt-3 text-warning">

                            <i class="bi bi-exclamation-triangle me-1"></i>

                            plaza(s) vacante(s)

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div
                        class="
                            p-4
                            rounded-3
                            text-center
                        "
                        style="
                            background:#111827;
                            border:
                                1px solid
                                rgba(255,255,255,.08);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-shield-check
                                fs-1
                                text-success
                                d-block
                                mb-3
                            "
                        ></i>

                        <h5 class="text-light">

                            Sin riesgos de cobertura

                        </h5>

                        <p class="text-secondary mb-0">

                            Actualmente todos los servicios cuentan
                            con cobertura suficiente.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection