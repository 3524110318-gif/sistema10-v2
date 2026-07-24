@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-receipt me-2"></i>

                    Detalle de la compra

                </h2>

                <p class="gtri-page-subtitle">

                    Información general de la compra seleccionada.

                </p>

            </div>

            <a
                href="{{ route('administracion.compras.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- IDENTIFICACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de la compra

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Folio

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Proveedor

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->proveedor->razon_social }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Fecha de compra

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->fecha_compra->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Estado

                </label>

                <div class="pt-2">

                    @if($compra->estado == 'pendiente')

                        <span class="badge gtri-badge-warning">

                            <i class="bi bi-clock me-1"></i>

                            Pendiente

                        </span>

                    @elseif($compra->estado == 'recibida')

                        <span class="badge gtri-badge-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Recibida

                        </span>

                    @else

                        <span class="badge gtri-badge-danger">

                            <i class="bi bi-x-circle me-1"></i>

                            Cancelada

                        </span>

                    @endif

                </div>

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Registró

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->usuario->name ?? 'Sin usuario' }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Observaciones

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $compra->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>


    <div class="d-flex justify-content-end">

        <a
            href="{{ route('administracion.compras.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>

</div>

@endsection