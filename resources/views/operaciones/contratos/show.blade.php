@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-text me-2"></i>

                Detalle del contrato

            </h2>

            <p class="gtri-page-subtitle">

                Consulta la información general y los servicios asociados al contrato.

            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route(
                    'operaciones.contratos.edit',
                    $contrato
                ) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar

            </a>


            <a
                href="{{ route(
                    'operaciones.contratos.index'
                ) }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Regresar

            </a>

        </div>

    </div>


    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información general

        </div>


        <div class="row g-4">

            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Cliente

                    </div>

                    <div class="gtri-info-value">

                        {{ $contrato->cliente->razon_social }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Número de contrato

                    </div>

                    <div class="gtri-info-value">

                        {{ $contrato->numero_contrato }}

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Fecha de inicio

                    </div>

                    <div class="gtri-info-value">

                        {{ $contrato->fecha_inicio }}

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Fecha de fin

                    </div>

                    <div class="gtri-info-value">

                        {{ $contrato->fecha_fin ?: 'Sin definir' }}

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Estado

                    </div>

                    <div class="mt-2">

                        @switch($contrato->estado)

                            @case('activo')

                                <span class="badge bg-success">

                                    Activo

                                </span>

                                @break


                            @case('vencido')

                                <span class="badge bg-warning text-dark">

                                    Vencido

                                </span>

                                @break


                            @case('cancelado')

                                <span class="badge bg-danger">

                                    Cancelado

                                </span>

                                @break


                            @default

                                <span class="badge bg-secondary">

                                    Borrador

                                </span>

                        @endswitch

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Observaciones

        </div>


        <div class="gtri-info-card">

            <div class="gtri-info-value">

                {{ $contrato->observaciones ?: 'Sin observaciones.' }}

            </div>

        </div>

    </div>


    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>03</span>

                Servicios del contrato

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $contrato->servicios->count() }}

                </span>

            </div>

        </div>


        @if($contrato->servicios->count())

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Servicio</th>

                                <th>Estado</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach(
                                $contrato->servicios
                                as $servicio
                            )

                                <tr>

                                    <td>

                                        <span class="text-light fw-semibold">

                                            {{ $servicio->nombre }}

                                        </span>

                                    </td>


                                    <td>

                                        @if($servicio->estado === 'activo')

                                            <span class="badge bg-success">

                                                Activo

                                            </span>

                                        @elseif($servicio->estado === 'inactivo')

                                            <span class="badge bg-danger">

                                                Inactivo

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ ucfirst($servicio->estado) }}

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
                        bi-building-x
                        fs-1
                        text-secondary
                        d-block
                        mb-3
                    "
                ></i>

                <h5 class="text-light">

                    Sin servicios registrados

                </h5>

                <p class="text-secondary mb-0">

                    Este contrato todavía no tiene servicios asociados.

                </p>

            </div>

        @endif

    </div>

</div>

@endsection