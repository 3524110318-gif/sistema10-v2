@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-tag me-2"></i>

                    Nueva categoría

                </h2>

                <p class="gtri-page-subtitle">

                    Registre una nueva categoría para organizar los productos.

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


    {{-- FORMULARIO --}}
    <div class="gtri-card">

        <form
            action="{{ route('administracion.categorias.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.categorias._form')

        </form>

    </div>

</div>

@endsection