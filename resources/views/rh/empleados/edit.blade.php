@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-errors />


    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar empleado

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información de

                {{ $empleado->nombre }}

                {{ $empleado->apellido_paterno }}.

            </p>

        </div>


        <a
            href="{{ route(
                'rh.empleados.show',
                $empleado->id
            ) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.empleados.update',
            $empleado->id
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        @include('rh.empleados._form', [
            'empleado' => $empleado
        ])

    </form>

</div>

@endsection