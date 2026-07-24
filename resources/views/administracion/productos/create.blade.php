@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-box-seam me-2"></i>

                    Nuevo producto

                </h2>

                <p class="gtri-page-subtitle">

                    Registre un nuevo producto dentro del inventario de GTRI.

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


    {{-- FORMULARIO --}}
    <div class="gtri-card">

        <form
            action="{{ route('administracion.productos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.productos._form')

        </form>

    </div>

</div>

@endsection