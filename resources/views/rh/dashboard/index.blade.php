@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-people-fill me-2"></i>

                Recursos Humanos

            </h2>

            <p class="gtri-page-subtitle">

                Resumen general de empleados, vacaciones, incidencias y expedientes.

            </p>

        </div>

    </div>


    {{-- INDICADORES --}}
    <div class="row g-3">

        {{-- EMPLEADOS ACTIVOS --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="gtri-card h-100">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary">

                            Empleados activos

                        </small>

                        <h2 class="text-success fw-bold mt-2 mb-0">

                            {{ $empleados_activos }}

                        </h2>

                    </div>

                    <div class="fs-1 text-success">

                        <i class="bi bi-person-check-fill"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- VACACIONES PENDIENTES --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="gtri-card h-100">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary">

                            Vacaciones pendientes

                        </small>

                        <h2 class="text-warning fw-bold mt-2 mb-0">

                            {{ $vacaciones_pendientes }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-calendar2-week-fill"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- INCIDENCIAS PENDIENTES --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="gtri-card h-100">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary">

                            Incidencias pendientes

                        </small>

                        <h2 class="text-danger fw-bold mt-2 mb-0">

                            {{ $incidencias_pendientes }}

                        </h2>

                    </div>

                    <div class="fs-1 text-danger">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- EXPEDIENTES INCOMPLETOS --}}
        <div class="col-12 col-md-6 col-xl-4">

            <a
                href="{{ route('rh.expedientes.incompletos') }}"
                class="text-decoration-none d-block h-100"
            >

                <div class="gtri-card h-100">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                            gap-3
                        "
                    >

                        <div>

                            <small class="text-secondary">

                                Expedientes incompletos

                            </small>

                            <h2 class="text-warning fw-bold mt-2 mb-0">

                                {{ $expedientes_incompletos }}

                            </h2>

                        </div>

                        <div class="fs-1 text-warning">

                            <i class="bi bi-folder-x"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>


        {{-- EMPLEADOS INACTIVOS --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="gtri-card h-100">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary">

                            Empleados inactivos

                        </small>

                        <h2 class="text-danger fw-bold mt-2 mb-0">

                            {{ $empleados_inactivos }}

                        </h2>

                    </div>

                    <div class="fs-1 text-danger">

                        <i class="bi bi-person-x-fill"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL DE EMPLEADOS --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="gtri-card h-100">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary">

                            Total de empleados

                        </small>

                        <h2 class="text-info fw-bold mt-2 mb-0">

                            {{ $total_empleados }}

                        </h2>

                    </div>

                    <div class="fs-1 text-info">

                        <i class="bi bi-bar-chart-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection