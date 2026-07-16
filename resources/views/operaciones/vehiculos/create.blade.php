@extends('operaciones.layouts.app')

@section('contenido')

@if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="container">

    <h1>

        Nuevo Vehículo

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.vehiculos.store'
        ) }}"
    >

        @csrf

        <div class="mb-3">

            <label>

                Unidad

            </label>

            <input
                type="text"
                name="unidad"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Placas

            </label>

            <input
                type="text"
                name="placas"
                class="form-control"
                required
            >

            @error('placas')

                <div class="text-danger">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <div class="mb-3">

            <label>

                Marca

            </label>

            <input
                type="text"
                name="marca"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Modelo

            </label>

            <input
                type="text"
                name="modelo"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Año

            </label>

            <input
                type="number"
                name="anio"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Kilometraje Actual

            </label>

            <input
                type="number"
                name="kilometraje_actual"
                class="form-control"
                required
            >

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
