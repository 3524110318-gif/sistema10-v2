@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Detalle de Supervisión

        </h1>

        <a
            href="{{ route('operaciones.supervisiones.index') }}"
            class="btn btn-secondary"
        >

            Regresar

        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>Guardia</strong>

                    <br>

                    {{ $supervision->asignacion->empleado->nombre }}
                    {{ $supervision->asignacion->empleado->apellido_paterno }}
                    {{ $supervision->asignacion->empleado->apellido_materno }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Servicio</strong>

                    <br>

                    {{ $supervision->asignacion->plaza->servicio->nombre }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Plaza</strong>

                    <br>

                    {{ $supervision->asignacion->plaza->nombre_plaza }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Turno</strong>

                    <br>

                    {{ ucfirst($supervision->asignacion->plaza->turno) }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Fecha</strong>

                    <br>

                    {{ $supervision->fecha_supervision }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Resultado</strong>

                    <br>

                    {{ ucfirst($supervision->resultado) }}

                </div>

                <div class="col-12">

                    <strong>Observaciones</strong>

                    <br>

                    {{ $supervision->observaciones ?: 'Sin observaciones.' }}

                </div>

            </div>

            <hr>

            <div class="mt-3">

                <strong>

                    Evidencia fotográfica

                </strong>

                <br><br>

                @if($supervision->foto)

                    <img
                        src="{{ asset('storage/' . $supervision->foto) }}"
                        class="img-fluid rounded shadow"
                        style="max-width:400px;"
                    >

                @else

                    <div class="alert alert-secondary mb-0">

                        No existe evidencia fotográfica.

                    </div>

                @endif

            </div>

            @if($supervision->resultado != 'correcto')

                @if($supervision->incidencia)

                    <a
                        href="{{ route(
                            'operaciones.incidencias.show',
                            $supervision->incidencia
                        ) }}"
                        class="btn btn-info"
                    >

                        Ver Incidencia

                    </a>

                @else

                    <a
                        href="{{ route(
                            'operaciones.incidencias.create.supervision',
                            $supervision
                        ) }}"
                        class="btn btn-danger"
                    >

                        Generar Incidencia

                    </a>

                @endif

            @endif

            <hr>

            <h4>

                Evidencias Relacionadas

            </h4>

            @if($supervision->evidencias->count())

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>

                                    Título

                                </th>

                                <th>

                                    Fotografía

                                </th>

                                <th>

                                    Acciones

                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($supervision->evidencias as $evidencia)

                                <tr>

                                    <td>

                                        {{ $evidencia->titulo }}

                                    </td>

                                    <td>

                                        <img
                                            src="{{ asset('storage/'.$evidencia->foto) }}"
                                            width="120"
                                            class="rounded"
                                        >

                                    </td>

                                    <td>

                                        <a
                                            href="{{ route(
                                                'operaciones.evidencias.show',
                                                $evidencia
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                        >

                                            Ver

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-secondary">

                    Esta supervisión todavía no tiene evidencias.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
