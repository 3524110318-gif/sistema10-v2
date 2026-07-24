@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar producto

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice la información del producto seleccionado.

                </p>

            </div>

            <a
                href="{{ route('administracion.productos.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- INFORMACIÓN DEL PRODUCTO --}}
    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-box-seam"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Producto seleccionado

                </small>

                <div class="fw-bold text-light">

                    {{ $producto->nombre }}

                </div>

                <small class="text-warning">

                    {{ $producto->codigo }}

                </small>

            </div>

        </div>

    </div>


    {{-- FORMULARIO --}}
    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.productos.update',
                $producto
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.productos._form')

        </form>

    </div>

</div>

@endsection