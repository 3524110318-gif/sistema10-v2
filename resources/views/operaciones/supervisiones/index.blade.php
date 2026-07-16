@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Supervisiones

        </h1>

        <a
            href="{{ route(
                'operaciones.supervisiones.create'
            ) }}"
            class="btn btn-primary"
        >

            Nueva Supervisión

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>
                <th>Guardia</th>

                <th>Servicio</th>

                <th>Plaza</th>

                <th>Turno</th>

                <th>Fecha</th>

                <th>Resultado</th>

                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @forelse(
                $supervisiones
                as $supervision
            )

                <tr>

                    <td>

                        {{ $supervision->asignacion->empleado->nombre }}
                        {{ $supervision->asignacion->empleado->apellido_paterno }}

                    </td>

                    <td>

                        {{ $supervision->asignacion->plaza->servicio->nombre }}

                    </td>

                    <td>

                        {{ $supervision->asignacion->plaza->nombre_plaza }}

                    </td>

                    <td>

                        {{ ucfirst($supervision->asignacion->plaza->turno) }}

                    </td>

                    <td>

                        {{ $supervision->fecha_supervision }}

                    </td>

                    <td>

                        @if($supervision->resultado == 'correcto')

                            <span class="badge bg-success">

                                Correcto

                            </span>

                        @elseif($supervision->resultado == 'incidencia')

                            <span class="badge bg-warning text-dark">

                                Incidencia

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Ausente

                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route(
                                'operaciones.supervisiones.show',
                                $supervision
                            ) }}"
                            class="btn btn-info btn-sm"
                        >

                            Ver

                        </a>

                          <a
                                href="{{ route(
                                    'operaciones.supervisiones.edit',
                                    $supervision
                                ) }}"
                                class="btn btn-warning btn-sm"
                            >

                                Editar

                            </a>

                            @if(
                                $supervision->resultado != 'correcto'
                            )

                                @if(
                                    $supervision->incidencia
                                )

                                    <a
                                        href="{{ route(
                                            'operaciones.incidencias.index'
                                        ) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        Ver Incidencia

                                    </a>

                                @else

                                    <a
                                        href="{{ route(
                                            'operaciones.incidencias.create.supervision',
                                            $supervision
                                        ) }}"
                                        class="btn btn-danger btn-sm"
                                    >

                                        Generar Incidencia

                                    </a>

                                @endif

                            @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        Sin supervisiones

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
