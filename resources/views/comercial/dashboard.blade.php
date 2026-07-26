@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-graph-up-arrow me-2"></i>

                Dashboard Comercial

            </h2>

            <p class="gtri-page-subtitle">

                Resumen general de prospectos, clientes, cotizaciones y contratos.

            </p>

        </div>

    </div>

    <!-- INDICADORES PRINCIPALES -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Indicadores principales

        </div>

        <div class="row g-3">

            <!-- PROSPECTOS -->

            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Prospectos

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $prospectos }}

                            </div>

                            <small class="text-secondary">

                                Oportunidades registradas

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-person-lines-fill fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- CLIENTES -->

            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Clientes

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $clientes }}

                            </div>

                            <small class="text-secondary">

                                Clientes registrados

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-buildings fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- COTIZACIONES -->

            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Cotizaciones

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $cotizaciones }}

                            </div>

                            <small class="text-secondary">

                                Cotizaciones generadas

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-file-earmark-text fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- CONTRATOS ACTIVOS -->

            <div class="col-xl-3 col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Contratos activos

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $contratosActivos }}

                            </div>

                            <small class="text-secondary">

                                Contratos actualmente vigentes

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-file-earmark-check fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTRATOS PRÓXIMOS A VENCER -->

    <div class="gtri-section mb-0">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div class="gtri-section-title mb-0">

                <span>02</span>

                Contratos próximos a vencer

            </div>

            <span class="badge bg-danger">

                Próximos 60 días

            </span>

        </div>

        @if($contratosPorVencer->count())

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>

                                    Folio

                                </th>

                                <th>

                                    Cliente

                                </th>

                                <th>

                                    Fecha de vencimiento

                                </th>

                                <th>

                                    Días restantes

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($contratosPorVencer as $contrato)

                                @php

                                    $diasRestantes = (int) now()->diffInDays(
                                        $contrato->fecha_fin,
                                        false
                                    );

                                @endphp

                                <tr>

                                    <td>

                                        <span class="fw-semibold text-light">

                                            {{ $contrato->folio }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $contrato->cliente->razon_social }}

                                    </td>

                                    <td>

                                        <i class="bi bi-calendar-event me-1 text-warning"></i>

                                        {{ $contrato->fecha_fin->format('d/m/Y') }}

                                    </td>

                                    <td>

                                        @if($diasRestantes <= 15)

                                            <span class="badge bg-danger">

                                                {{ $diasRestantes }} días

                                            </span>

                                        @elseif($diasRestantes <= 30)

                                            <span class="badge bg-warning text-dark">

                                                {{ $diasRestantes }} días

                                            </span>

                                        @else

                                            <span class="badge bg-info text-dark">

                                                {{ $diasRestantes }} días

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div class="gtri-card text-center py-5">

                <i class="bi bi-shield-check fs-1 text-success d-block mb-3"></i>

                <h5 class="text-light mb-2">

                    Sin contratos próximos a vencer

                </h5>

                <p class="text-secondary mb-0">

                    No existen contratos con vencimiento dentro de los próximos 60 días.

                </p>

            </div>

        @endif

    </div>

</div>

@endsection