@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div class="d-flex align-items-center gap-3">

        <div class="gtri-logo-mark">

            <i class="bi bi-speedometer2"></i>

        </div>

        <div>

            <h1 class="gtri-page-title">

                Dashboard Ejecutivo

            </h1>

            <p class="gtri-page-subtitle">

                Centro de control general del sistema GTRI.

            </p>

        </div>

    </div>

</div>


<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div>

                    <div class="gtri-info-label">

                        Estado de Fuerza

                    </div>

                    <div class="gtri-info-value fs-3 fw-bold mt-1">

                        {{ $estadoFuerza }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-heart-pulse-fill"></i>

                </div>

                <div>

                    <div class="gtri-info-label">

                        Salud del Servicio

                    </div>

                    <div class="gtri-info-value fs-3 fw-bold mt-1">

                        {{ number_format($indiceSaludServicio, 2) }}%

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-shield-check"></i>

                </div>

                <div>

                    <div class="gtri-info-label">

                        Cobertura Operativa

                    </div>

                    <div class="gtri-info-value fs-3 fw-bold mt-1">

                        {{ number_format($coberturaOperativa, 2) }}%

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                </div>

                <div>

                    <div class="gtri-info-label">

                        Rotación Crítica

                    </div>

                    <div class="gtri-info-value fs-3 fw-bold mt-1">

                        {{ $rotacionCritica }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-6">

        <div class="gtri-card h-100">

            <h5 class="gtri-section-title">

                <span>

                    <i class="bi bi-building"></i>

                </span>

                Cobertura Operativa

            </h5>

            <table class="table gtri-table align-middle mb-0">

                <tbody>

                    <tr>

                        <th>Total de plazas</th>

                        <td class="text-end">

                            {{ $totalPlazas }}

                        </td>

                    </tr>

                    <tr>

                        <th>Plazas cubiertas</th>

                        <td class="text-end">

                            {{ $plazasCubiertas }}

                        </td>

                    </tr>

                    <tr>

                        <th>Plazas vacantes</th>

                        <td class="text-end text-danger fw-bold">

                            {{ $plazasVacantes }}

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="gtri-card h-100">

            <h5 class="gtri-section-title">

                <span>

                    <i class="bi bi-graph-up-arrow"></i>

                </span>

                Estado General

            </h5>

            <ul class="list-group list-group-flush">

                <li class="list-group-item bg-transparent text-light d-flex justify-content-between">

                    <span>Estado de Fuerza</span>

                    <strong>{{ $estadoFuerza }}</strong>

                </li>

                <li class="list-group-item bg-transparent text-light d-flex justify-content-between">

                    <span>Salud del Servicio</span>

                    <strong>{{ number_format($indiceSaludServicio,2) }}%</strong>

                </li>

                <li class="list-group-item bg-transparent text-light d-flex justify-content-between">

                    <span>Cobertura</span>

                    <strong>{{ number_format($coberturaOperativa,2) }}%</strong>

                </li>

            </ul>

        </div>

    </div>

</div>


<div class="gtri-section">

    <h5 class="gtri-section-title">

        <span>

            <i class="bi bi-bar-chart-fill"></i>

        </span>

        Resumen Gerencial

    </h5>

    <p class="gtri-page-subtitle">

        Los indicadores se conectarán con la información real de Recursos
        Humanos, Operaciones y Administración.

    </p>

</div>

@endsection