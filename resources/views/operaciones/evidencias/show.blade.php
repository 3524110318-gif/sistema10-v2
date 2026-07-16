@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Detalle de la Evidencia

        </h1>

        <a
            href="{{ route(
                'operaciones.evidencias.index'
            ) }}"
            class="btn btn-secondary"
        >

            Regresar

        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>

                        Guardia

                    </strong>

                    <br>

                    {{ $evidencia->supervision->asignacion->empleado->nombre }}

                    {{ $evidencia->supervision->asignacion->empleado->apellido_paterno }}

                    {{ $evidencia->supervision->asignacion->empleado->apellido_materno }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Servicio

                    </strong>

                    <br>

                    {{ $evidencia->supervision->asignacion->plaza->servicio->nombre }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Plaza

                    </strong>

                    <br>

                    {{ $evidencia->supervision->asignacion->plaza->nombre_plaza }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Fecha

                    </strong>

                    <br>

                    {{ $evidencia->supervision->fecha_supervision }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Título

                    </strong>

                    <br>

                    {{ $evidencia->titulo }}

                </div>

                <div class="col-12 mb-3">

                    <strong>

                        Descripción

                    </strong>

                    <div class="border rounded p-3 mt-2">

                        {{ $evidencia->descripcion ?: 'Sin descripción.' }}

                    </div>

                </div>

                <div class="col-12">

                    <strong>

                        Fotografía

                    </strong>

                    <br><br>

                    <img
                        src="{{ asset('storage/'.$evidencia->foto) }}"
                        class="img-fluid rounded shadow"
                        style="max-width:500px;"
                    >

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
