@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-plus me-2"></i>

                Nueva Cotización

            </h2>

            <p class="gtri-page-subtitle">

                Genera una nueva propuesta comercial para un prospecto registrado.

            </p>

        </div>

        <a
            href="{{ route('comercial.cotizaciones.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    <!-- ERRORES DE VALIDACIÓN -->

    @if($errors->any())

        <div class="alert alert-danger">

            <div class="d-flex align-items-center mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <strong>

                    Revisa la información ingresada

                </strong>

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- FORMULARIO -->

    <form
        action="{{ route('comercial.cotizaciones.store') }}"
        method="POST"
    >

        @csrf

        @include('comercial.cotizaciones._form')

    </form>

</div>

@endsection