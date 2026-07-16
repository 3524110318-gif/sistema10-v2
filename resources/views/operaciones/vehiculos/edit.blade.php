@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Editar Vehículo

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.vehiculos.update',
            $vehiculo->id
        ) }}"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Unidad</label>

            <input
                type="text"
                name="unidad"
                class="form-control"
                value="{{ $vehiculo->unidad }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Placas</label>

            <input
                type="text"
                name="placas"
                class="form-control"
                value="{{ $vehiculo->placas }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Marca</label>

            <input
                type="text"
                name="marca"
                class="form-control"
                value="{{ $vehiculo->marca }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Modelo</label>

            <input
                type="text"
                name="modelo"
                class="form-control"
                value="{{ $vehiculo->modelo }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Año</label>

            <input
                type="number"
                name="anio"
                class="form-control"
                value="{{ $vehiculo->anio }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Kilometraje</label>

            <input
                type="number"
                name="kilometraje_actual"
                class="form-control"
                value="{{ $vehiculo->kilometraje_actual }}"
                required
            >

        </div>

        <div class="mb-3">

            <label>Estado</label>

            <select
                name="estado"
                class="form-control"
            >

                <option
                    value="activo"
                    {{ $vehiculo->estado == 'activo' ? 'selected' : '' }}
                >
                    Activo
                </option>

                <option
                    value="taller"
                    {{ $vehiculo->estado == 'taller' ? 'selected' : '' }}
                >
                    Taller
                </option>

                <option
                    value="baja"
                    {{ $vehiculo->estado == 'baja' ? 'selected' : '' }}
                >
                    Baja
                </option>

            </select>

        </div>

        <button
            class="btn btn-success"
        >

            Actualizar

        </button>

    </form>

</div>

@endsection
