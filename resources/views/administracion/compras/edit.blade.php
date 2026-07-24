@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar compra

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice la información de la compra seleccionada.

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


    {{-- RESUMEN DE LA COMPRA --}}
    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-cart-check"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Compra seleccionada

                </small>

                <div class="fw-bold text-light">

                    {{ $compra->folio }}

                </div>

                <small class="text-warning">

                    {{ $compra->proveedor->razon_social }}

                </small>

            </div>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.compras.update',
                $compra
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.compras._form')

        </form>

    </div>

</div>

@endsection