@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-image me-2"></i>

                Detalle de la evidencia

            </h2>

            <p class="gtri-page-subtitle">

                Consulta la información y fotografía asociada a esta evidencia.

            </p>

        </div>

        <div class="d-flex gap-2 flex-wrap">

            <a
                href="{{ route(
                    'operaciones.evidencias.edit',
                    $evidencia
                ) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar

            </a>

            <a
                href="{{ route(
                    'operaciones.evidencias.index'
                ) }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Regresar

            </a>

        </div>

    </div>


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
                            $evidencia
                                ->supervision
                                ->asignacion
                                ->empleado
                                ->nombre
                        }}

                        {{
                            $evidencia
                                ->supervision
                                ->asignacion
                                ->empleado
                                ->apellido_paterno
                        }}

                        {{
                            $evidencia
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

                        {{
                            $evidencia
                                ->supervision
                                ->asignacion
                                ->plaza
                                ->servicio
                                ->nombre
                        }}

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
                            $evidencia
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

                        Fecha de supervisión

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $evidencia
                                ->supervision
                                ->fecha_supervision
                        }}

                    </div>

                </div>

            </div>


            {{-- TÍTULO --}}
            <div class="col-12">

                <div class="gtri-info-card">

                    <div class="gtri-info-label">

                        <i class="bi bi-card-heading me-2"></i>

                        Título

                    </div>

                    <div class="gtri-info-value">

                        {{ $evidencia->titulo }}

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

                {{
                    $evidencia->descripcion
                    ?: 'Sin descripción.'
                }}

            </div>

        </div>

    </div>


    {{-- FOTOGRAFÍA --}}
    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>03</span>

            Evidencia fotográfica

        </div>

        @if($evidencia->foto)

            <div
                class="
                    d-flex
                    justify-content-center
                    p-4
                    rounded-3
                "
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                <img
                    src="{{ asset(
                        'storage/' .
                        $evidencia->foto
                    ) }}"
                    class="img-fluid rounded shadow"
                    style="
                        max-width:650px;
                        max-height:550px;
                        object-fit:contain;
                        border:2px solid #D4AF37;
                    "
                    alt="{{ $evidencia->titulo }}"
                >

            </div>

        @else

            <div
                class="text-center py-5 rounded-3"
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                <i
                    class="
                        bi
                        bi-image
                        fs-1
                        text-secondary
                        d-block
                        mb-3
                    "
                ></i>

                <h5 class="text-light">

                    Sin fotografía

                </h5>

                <p class="text-secondary mb-0">

                    Esta evidencia no tiene una fotografía registrada.

                </p>

            </div>

        @endif

    </div>

</div>

@endsection