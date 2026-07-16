@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1 class="mb-4">

        Registrar Doblete

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.dobletes.store'
        ) }}"
    >

        @csrf


        <div class="mb-3">

            <label>

                Plaza a cubrir

            </label>

            <select
                name="plaza_operativa_id"
                class="form-control"
                required
            >

                <option value=""selected>
                    Selecciona una plaza
                </option>
                @foreach(
                    $plazas as $plaza
                )

                    <option
                        value="{{ $plaza->id }}"

                        data-guardia="{{ optional($plaza->asignaciones->first()?->empleado)->nombre }} {{ optional($plaza->asignaciones->first()?->empleado)->apellido_paterno }} {{ optional($plaza->asignaciones->first()?->empleado)->apellido_materno }}"

                        data-empleado="{{ optional($plaza->asignaciones->first()?->empleado)->id }}"
                    >

                        {{ $plaza->servicio->nombre }}
                        -

                        {{ $plaza->nombre_plaza }}

                    </option>

                @endforeach

            </select>

            @error('plaza_operativa_id')

                <div class="text-danger mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <div class="mb-3">

            <label>

                Guardia ausente

            </label>

            <input
                type="text"
                id="guardia_ausente"
                class="form-control"
                readonly
            >

            <input
                type="hidden"
                name="guardia_ausente"
                id="guardia_ausente_hidden"
            >

        </div>

        <div class="mb-3">

            <label>

                Guardia de reemplazo

            </label>

            <select
                id="guardia_cubre"
                name="empleado_id"
                class="form-control"
                required
                disabled
            >
                <option value=""selected>
                    Selecciona a un empleado
                </option>

                @foreach(
                    $empleados as $empleado
                )

                    <option
                        value="{{ $empleado->id }}"
                        data-servicio="{{ $empleado->asignaciones->first()->plaza->servicio->nombre }}"
                        data-plaza="{{ $empleado->asignaciones->first()->plaza->nombre_plaza }}"
                    >

                        {{ $empleado->nombre }}
                        {{ $empleado->apellido_paterno }}
                        {{ $empleado->apellido_materno }}

                    </option>

                @endforeach

            </select>

            @error('empleado_id')

                <div class="text-danger mt-1">

                    {{ $message }}

                </div>

            @enderror

            <div class="alert alert-info mt-3">

                <strong>

                    Origen del guardia

                </strong>

                <hr>

                <p class="mb-1">

                    <strong>Servicio actual:</strong>

                    <span id="info_servicio">

                        Selecciona un guardia

                    </span>

                </p>

                <p class="mb-0">

                    <strong>Plaza actual:</strong>

                    <span id="info_plaza">

                        Selecciona un guardia

                    </span>

                </p>

            </div>

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

            @error('fecha')

                <div class="text-danger mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <div class="mb-3">

            <label>

                Motivo

            </label>

            <textarea
                name="motivo"
                class="form-control"
                rows="4"
                required
            ></textarea>
            @error('motivo')

                <div class="text-danger mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
