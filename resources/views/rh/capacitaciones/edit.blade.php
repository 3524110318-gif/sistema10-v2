@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar capacitación

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información de la capacitación del empleado.

            </p>

        </div>

    </div>


    @if (session('error'))

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route(
            'rh.capacitaciones.update',
            $capacitacion->id
        ) }}"
    >

        @csrf

        @method('PUT')

        @include('rh.capacitaciones._form')

    </form>

</div>

@endsection