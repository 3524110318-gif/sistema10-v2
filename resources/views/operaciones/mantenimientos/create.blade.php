@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Nuevo Mantenimiento

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.mantenimientos.store'
        ) }}"
    >

        @csrf

        <div class="mb-3">

            <label>

                Vehículo

            </label>

            <select
                name="vehiculo_id"
                class="form-control"
                required
            >

                @foreach(
                    $vehiculos as $vehiculo
                )

                    <option
                        value="{{ $vehiculo->id }}"
                    >

                        {{ $vehiculo->unidad }}

                        -

                        {{ $vehiculo->placas }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>

                Fecha

            </label>

            <input
                type="date"
                name="fecha"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Kilometraje

            </label>

            <input
                type="number"
                name="kilometraje"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Tipo

            </label>

            <input
                type="text"
                name="tipo"
                class="form-control"
                placeholder="Cambio de aceite"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Observaciones

            </label>

            <textarea
                name="observaciones"
                class="form-control"
                rows="4"
            ></textarea>

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
