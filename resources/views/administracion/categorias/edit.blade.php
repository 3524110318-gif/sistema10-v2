@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar categoría

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice la información de la categoría seleccionada.

                </p>

            </div>

            <a
                href="{{ route('administracion.categorias.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- INFORMACIÓN DE LA CATEGORÍA --}}
    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-tag"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Categoría seleccionada

                </small>

                <div class="fw-bold text-light">

                    {{ $categoria->nombre }}

                </div>

                <small class="text-secondary">

                    {{ $categoria->descripcion ?: 'Sin descripción' }}

                </small>

            </div>

        </div>

    </div>


    {{-- FORMULARIO --}}
    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.categorias.update',
                $categoria
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.categorias._form')

        </form>

    </div>

</div>

@endsection