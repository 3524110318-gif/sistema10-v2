@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- ENCABEZADO --}}
    <div class="mb-4">

        <h4 class="fw-bold mb-1">

            Resumen general del cumplimiento normativo REPSE.


        </h4>

    </div>


    {{-- TARJETAS --}}
    <div class="row g-3">

        {{-- TOTAL --}}
        <div class="col-md">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Total de expedientes

                            </p>

                            <h3 class="fw-bold mb-0">

                                {{ $total }}

                            </h3>

                        </div>

                        <div class="fs-2 text-primary">

                            <i class="bi bi-folder"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- CUMPLEN --}}
        <div class="col-md">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Cumplen

                            </p>

                            <h3 class="fw-bold text-success mb-0">

                                {{ $cumplen }}

                            </h3>

                        </div>

                        <div class="fs-2 text-success">

                            <i class="bi bi-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENDIENTES --}}
        <div class="col-md">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Pendientes

                            </p>

                            <h3 class="fw-bold text-warning mb-0">

                                {{ $pendientes }}

                            </h3>

                        </div>

                        <div class="fs-2 text-warning">

                            <i class="bi bi-exclamation-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BLOQUEADOS --}}
        <div class="col-md">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Bloqueados

                            </p>

                            <h3 class="fw-bold text-danger mb-0">

                                {{ $bloqueados }}

                            </h3>

                        </div>

                        <div class="fs-2 text-danger">

                            <i class="bi bi-lock"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- POR VENCER --}}
        <div class="col-md">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-1">

                                Cédulas por vencer

                            </p>

                            <h3 class="fw-bold text-warning mb-0">

                                {{ $porVencer }}

                            </h3>

                        </div>

                        <div class="fs-2 text-warning">

                            <i class="bi bi-calendar-event"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection