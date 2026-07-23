@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- CARD PRINCIPAL --}}
    <x-rh.card-rh titulo="Expediente REPSE">

        {{-- INFORMACIÓN GENERAL --}}
        <div class="mb-4">

            <h5 class="fw-bold">

                <i class="bi bi-person-vcard me-2"></i>

                Información general

            </h5>

            <hr>

        </div>


        <div class="row g-4">

            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <div class="mb-3">

                        <span class="text-muted d-block">
                            Empleado
                        </span>

                        <span class="fw-bold fs-5">

                            {{ $expediente->empleado->nombre }}

                        </span>

                    </div>

                    <div>

                        <span class="text-muted d-block mb-2">
                            Estado del expediente
                        </span>

                        @if($expediente->estatus === 'cumple')

                            <span class="badge bg-success px-3 py-2">

                                <i class="bi bi-check-circle me-1"></i>

                                Cumple

                            </span>

                        @elseif($expediente->estatus === 'pendiente')

                            <span class="badge bg-warning text-dark px-3 py-2">

                                <i class="bi bi-exclamation-circle me-1"></i>

                                Pendiente

                            </span>

                        @else

                            <span class="badge bg-danger px-3 py-2">

                                <i class="bi bi-x-circle me-1"></i>

                                Bloqueado

                            </span>

                        @endif

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <span class="text-muted d-block mb-2">

                        Observaciones

                    </span>

                    <p class="mb-0">

                        {{ $expediente->observaciones ?: 'Sin observaciones registradas.' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- DOCUMENTACIÓN --}}
        <div class="mb-4 mt-5">

            <h5 class="fw-bold">

                <i class="bi bi-folder-check me-2"></i>

                Documentación entregada

            </h5>

            <p class="text-muted mb-2">

                Estado actual de los documentos del expediente.

            </p>

            <hr>

        </div>


        <div class="row g-3">

            {{-- ALTA IMSS --}}
            <div class="col-md-6">

                <div
                    class="border rounded p-3 d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div class="fw-bold">

                            Alta IMSS

                        </div>

                        <small class="text-muted">

                            Constancia de alta ante el IMSS.

                        </small>

                    </div>

                    @if($expediente->alta_imss)

                        <span class="badge bg-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Entregado

                        </span>

                    @else

                        <span class="badge bg-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            No entregado

                        </span>

                    @endif

                </div>

            </div>


            {{-- CONTRATO --}}
            <div class="col-md-6">

                <div
                    class="border rounded p-3 d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div class="fw-bold">

                            Contrato firmado

                        </div>

                        <small class="text-muted">

                            Contrato laboral firmado.

                        </small>

                    </div>

                    @if($expediente->contrato_firmado)

                        <span class="badge bg-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Entregado

                        </span>

                    @else

                        <span class="badge bg-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            No entregado

                        </span>

                    @endif

                </div>

            </div>


            {{-- CÉDULA SSP --}}
            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="fw-bold">
                                Cédula SSP
                            </div>

                            <small class="text-muted">
                                Documento correspondiente a Seguridad Pública.
                            </small>

                        </div>

                        @if($expediente->cedula_ssp)

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Entregado

                            </span>

                        @else

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                No entregado

                            </span>

                        @endif

                    </div>


                    {{-- VIGENCIA --}}
                    <div class="mt-3">

                        @if($expediente->vigencia_cedula_ssp)

                            <small class="d-block text-muted mb-1">

                                Vigencia:

                                <strong class="text-dark">

                                    {{ \Carbon\Carbon::parse(
                                        $expediente->vigencia_cedula_ssp
                                    )->format('d/m/Y') }}

                                </strong>

                            </small>


                            @if(
                                now()->startOfDay()->lte(
                                    \Carbon\Carbon::parse(
                                        $expediente->vigencia_cedula_ssp
                                    )->startOfDay()
                                )
                            )

                                <span class="badge bg-success">
                                    Vigente
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Vencida
                                </span>

                            @endif

                        @else

                            <small class="text-muted">
                                Vigencia:
                            </small>

                            <span class="badge bg-danger ms-1">
                                Sin vigencia registrada
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- CONSTANCIA FISCAL --}}
            <div class="col-md-6">

                <div
                    class="border rounded p-3 d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div class="fw-bold">

                            Constancia fiscal

                        </div>

                        <small class="text-muted">

                            Constancia de Situación Fiscal.

                        </small>

                    </div>

                    @if($expediente->constancia_fiscal)

                        <span class="badge bg-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Entregado

                        </span>

                    @else

                        <span class="badge bg-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            No entregado

                        </span>

                    @endif

                </div>

            </div>

            {{-- VALIDACIÓN RFC --}}

            <div class="mt-3">

                <small class="text-muted d-block">
                    RFC registrado en RH:
                </small>

                <strong>
                    {{ $expediente->empleado->rfc }}
                </strong>

                <small class="text-muted d-block mt-2">
                    RFC capturado de la constancia:
                </small>

                <strong>
                    {{ $expediente->rfc_constancia ?: 'No registrado' }}
                </strong>

                <div class="mt-2">

                    @if(
                        $expediente->rfc_constancia &&
                        strtoupper(trim($expediente->rfc_constancia)) ===
                        strtoupper(trim($expediente->empleado->rfc))
                    )

                        <span class="badge bg-success">

                            <i class="bi bi-check-circle me-1"></i>

                            RFC validado

                        </span>

                    @else

                        <span class="badge bg-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            RFC no coincide

                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- RESUMEN --}}
        <div class="alert alert-light border mt-4">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <strong>

                        Resumen del expediente:

                    </strong>

                    @php

                        $documentosEntregados =
                            ($expediente->alta_imss ? 1 : 0) +
                            ($expediente->contrato_firmado ? 1 : 0) +
                            ($expediente->cedula_ssp ? 1 : 0) +
                            ($expediente->constancia_fiscal ? 1 : 0);

                    @endphp

                    @if($documentosEntregados === 4)

                        <span class="badge bg-success ms-2">

                            Cumple

                        </span>

                    @elseif($documentosEntregados > 0)

                        <span class="badge bg-warning text-dark ms-2">

                            Pendiente

                        </span>

                    @else

                        <span class="badge bg-danger ms-2">

                            Sin documentación

                        </span>

                    @endif

                </div>

                <div class="col-md-4 text-md-end mt-2 mt-md-0">

                    <strong>

                        {{ $documentosEntregados }} / 4 documentos

                    </strong>

                </div>

            </div>

        </div>


        {{-- BOTONES --}}
        <div class="d-flex justify-content-end gap-2 mt-4">

            <a
                href="{{ route('expedientes.index') }}"
                class="btn btn-secondary"
            >

                <i class="bi bi-arrow-left"></i>

                Volver

            </a>

            <a
                href="{{ route('expedientes.edit', $expediente) }}"
                class="btn btn-primary"
            >

                <i class="bi bi-pencil-square"></i>

                Editar expediente

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection