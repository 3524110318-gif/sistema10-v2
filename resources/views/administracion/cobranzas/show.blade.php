@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-cash-stack me-2"></i>

                    Detalle de la cobranza

                </h2>

                <p class="gtri-page-subtitle">

                    Información del cobro, vencimiento y seguimiento del pago.

                </p>

            </div>

            <a
                href="{{ route('administracion.cobranzas.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- 01 FACTURA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de facturación

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Factura

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $cobranza->factura->folio }}"
                    readonly
                >

            </div>


            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Cliente

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $cobranza->factura->cliente->razon_social }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- 02 INFORMACIÓN DEL PAGO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Información del pago

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Fecha de vencimiento

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $cobranza->fecha_vencimiento->format('d/m/Y') }}"
                    readonly
                >

            </div>


            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Fecha de pago

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $cobranza->fecha_pago
                        ? $cobranza->fecha_pago->format('d/m/Y')
                        : 'Sin registrar'
                    }}"
                    readonly
                >

            </div>


            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Monto

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="text"
                        class="form-control gtri-input"
                        value="{{ number_format(
                            $cobranza->monto,
                            2
                        ) }}"
                        readonly
                    >

                </div>

            </div>


            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Referencia de pago

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $cobranza->referencia_pago
                        ?? 'Sin referencia'
                    }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- 03 SEGUIMIENTO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Estado y seguimiento

        </div>

        <div class="row g-4">

            {{-- ESTADO --}}
            <div class="col-md-6">

                <label class="gtri-label d-block mb-3">

                    Estado de cobranza

                </label>

                @switch($cobranza->estado)

                    @case('pendiente')

                        <span class="badge bg-primary">

                            <i class="bi bi-clock me-1"></i>

                            Pendiente

                        </span>

                        @break


                    @case('revision')

                        <span class="badge gtri-badge-warning">

                            <i class="bi bi-search me-1"></i>

                            En revisión

                        </span>

                        @break


                    @case('pagada')

                        <span class="badge gtri-badge-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Pagada

                        </span>

                        @break


                    @case('vencida')

                        <span class="badge gtri-badge-danger">

                            <i class="bi bi-exclamation-circle me-1"></i>

                            Vencida

                        </span>

                        @break

                @endswitch

            </div>


            {{-- SEMÁFORO --}}
            <div class="col-md-6">

                <label class="gtri-label d-block mb-3">

                    Semáforo de cobranza

                </label>

                @switch($cobranza->semaforo)

                    @case('azul')

                        <span class="badge bg-primary">

                            <i class="bi bi-circle-fill me-1"></i>

                            Azul

                        </span>

                        @break


                    @case('amarillo')

                        <span class="badge gtri-badge-warning">

                            <i class="bi bi-circle-fill me-1"></i>

                            Amarillo

                        </span>

                        @break


                    @case('rojo')

                        <span class="badge gtri-badge-danger">

                            <i class="bi bi-circle-fill me-1"></i>

                            Rojo

                        </span>

                        @break


                    @case('verde')

                        <span class="badge gtri-badge-success">

                            <i class="bi bi-circle-fill me-1"></i>

                            Verde

                        </span>

                        @break

                @endswitch

            </div>

        </div>

    </div>


    {{-- 04 OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

            Observaciones

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $cobranza->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>


    {{-- ACCIONES --}}
    <div class="d-flex justify-content-end gap-3">

        <a
            href="{{ route('administracion.cobranzas.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

        <a
            href="{{ route(
                'administracion.cobranzas.edit',
                $cobranza
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-pencil me-1"></i>

            Editar cobranza

        </a>

    </div>

</div>

@endsection