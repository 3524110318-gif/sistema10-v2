@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-building-check me-2"></i>

                {{ $servicio->nombre }}

            </h2>

            <p class="gtri-page-subtitle">

                Consulta el estado, cobertura y actividad operativa del servicio.

            </p>

        </div>

        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route(
                    'operaciones.servicios.edit',
                    $servicio
                ) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar

            </a>

            <a
                href="{{ route(
                    'operaciones.servicios.index'
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

        <div class="row g-4">

            {{-- CLIENTE --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-buildings me-2"></i>

                        Cliente

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $servicio
                                ->contrato
                                ->cliente
                                ->razon_social
                        }}

                    </div>

                </div>

            </div>


            {{-- CONTRATO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Contrato

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $servicio
                                ->contrato
                                ->numero_contrato
                        }}

                    </div>

                </div>

            </div>


            {{-- MUNICIPIO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-geo-alt me-2"></i>

                        Municipio

                    </div>

                    <div class="gtri-info-value">

                        {{
                            $servicio->municipio
                            ?: 'No registrado'
                        }}

                    </div>

                </div>

            </div>


            {{-- ESTADO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-activity me-2"></i>

                        Estado

                    </div>

                    <div class="mt-2">

                        @if($servicio->estado === 'activo')

                            <span class="badge bg-success">

                                Activo

                            </span>

                        @elseif($servicio->estado === 'suspendido')

                            <span class="badge bg-warning text-dark">

                                Suspendido

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Finalizado

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- INDICADORES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Indicadores operativos

        </div>

        <div class="row g-3">

            {{-- PLAZAS TOTALES --}}
            <div class="col-xl col-md-4 col-sm-6">

                <div class="gtri-info-card h-100 text-center">

                    <div class="gtri-info-label">

                        Plazas totales

                    </div>

                    <div
                        class="fw-bold mt-2"
                        style="
                            color:#F8FAFC;
                            font-size:2rem;
                        "
                    >

                        {{ $totalPlazas }}

                    </div>

                </div>

            </div>


            {{-- CUBIERTAS --}}
            <div class="col-xl col-md-4 col-sm-6">

                <div class="gtri-info-card h-100 text-center">

                    <div class="gtri-info-label">

                        Cubiertas

                    </div>

                    <div
                        class="fw-bold mt-2 text-success"
                        style="font-size:2rem;"
                    >

                        {{ $cubiertas }}

                    </div>

                </div>

            </div>


            {{-- VACANTES --}}
            <div class="col-xl col-md-4 col-sm-6">

                <div class="gtri-info-card h-100 text-center">

                    <div class="gtri-info-label">

                        Vacantes

                    </div>

                    <div
                        class="fw-bold mt-2 text-danger"
                        style="font-size:2rem;"
                    >

                        {{ $vacantes }}

                    </div>

                </div>

            </div>


            {{-- COBERTURA --}}
            <div class="col-xl col-md-6 col-sm-6">

                <div class="gtri-info-card h-100 text-center">

                    <div class="gtri-info-label">

                        Cobertura

                    </div>

                    <div
                        class="fw-bold mt-2"
                        style="
                            color:#D4AF37;
                            font-size:2rem;
                        "
                    >

                        {{ $cobertura }}%

                    </div>

                </div>

            </div>


            {{-- ISS --}}
            <div class="col-xl col-md-6 col-sm-6">

                <div class="gtri-info-card h-100 text-center">

                    <div class="gtri-info-label">

                        ISS

                    </div>

                    <div
                        class="fw-bold mt-2"
                        style="
                            color:#60A5FA;
                            font-size:2rem;
                        "
                    >

                        {{ $servicio->calcularISS() }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- COBERTURA OPERATIVA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Cobertura operativa

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Plaza</th>

                            <th>Turno</th>

                            <th>Estado</th>

                            <th>Empleado</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $servicio->plazas
                            as $plaza
                        )

                            <tr>

                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $plaza->nombre_plaza }}

                                    </span>

                                </td>

                                <td>

                                    {{ ucfirst($plaza->turno) }}

                                </td>

                                <td>

                                    @if($plaza->estado === 'cubierta')

                                        <span class="badge bg-success">

                                            Cubierta

                                        </span>

                                    @elseif($plaza->estado === 'vacante')

                                        <span class="badge bg-danger">

                                            Vacante

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst($plaza->estado) }}

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if(
                                        $plaza
                                            ->asignaciones
                                            ->count()
                                    )

                                        <i class="bi bi-person-check me-1 text-success"></i>

                                        {{
                                            $plaza
                                                ->asignaciones
                                                ->first()
                                                ->empleado
                                                ->nombre
                                        }}

                                        {{
                                            $plaza
                                                ->asignaciones
                                                ->first()
                                                ->empleado
                                                ->apellido_paterno
                                        }}

                                    @else

                                        <span class="text-secondary">

                                            <i class="bi bi-person-x me-1"></i>

                                            Sin asignar

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-4"
                                >

                                    <span class="text-secondary">

                                        No existen plazas registradas para este servicio.

                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- SUPERVISIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

            Supervisiones

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Fecha</th>

                            <th>Resultado</th>

                            <th>Observaciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $supervisiones
                            as $supervision
                        )

                            <tr>

                                <td>

                                    {{ $supervision->fecha_supervision }}

                                </td>

                                <td>

                                    <span class="badge bg-secondary">

                                        {{
                                            ucfirst(
                                                $supervision->resultado
                                            )
                                        }}

                                    </span>

                                </td>

                                <td>

                                    {{
                                        $supervision->observaciones
                                        ?: 'Sin observaciones'
                                    }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-4"
                                >

                                    <span class="text-secondary">

                                        No existen supervisiones registradas.

                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- INCIDENCIAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>05</span>

            Incidencias operativas

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Tipo</th>

                            <th>Estado</th>

                            <th>Descripción</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $servicio->incidencias
                            as $incidencia
                        )

                            <tr>

                                <td>

                                    <span class="text-light fw-semibold">

                                        {{
                                            ucfirst(
                                                $incidencia->tipo
                                            )
                                        }}

                                    </span>

                                </td>

                                <td>

                                    @if($incidencia->estado === 'abierta')

                                        <span class="badge bg-danger">

                                            Abierta

                                        </span>

                                    @elseif($incidencia->estado === 'cerrada')

                                        <span class="badge bg-success">

                                            Cerrada

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{
                                                ucfirst(
                                                    $incidencia->estado
                                                )
                                            }}

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{
                                        $incidencia->descripcion
                                        ?: 'Sin descripción'
                                    }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-4"
                                >

                                    <span class="text-secondary">

                                        No existen incidencias registradas.

                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- EVIDENCIAS --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>06</span>

                Evidencias fotográficas

            </div>

            <div>

                <span class="text-secondary">

                    Evidencias:

                </span>

                <span class="text-warning fw-bold">

                    {{ $evidencias->count() }}

                </span>

            </div>

        </div>


        <div class="row g-4">

            @forelse(
                $evidencias
                as $evidencia
            )

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div
                        class="gtri-info-card h-100 p-0 overflow-hidden"
                    >

                        <img
                            src="{{ asset(
                                'storage/' .
                                $evidencia->foto
                            ) }}"
                            alt="Evidencia fotográfica"
                            style="
                                width:100%;
                                height:200px;
                                object-fit:cover;
                            "
                        >

                        <div class="p-3">

                            <div
                                class="fw-bold mb-2"
                                style="color:#D4AF37;"
                            >

                                {{
                                    $evidencia->titulo
                                    ?: 'Evidencia'
                                }}

                            </div>

                            <p class="text-secondary small mb-0">

                                {{
                                    $evidencia->descripcion
                                    ?: 'Sin descripción'
                                }}

                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

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
                                d-block
                                fs-1
                                text-secondary
                                mb-3
                            "
                        ></i>

                        <h5 class="text-light">

                            Sin evidencias fotográficas

                        </h5>

                        <p class="text-secondary mb-0">

                            No existen evidencias registradas para este servicio.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection