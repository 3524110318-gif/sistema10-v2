@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Detalle de la Incidencia

        </h1>

        <a
            href="{{ route(
                'operaciones.incidencias.index'
            ) }}"
            class="btn btn-secondary"
        >

            Volver

        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="row">

                @if($incidencia->supervision)

                <div class="col-md-6 mb-3">

                    <strong>

                        Guardia

                    </strong>

                    <br>

                    {{ $incidencia->supervision->asignacion->empleado->nombre }}

                    {{ $incidencia->supervision->asignacion->empleado->apellido_paterno }}

                    {{ $incidencia->supervision->asignacion->empleado->apellido_materno }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Servicio

                    </strong>

                    <br>

                    {{ $incidencia->servicio->nombre }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Plaza

                    </strong>

                    <br>

                    {{ $incidencia->supervision->asignacion->plaza->nombre_plaza }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Fecha

                    </strong>

                    <br>

                    {{ $incidencia->supervision->fecha_supervision }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Tipo

                    </strong>

                    <br>

                    {{ ucfirst($incidencia->tipo) }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Estado

                    </strong>

                    <br>

                    @if($incidencia->estado == 'abierta')

                        <span class="badge bg-danger">

                            Abierta

                        </span>

                    @else

                        <span class="badge bg-success">

                            Cerrada

                        </span>

                    @endif

                </div>

                <div class="col-12 mb-3">

                    <strong>

                        Descripción

                    </strong>

                    <div class="border rounded p-3 mt-2">

                        {{ $incidencia->descripcion }}

                    </div>

                </div>

                <div class="col-md-6">

                    <strong>

                        Folio Físico

                    </strong>

                    <br>

                    {{ $incidencia->folio_fisico ?: 'Sin folio' }}

                </div>

            </div>

            @else

            <div class="alert alert-warning">

                Esta incidencia fue registrada manualmente y no está relacionada con una supervisión.

            </div>

            @endif

        </div>

    </div>

</div>

@endsection
