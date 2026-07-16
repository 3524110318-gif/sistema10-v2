@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Nueva Supervisión

    </h1>

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>

                Se encontraron los siguientes errores:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        method="POST"
        action="{{ route('operaciones.supervisiones.store') }}"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="mb-3">

            <label>

                Guardia a supervisar

            </label>

            <select
                id="asignacion"
                name="asignacion_id"
                class="form-control"
                required
            >

                <option value="">

                    Seleccione

                </option>

                @foreach(
                    $asignaciones
                    as $asignacion
                )

                    <option
                        value="{{ $asignacion->id }}"

                        data-servicio="{{ $asignacion->plaza->servicio->nombre }}"

                        data-plaza="{{ $asignacion->plaza->nombre_plaza }}"

                        data-turno="{{ $asignacion->plaza->turno }}"
                    >

                        {{ $asignacion->empleado->nombre }}
                        {{ $asignacion->apellido_paterno ?? $asignacion->empleado->apellido_paterno }}
                        {{ $asignacion->empleado->apellido_materno }}

                    </option>

                @endforeach

            </select>

            <div class="card mt-3">

                <div class="card-body">

                    <p>

                        <strong>Servicio:</strong>

                        <span id="info_servicio">

                            Seleccione un guardia

                        </span>

                    </p>

                    <p>

                        <strong>Plaza:</strong>

                        <span id="info_plaza">

                            Seleccione un guardia

                        </span>

                    </p>

                    <p class="mb-0">

                        <strong>Turno:</strong>

                        <span id="info_turno">

                            Seleccione un guardia

                        </span>

                    </p>

                </div>

            </div>


        </div>

        <div class="mb-3">

            <label>

                Fecha

            </label>

            <input
                type="date"
                name="fecha_supervision"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Resultado

            </label>

            <select
                name="resultado"
                class="form-control"
                required
            >

                <option value="correcto">

                    Correcto

                </option>

                <option value="incidencia">

                    Incidencia

                </option>

                <option value="ausente">

                    Ausente

                </option>

            </select>

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

        <div class="mb-3">

            <label>

                Evidencia fotográfica

            </label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept="image/*"
            >

            <small class="text-muted">

                Opcional. Formatos permitidos: JPG, JPEG y PNG.

            </small>

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
