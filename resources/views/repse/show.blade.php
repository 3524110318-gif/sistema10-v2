@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-folder2-open me-2"></i>

                Expediente REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Consulta el estado documental y de cumplimiento normativo del empleado.

            </p>

        </div>

        <a
            href="{{ route('expedientes.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    <!-- 01 · INFORMACIÓN GENERAL -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información general

        </div>

        <div class="row g-3">

            <div class="col-md-6">

                <div class="gtri-card h-100">

                    <div class="gtri-info-label">

                        Empleado

                    </div>

                    <div class="gtri-info-value fs-5 mt-2 mb-4">

                        <i class="bi bi-person-badge me-2"></i>

                        {{ $expediente->empleado->nombre }}

                    </div>


                    <div class="gtri-info-label mb-2">

                        Estado del expediente

                    </div>

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


            <div class="col-md-6">

                <div class="gtri-card h-100">

                    <div class="gtri-info-label mb-2">

                        Observaciones

                    </div>

                    <p class="mb-0">

                        {{ $expediente->observaciones ?: 'Sin observaciones registradas.' }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- 02 · DOCUMENTACIÓN ENTREGADA -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Documentación entregada

        </div>

        <p class="text-secondary mb-4">

            Estado actual de los documentos requeridos para el expediente.

        </p>


        <div class="row g-3">

            <!-- IMSS -->

            <div class="col-md-6">

                <div class="gtri-card h-100 d-flex justify-content-between align-items-center">

                    <div>

                        <div class="fw-bold">

                            <i class="bi bi-heart-pulse me-1"></i>

                            Alta IMSS

                        </div>

                        <small class="text-secondary">

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


            <!-- CONTRATO -->

            <div class="col-md-6">

                <div class="gtri-card h-100 d-flex justify-content-between align-items-center">

                    <div>

                        <div class="fw-bold">

                            <i class="bi bi-file-earmark-check me-1"></i>

                            Contrato firmado

                        </div>

                        <small class="text-secondary">

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


            <!-- CÉDULA SSP -->

            <div class="col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-shield-check me-1"></i>

                                Cédula SSP

                            </div>

                            <small class="text-secondary">

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


                    <div class="mt-4 pt-3 border-top border-secondary">

                        @if($expediente->vigencia_cedula_ssp)

                            <small class="text-secondary d-block mb-2">

                                Vigencia registrada

                            </small>

                            <strong class="d-block mb-2">

                                <i class="bi bi-calendar-event me-1"></i>

                                {{ \Carbon\Carbon::parse(
                                    $expediente->vigencia_cedula_ssp
                                )->format('d/m/Y') }}

                            </strong>

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

                            <span class="text-secondary">

                                Vigencia:

                            </span>

                            <span class="badge bg-danger ms-1">

                                Sin vigencia registrada

                            </span>

                        @endif

                    </div>

                </div>

            </div>


            <!-- CONSTANCIA FISCAL -->

            <div class="col-md-6">

                <div class="gtri-card h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-receipt me-1"></i>

                                Constancia fiscal

                            </div>

                            <small class="text-secondary">

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


                    <!-- VALIDACIÓN RFC -->

                    <div class="mt-4 pt-3 border-top border-secondary">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="gtri-info-label">

                                    RFC registrado en RH

                                </div>

                                <strong class="d-block mt-1">

                                    {{ $expediente->empleado->rfc }}

                                </strong>

                            </div>

                            <div class="col-md-6">

                                <div class="gtri-info-label">

                                    RFC de la constancia

                                </div>

                                <strong class="d-block mt-1">

                                    {{ $expediente->rfc_constancia ?: 'No registrado' }}

                                </strong>

                            </div>

                        </div>


                        <div class="mt-3">

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

            </div>

        </div>

    </div>


    <!-- 03 · RESUMEN DEL EXPEDIENTE -->

    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>03</span>

            Resumen del expediente

        </div>

        @php

            $documentosEntregados =
                ($expediente->alta_imss ? 1 : 0) +
                ($expediente->contrato_firmado ? 1 : 0) +
                ($expediente->cedula_ssp ? 1 : 0) +
                ($expediente->constancia_fiscal ? 1 : 0);

        @endphp


        <div class="gtri-card">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <span class="text-secondary">

                        Estado de documentación:

                    </span>

                    @if($documentosEntregados === 4)

                        <span class="badge bg-success ms-2">

                            <i class="bi bi-check-circle me-1"></i>

                            Cumple

                        </span>

                    @elseif($documentosEntregados > 0)

                        <span class="badge bg-warning text-dark ms-2">

                            <i class="bi bi-exclamation-circle me-1"></i>

                            Pendiente

                        </span>

                    @else

                        <span class="badge bg-danger ms-2">

                            <i class="bi bi-x-circle me-1"></i>

                            Sin documentación

                        </span>

                    @endif

                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">

                    <strong>

                        {{ $documentosEntregados }} / 4 documentos

                    </strong>

                </div>

            </div>

        </div>


        <!-- ACCIONES -->

        <div class="d-flex justify-content-end gap-2 mt-4">

            <a
                href="{{ route('expedientes.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

            <a
                href="{{ route('expedientes.edit', $expediente) }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-pencil-square me-1"></i>

                Editar expediente

            </a>

        </div>

    </div>

</div>

@endsection