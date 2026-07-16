@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Asignaciones

        </h1>

        <a
            href="{{ route(
                'operaciones.asignaciones.create'
            ) }}"
            class="btn btn-primary"
        >

            Nueva Asignación

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Empleado</th>
                <th>Plaza</th>
                <th>Fecha Inicio</th>
                <th>Estado</th>

            </tr>

        </thead>

        <tbody>

            @forelse(
                $asignaciones as $asignacion
            )

                <tr>

                    <td>

                        {{ $asignacion->empleado->nombre }}
                        {{ $asignacion->empleado->apellido_paterno }}

                    </td>

                    <td>

                        {{ $asignacion->plaza->nombre_plaza }}

                    </td>

                    <td>

                        {{ $asignacion->fecha_inicio }}

                    </td>

                    <td>

                        {{ ucfirst(
                            $asignacion->estado
                        ) }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        Sin asignaciones

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
