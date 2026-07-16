@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Nueva Plaza Operativa

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.plazas.store'
        ) }}"
    >

        @csrf

        <div class="mb-3">

            <label>

                Servicio

            </label>

            <select
                name="servicio_id"
                class="form-control"
                required
            >

                <option value="">

                    Seleccione un servicio

                </option>

                @foreach($servicios as $servicio)

                    <option
                        value="{{ $servicio->id }}"
                    >

                        {{ $servicio->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>
                Nombre de la Plaza
            </label>

            <input
                type="text"
                name="nombre_plaza"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Turno

            </label>

            <select
                name="turno"
                class="form-control"
                required
            >

                <option value="diurno">

                    Diurno

                </option>

                <option value="nocturno">

                    Nocturno

                </option>

                <option value="Mixto">

                    Mixto

                </option>

            </select>

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>

                    Hora Entrada

                </label>

                <input
                    type="time"
                    name="hora_entrada"
                    class="form-control"
                    required
                >

            </div>

            <div class="col-md-6">

                <label>

                    Hora Salida

                </label>

                <input
                    type="time"
                    name="hora_salida"
                    class="form-control"
                    required
                >

            </div>

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
