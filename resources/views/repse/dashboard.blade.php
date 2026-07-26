@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-shield-check me-2"></i>

                Dashboard REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Resumen general del cumplimiento normativo REPSE.

            </p>

        </div>

    </div>


    <!-- 01 · INDICADORES PRINCIPALES -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Indicadores principales

        </div>

        <div class="row g-3">

            <!-- TOTAL DE EXPEDIENTES -->

            <div class="col-xl col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Total de expedientes

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $total }}

                            </div>

                            <small class="text-secondary">

                                Expedientes registrados

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-folder2-open fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CUMPLEN -->

            <div class="col-xl col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Cumplen

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $cumplen }}

                            </div>

                            <small class="text-secondary">

                                Expedientes completos

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-check-circle fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- PENDIENTES -->

            <div class="col-xl col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Pendientes

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $pendientes }}

                            </div>

                            <small class="text-secondary">

                                Requieren atención

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-exclamation-circle fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- BLOQUEADOS -->

            <div class="col-xl col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Bloqueados

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $bloqueados }}

                            </div>

                            <small class="text-secondary">

                                Sin cumplimiento vigente

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-lock fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CÉDULAS POR VENCER -->

            <div class="col-xl col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="gtri-info-label">

                                Cédulas por vencer

                            </div>

                            <div class="gtri-info-value fs-2 fw-bold mt-2">

                                {{ $porVencer }}

                            </div>

                            <small class="text-secondary">

                                Próximas a vencer

                            </small>

                        </div>

                        <div class="gtri-stat-icon">

                            <i class="bi bi-calendar-event fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection