@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-clipboard-data me-2"></i>

                Detalle de supervisión

            </h2>

            <p class="gtri-page-subtitle">

                Consulta el resultado, evidencia e incidencias relacionadas.

            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route(
                    'operaciones.supervisiones.edit',
                    $supervision
                ) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar

            </a>

            <a
                href="{{ route(
                    'operaciones.supervisiones.index'
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

            Información de la supervisión

        </div>

        <div class="row g-3">

            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Guardia

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $supervision
                                ->asignacion
                                ->empleado
                                ->nombre
                        }}

                        {{
                            $supervision
                                ->asignacion
                                ->empleado
                                ->apellido_paterno
                        }}

                        {{
                            $supervision
                                ->asignacion
                                ->empleado
                                ->apellido_materno
                        }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Servicio

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $supervision
                                ->asignacion
                                ->plaza
                                ->servicio
                                ->nombre
                        }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Plaza

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $supervision
                                ->asignacion
                                ->plaza
                                ->nombre_plaza
                        }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Turno

                    </div>

                    <div class="gtri-info-value">

                        {{
                            ucfirst(
                                $supervision
                                    ->asignacion
                                    ->plaza
                                    ->turno
                            )
                        }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Fecha

                    </div>

                    <div class="gtri-info-value">

                        {{ $supervision->fecha_supervision }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Resultado

                    </div>

                    <div class="mt-2">

                        @if($supervision->resultado === 'correcto')

                            <span class="badge bg-success">

                                Correcto

                            </span>

                        @elseif($supervision->resultado === 'incidencia')

                            <span class="badge bg-warning text-dark">

                                Incidencia

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Ausente

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Observaciones

        </div>

        <div class="gtri-info-card">

            <div class="gtri-info-value">

                {{
                    $supervision->observaciones
                    ?: 'Sin observaciones.'
                }}

            </div>

        </div>

    </div>


    {{-- EVIDENCIA PRINCIPAL --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Evidencia fotográfica

        </div>

        @if($supervision->foto)

            <img
                src="{{ asset(
                    'storage/' .
                    $supervision->foto
                ) }}"
                class="rounded shadow"
                style="
                    max-width:420px;
                    width:100%;
                    max-height:350px;
                    object-fit:cover;
                    border:2px solid #D4AF37;
                "
            >

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
                        bi-camera
                        fs-1
                        text-secondary
                        d-block
                        mb-3
                    "
                ></i>

                <p class="text-secondary mb-0">

                    No existe evidencia fotográfica.

                </p>

            </div>

        @endif

    </div>


    {{-- INCIDENCIA --}}
    @if($supervision->resultado != 'correcto')

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Incidencia asociada

            </div>

            @if($supervision->incidencia)

                <a
                    href="{{ route(
                        'operaciones.incidencias.show',
                        $supervision->incidencia
                    ) }}"
                    class="btn btn-info"
                >

                    <i class="bi bi-eye me-1"></i>

                    Ver incidencia

                </a>

            @else

                <a
                    href="{{ route(
                        'operaciones.incidencias.create.supervision',
                        $supervision
                    ) }}"
                    class="btn btn-danger"
                >

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    Generar incidencia

                </a>

            @endif

        </div>

    @endif


    {{-- EVIDENCIAS RELACIONADAS --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                gap-2
                flex-wrap
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>05</span>

                Evidencias relacionadas

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $supervision->evidencias->count() }}

                </span>

            </div>

        </div>


        @if($supervision->evidencias->count())

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Título</th>

                                <th>Fotografía</th>

                                <th class="text-center">

                                    Acciones

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach(
                                $supervision->evidencias
                                as $evidencia
                            )

                                <tr>

                                    <td>

                                        <span class="text-light fw-semibold">

                                            {{ $evidencia->titulo }}

                                        </span>

                                    </td>

                                    <td>

                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $evidencia->foto
                                            ) }}"
                                            width="120"
                                            height="80"
                                            class="rounded"
                                            style="object-fit:cover;"
                                        >

                                    </td>

                                    <td class="text-center">

                                        <a
                                            href="{{ route(
                                                'operaciones.evidencias.show',
                                                $evidencia
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                        >

                                            <i class="bi bi-eye me-1"></i>

                                            Ver

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

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
                        bi-images
                        fs-1
                        text-secondary
                        d-block
                        mb-3
                    "
                ></i>

                <h5 class="text-light">

                    Sin evidencias relacionadas

                </h5>

                <p class="text-secondary mb-0">

                    Esta supervisión todavía no tiene evidencias adicionales.

                </p>

            </div>

        @endif

    </div>

</div>

@endsection