@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard de Administración

            </h2>

            <p class="gtri-page-subtitle">

                Resumen general de inventario, compras, facturación,
                cobranza, activos y prenómina.

            </p>

        </div>

    </div>


    {{-- INDICADORES --}}
    <div class="row g-3 mb-4">

        {{-- PRODUCTOS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Productos

                        </small>

                        <h2 class="fw-bold text-warning mt-2 mb-0">

                            {{ $totalProductos }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-box-seam"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- COMPRAS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Compras

                        </small>

                        <h2 class="fw-bold text-light mt-2 mb-0">

                            {{ $totalCompras }}

                        </h2>

                    </div>

                    <div class="fs-1 text-primary">

                        <i class="bi bi-cart-check"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- FACTURAS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Facturas

                        </small>

                        <h2 class="fw-bold text-light mt-2 mb-0">

                            {{ $totalFacturas }}

                        </h2>

                    </div>

                    <div class="fs-1 text-primary">

                        <i class="bi bi-receipt"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- COBRANZAS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Cobranzas

                        </small>

                        <h2 class="fw-bold text-light mt-2 mb-0">

                            {{ $totalCobranzas }}

                        </h2>

                    </div>

                    <div class="fs-1 text-success">

                        <i class="bi bi-cash-stack"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- ACTIVOS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Activos

                        </small>

                        <h2 class="fw-bold text-light mt-2 mb-0">

                            {{ $totalActivos }}

                        </h2>

                    </div>

                    <div class="fs-1 text-info">

                        <i class="bi bi-pc-display"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRENÓMINAS --}}
        <div class="col-md-4 col-xl-2">

            <div class="gtri-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Prenóminas

                        </small>

                        <h2 class="fw-bold text-light mt-2 mb-0">

                            {{ $totalPrenominas }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-calculator"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ALERTAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Alertas operativas

        </div>


        <div class="row g-3">

            {{-- STOCK CRÍTICO --}}
            <div class="col-md-4">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div class="fs-2 text-danger">

                            <i class="bi bi-exclamation-triangle"></i>

                        </div>

                        <div>

                            <small class="text-secondary">

                                Productos con stock crítico

                            </small>

                            <div class="mt-2">

                                @if($stockCritico > 0)

                                    <span class="badge gtri-badge-danger">

                                        {{ $stockCritico }} alerta(s)

                                    </span>

                                @else

                                    <span class="badge gtri-badge-success">

                                        Sin alertas

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- COBRANZAS VENCIDAS --}}
            <div class="col-md-4">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div class="fs-2 text-danger">

                            <i class="bi bi-calendar-x"></i>

                        </div>

                        <div>

                            <small class="text-secondary">

                                Cobranzas vencidas

                            </small>

                            <div class="mt-2">

                                @if($cobranzasVencidas > 0)

                                    <span class="badge gtri-badge-danger">

                                        {{ $cobranzasVencidas }} vencida(s)

                                    </span>

                                @else

                                    <span class="badge gtri-badge-success">

                                        Sin alertas

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PRENÓMINAS ABIERTAS --}}
            <div class="col-md-4">

                <div class="gtri-card h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div class="fs-2 text-warning">

                            <i class="bi bi-clock-history"></i>

                        </div>

                        <div>

                            <small class="text-secondary">

                                Prenóminas abiertas

                            </small>

                            <div class="mt-2">

                                @if($prenominasAbiertas > 0)

                                    <span class="badge gtri-badge-warning">

                                        {{ $prenominasAbiertas }} abierta(s)

                                    </span>

                                @else

                                    <span class="badge gtri-badge-success">

                                        Sin alertas

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection