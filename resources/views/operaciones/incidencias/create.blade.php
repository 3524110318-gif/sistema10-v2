@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Nueva Incidencia

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.incidencias.store'
        ) }}"
    >

        @csrf

        @if(isset($supervision))

            <input
                type="hidden"
                name="servicio_id"
                value="{{ $supervision->asignacion->plaza->servicio->id }}"
            >

            <div class="card mb-3">

                <div class="card-body">

                    <h5>

                        Información de la Supervisión

                    </h5>

                    <hr>

                    <p>

                        <strong>Guardia:</strong>

                        {{ $supervision->asignacion->empleado->nombre }}
                        {{ $supervision->asignacion->empleado->apellido_paterno }}
                        {{ $supervision->asignacion->empleado->apellido_materno }}

                    </p>

                    <p>

                        <strong>Servicio:</strong>

                        {{ $supervision->asignacion->plaza->servicio->nombre }}

                    </p>

                    <p>

                        <strong>Plaza:</strong>

                        {{ $supervision->asignacion->plaza->nombre_plaza }}

                    </p>

                    <p class="mb-0">

                        <strong>Fecha:</strong>

                        {{ $supervision->fecha_supervision }}

                    </p>

                </div>

            </div>

        @else

            <div class="mb-3">

                <label>

                    Servicio

                </label>

                <select
                    name="servicio_id"
                    class="form-control"
                    required
                >

                    @foreach($servicios as $servicio)

                        <option
                            value="{{ $servicio->id }}"
                        >

                            {{ $servicio->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

        @endif

        @if(isset($supervision))

            <input
                type="hidden"
                name="supervision_id"
                value="{{ $supervision->id }}"
            >

        @else

            <div class="mb-3">

                <label>

                    Supervisión

                </label>

                <select
                    name="supervision_id"
                    class="form-control"
                >

                    <option value="">

                        Sin supervisión

                    </option>

                    @foreach($supervisiones as $supervisionItem)

                        <option
                            value="{{ $supervisionItem->id }}"
                        >

                            {{ $supervisionItem->asignacion->empleado->nombre }}
                            {{ $supervisionItem->asignacion->empleado->apellido_paterno }}

                            -

                            {{ $supervisionItem->asignacion->plaza->nombre_plaza }}

                            -

                            {{ $supervisionItem->fecha_supervision }}

                        </option>

                    @endforeach

                </select>

            </div>

        @endif

        <div class="mb-3">

            <label>Tipo</label>

            <select
                name="tipo"
                class="form-control"
                required
            >

                <option
                    value="ausencia"
                    {{
                        isset($supervision)
                        && $supervision->resultado == 'ausente'
                        ? 'selected'
                        : ''
                    }}
                >

                    Ausencia

                </option>

                <option
                    value="retardo"
                >

                    Retardo

                </option>

                <option
                    value="cliente"
                >

                    Cliente

                </option>

                <option
                    value="robo"
                >

                    Robo

                </option>

                <option
                    value="accidente"
                >

                    Accidente

                </option>

                <option
                    value="novedad"
                    {{
                        isset($supervision)
                        && $supervision->resultado == 'incidencia'
                        ? 'selected'
                        : ''
                    }}
                >

                    Novedad

                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea
                name="descripcion"
                class="form-control"
                rows="4"
                required
            >
                {{ isset($supervision) ? $supervision->observaciones : old('descripcion') }}

            </textarea>

        </div>

        <div class="mb-3">

            <label>

                Folio Físico

            </label>

            <input
                type="text"
                name="folio_fisico"
                class="form-control"
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
