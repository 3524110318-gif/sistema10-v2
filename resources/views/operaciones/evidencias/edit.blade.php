@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>

        Editar Evidencia

    </h1>

    <form
        method="POST"
        action="{{ route(
            'operaciones.evidencias.update',
            $evidencia
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>

                Supervisión

            </label>

            <select
                name="supervision_id"
                class="form-control"
                required
            >

                @foreach($supervisiones as $supervision)

                    <option
                        value="{{ $supervision->id }}"
                        {{
                            $evidencia->supervision_id == $supervision->id
                            ? 'selected'
                            : ''
                        }}
                    >

                        {{ $supervision->asignacion->empleado->nombre }}

                        {{ $supervision->asignacion->empleado->apellido_paterno }}

                        -

                        {{ $supervision->asignacion->plaza->servicio->nombre }}

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
                value="{{ $evidencia->titulo }}"
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
            >{{ $evidencia->descripcion }}</textarea>

        </div>

        <div class="mb-3">

            <label>

                Cambiar fotografía

            </label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept="image/*"
            >

        </div>

        @if($evidencia->foto)

            <div class="mb-3">

                <img
                    src="{{ asset('storage/'.$evidencia->foto) }}"
                    class="img-fluid rounded"
                    style="max-width:350px;"
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
