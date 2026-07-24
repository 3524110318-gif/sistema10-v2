@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-truck me-2"></i>

                    Nuevo proveedor

                </h2>

                <p class="gtri-page-subtitle">

                    Registre un nuevo proveedor para la gestión de compras y abastecimiento.

                </p>

            </div>

            <a
                href="{{ route('administracion.proveedores.index') }}"
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
            action="{{ route('administracion.proveedores.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.proveedores._form')

        </form>

    </div>

</div>

@endsection