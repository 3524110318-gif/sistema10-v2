@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-diamond me-2"></i>

                Detalle de la incidencia

            </h2>

            <p class="gtri-page-subtitle">

                Consulta la información completa de la incidencia operativa.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.incidencias.index'
            ) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    @if($incidencia->supervision)

        {{-- INFORMACIÓN GENERAL --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información general

            </div>


            <div class="row g-3">

                {{-- GUARDIA --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            <i class="bi bi-person-badge me-2"></i>

                            Guardia

                        </div>

                        <div class="gtri-info-value">

                            {{
                                $incidencia
                                    ->supervision
                                    ->asignacion
                                    ->empleado
                                    ->nombre
                            }}

                            {{
                                $incidencia
                                    ->supervision
                                    ->asignacion
                                    ->empleado
                                    ->apellido_paterno
                            }}

                            {{
                                $incidencia
                                    ->supervision
                                    ->asignacion
                                    ->empleado
                                    ->apellido_materno
                            }}

                        </div>

                    </div>

                </div>


                {{-- SERVICIO --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            <i class="bi bi-building me-2"></i>

                            Servicio

                        </div>

                        <div class="gtri-info-value">

                            {{ $incidencia->servicio->nombre }}

                        </div>

                    </div>

                </div>


                {{-- PLAZA --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            <i class="bi bi-geo-alt me-2"></i>

                            Plaza

                        </div>

                        <div class="gtri-info-value">

                            {{
                                $incidencia
                                    ->supervision
                                    ->asignacion
                                    ->plaza
                                    ->nombre_plaza
                            }}

                        </div>

                    </div>

                </div>


                {{-- FECHA --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            <i class="bi bi-calendar3 me-2"></i>

                            Fecha

                        </div>

                        <div class="gtri-info-value">

                            {{
                                $incidencia
                                    ->supervision
                                    ->fecha_supervision
                            }}

                        </div>

                    </div>

                </div>


                {{-- TIPO --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Tipo de incidencia

                        </div>

                        <div class="mt-2">

                            <span class="badge bg-secondary">

                                {{ ucfirst($incidencia->tipo) }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ESTADO --}}
                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Estado

                        </div>

                        <div class="mt-2">

                            @if($incidencia->estado === 'abierta')

                                <span class="badge bg-danger">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    Abierta

                                </span>

                            @else

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Cerrada

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DESCRIPCIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Descripción

            </div>

            <div class="gtri-info-card">

                <div class="gtri-info-value">

                    {{ $incidencia->descripcion }}

                </div>

            </div>

        </div>


        {{-- FOLIO --}}
        <div class="gtri-section mb-0">

            <div class="gtri-section-title">

                <span>03</span>

                Folio físico

            </div>

            <div class="gtri-info-card">

                <div class="gtri-info-label">

                    Número de folio

                </div>

                <div class="gtri-info-value">

                    {{
                        $incidencia->folio_fisico
                        ?: 'Sin folio físico registrado'
                    }}

                </div>

            </div>

        </div>

    @else

        {{-- INCIDENCIA MANUAL --}}
        <div class="gtri-section mb-0">

            <div class="gtri-section-title">

                <span>01</span>

                Incidencia registrada manualmente

            </div>

            <div
                class="rounded-3 p-4"
                style="
                    background:#111827;
                    border:1px solid rgba(212,175,55,.30);
                "
            >

                <div class="d-flex align-items-start gap-3">

                    <i
                        class="
                            bi
                            bi-info-circle
                            text-warning
                            fs-3
                        "
                    ></i>

                    <div>

                        <h5 class="text-light">

                            Sin supervisión relacionada

                        </h5>

                        <p class="text-secondary mb-0">

                            Esta incidencia fue registrada manualmente
                            y no está relacionada con una supervisión.

                        </p>

                    </div>

                </div>

            </div>


            <div class="row g-3 mt-1">

                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Servicio

                        </div>

                        <div class="gtri-info-value">

                            {{ $incidencia->servicio->nombre }}

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Tipo

                        </div>

                        <div class="gtri-info-value">

                            {{ ucfirst($incidencia->tipo) }}

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Estado

                        </div>

                        <div class="mt-2">

                            @if($incidencia->estado === 'abierta')

                                <span class="badge bg-danger">

                                    Abierta

                                </span>

                            @else

                                <span class="badge bg-success">

                                    Cerrada

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Folio físico

                        </div>

                        <div class="gtri-info-value">

                            {{
                                $incidencia->folio_fisico
                                ?: 'Sin folio'
                            }}

                        </div>

                    </div>

                </div>


                <div class="col-12">

                    <div class="gtri-info-card">

                        <div class="gtri-info-label">

                            Descripción

                        </div>

                        <div class="gtri-info-value">

                            {{ $incidencia->descripcion }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection