@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Editar Mantenimiento

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.mantenimientos.update',
            $mantenimiento->id
        ) }}"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Vehículo</label>

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
                        {{
                            $mantenimiento->vehiculo_id == $vehiculo->id
                            ? 'selected'
                            : ''
                        }}
                    >

                        {{ $vehiculo->unidad }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Fecha</label>

            <input
                type="date"
                name="fecha"
                class="form-control"
                value="{{ $mantenimiento->fecha }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Kilometraje</label>

            <input
                type="number"
                name="kilometraje"
                class="form-control"
                value="{{ $mantenimiento->kilometraje }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Tipo</label>

            <input
                type="text"
                name="tipo"
                class="form-control"
                value="{{ $mantenimiento->tipo }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Observaciones</label>

            <textarea
                name="observaciones"
                class="form-control"
                rows="4"
            >{{ $mantenimiento->observaciones }}</textarea>

        </div>

        <button
            class="btn btn-success"
        >

            Actualizar

        </button>

    </form>

</div>

@endsection
