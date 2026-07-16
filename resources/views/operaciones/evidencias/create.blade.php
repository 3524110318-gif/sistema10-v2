@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Nueva Evidencia

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.evidencias.store'
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="mb-3">

            <label>

                Supervisión

            </label>

            <select
                name="supervision_id"
                class="form-control"
                required
            >

                <option value="">

                    Seleccione

                </option>

                @foreach(
                    $supervisiones
                    as $supervision
                )

                    <option
                        value="{{ $supervision->id }}"
                    >

                        {{ $supervision->asignacion->empleado->nombre }}
                        -
                        {{ $supervision->asignacion->plaza->nombre_plaza }}
                        -
                        {{ $supervision->fecha_supervision }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>

                Título

            </label>

            <input
                type="text"
                name="titulo"
                class="form-control"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Fotografía

            </label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept="image/*"
                required
            >

        </div>

        <div class="mb-3">

            <label>

                Descripción

            </label>

            <textarea
                name="descripcion"
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
