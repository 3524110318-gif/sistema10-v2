@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Editar Supervisión

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
        action="{{ route(
            'operaciones.supervisiones.update',
            $supervision->id
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>

                Asignación

            </label>

            <select
                name="asignacion_id"
                class="form-control"
                required
            >

                @foreach($asignaciones as $asignacion)

                    <option
                        value="{{ $asignacion->id }}"
                        {{ $supervision->asignacion_id == $asignacion->id ? 'selected' : '' }}
                    >

                        {{ $asignacion->empleado->nombre }}
                        {{ $asignacion->empleado->apellido_paterno }}
                        {{ $asignacion->empleado->apellido_materno }}

                        -

                        {{ $asignacion->plaza->nombre_plaza }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Fecha</label>

            <input
                type="date"
                name="fecha_supervision"
                class="form-control"
                value="{{ $supervision->fecha_supervision }}"
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

                <option
                    value="correcto"
                    {{ $supervision->resultado == 'correcto' ? 'selected' : '' }}
                >

                    Correcto

                </option>

                <option
                    value="incidencia"
                    {{ $supervision->resultado == 'incidencia' ? 'selected' : '' }}
                >

                    Incidencia

                </option>

                <option
                    value="ausente"
                    {{ $supervision->resultado == 'ausente' ? 'selected' : '' }}
                >

                    Ausente

                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Observaciones</label>

            <textarea
                name="observaciones"
                class="form-control"
                rows="4"
            >{{ $supervision->observaciones }}</textarea>

        </div>

        <div class="mb-3">

            <label>

                Cambiar evidencia fotográfica

            </label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept="image/*"
            >

        </div>

        @if($supervision->foto)

            <div class="mb-3">

                <img
                    src="{{ asset('storage/'.$supervision->foto) }}"
                    class="img-fluid rounded"
                    style="max-width:300px;"
                >

            </div>

        @endif

        <button
            class="btn btn-success"
        >

            Actualizar

        </button>

    </form>

</div>

@endsection
