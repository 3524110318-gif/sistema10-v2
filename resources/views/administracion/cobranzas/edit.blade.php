@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar cobranza

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice el seguimiento y estado del pago.

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


    {{-- RESUMEN --}}
    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-cash-stack"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Cobranza seleccionada

                </small>

                <div class="fw-bold text-light">

                    {{ $cobranza->factura->folio }}

                </div>

                <small class="text-warning">

                    {{ $cobranza->factura->cliente->razon_social }}

                </small>

            </div>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.cobranzas.update',
                $cobranza
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include(
                'administracion.cobranzas._form'
            )

        </form>

    </div>

</div>

@endsection