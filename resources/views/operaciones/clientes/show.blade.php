@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-building me-2"></i>

                Detalle del cliente

            </h2>

            <p class="gtri-page-subtitle">

                Consulta la información general y los contratos asociados al cliente.

            </p>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route(
                    'operaciones.clientes.index'
                ) }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Regresar

            </a>

            <a
                href="{{ route(
                    'operaciones.clientes.edit',
                    $cliente
                ) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar

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

            {{-- RAZÓN SOCIAL --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-building me-2"></i>

                        Razón social

                    </div>

                    <div class="gtri-info-value">

                        {{ $cliente->razon_social }}

                    </div>

                </div>

            </div>


            {{-- RFC --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-file-earmark-text me-2"></i>

                        RFC

                    </div>

                    <div class="gtri-info-value">

                        {{ $cliente->rfc }}

                    </div>

                </div>

            </div>


            {{-- REPRESENTANTE --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-person-badge me-2"></i>

                        Representante

                    </div>

                    <div class="gtri-info-value">

                        {{ $cliente->representante ?: 'No registrado' }}

                    </div>

                </div>

            </div>


            {{-- TELÉFONO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-telephone me-2"></i>

                        Teléfono

                    </div>

                    <div class="gtri-info-value">

                        {{ $cliente->telefono ?: 'No registrado' }}

                    </div>

                </div>

            </div>


            {{-- CORREO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-envelope me-2"></i>

                        Correo

                    </div>

                    <div class="gtri-info-value">

                        {{ $cliente->correo ?: 'No registrado' }}

                    </div>

                </div>

            </div>


            {{-- ESTADO --}}
            <div class="col-lg-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        <i class="bi bi-toggle-on me-2"></i>

                        Estado

                    </div>


                    <div class="mt-2">

                        @if($cliente->estado === 'activo')

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Activo

                            </span>

                        @else

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Inactivo

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DIRECCIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Dirección

        </div>


        <div class="gtri-info-card">

            <div class="gtri-info-label">

                <i class="bi bi-geo-alt me-2"></i>

                Dirección registrada

            </div>

            <div class="gtri-info-value mt-2">

                {{ $cliente->direccion ?: 'Sin dirección registrada.' }}

            </div>

        </div>

    </div>


    {{-- CONTRATOS --}}
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

                <span>03</span>

                Contratos del cliente

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $cliente->contratos->count() }}

                </span>

            </div>

        </div>


        @if($cliente->contratos->count())

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <colgroup>

                            <col style="width:50%">

                            <col style="width:20%">

                            <col style="width:30%">

                        </colgroup>

                        <thead>

                            <tr>

                                <th>Contrato</th>

                                <th>Estado</th>

                                <th class="text-center">

                                    Acciones

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach(
                                $cliente->contratos
                                as $contrato
                            )

                                <tr>

                                    <td>

                                        <span class="text-light fw-semibold">

                                            {{
                                                $contrato->nombre
                                                ??
                                                (
                                                    'Contrato #' .
                                                    $contrato->id
                                                )
                                            }}

                                        </span>

                                    </td>


                                    <td>

                                        @if($contrato->estado === 'activo')

                                            <span class="badge bg-success">

                                                Activo

                                            </span>

                                        @elseif($contrato->estado === 'inactivo')

                                            <span class="badge bg-danger">

                                                Inactivo

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ ucfirst($contrato->estado) }}

                                            </span>

                                        @endif

                                    </td>


                                    <td class="text-center">

                                        <button
                                            type="button"
                                            class="btn gtri-btn-secondary btn-sm"
                                            disabled
                                        >

                                            <i class="bi bi-hourglass-split me-1"></i>

                                            Próximamente

                                        </button>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div
                class="
                    p-5
                    rounded-3
                    text-center
                "
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                <i
                    class="
                        bi
                        bi-file-earmark-x
                        fs-1
                        text-secondary
                        d-block
                        mb-3
                    "
                ></i>

                <h5 class="text-light">

                    Sin contratos registrados

                </h5>

                <p class="text-secondary mb-0">

                    Este cliente aún no tiene contratos asociados.

                </p>

            </div>

        @endif

    </div>

</div>

@endsection