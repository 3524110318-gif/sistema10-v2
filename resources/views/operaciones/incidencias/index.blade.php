@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Incidencias Operativas

        </h1>

        <a
            href="{{ route(
                'operaciones.incidencias.create'
            ) }}"
            class="btn btn-primary"
        >

            Nueva Incidencia

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>

                    Guardia

                </th>

                <th>

                    Servicio

                </th>

                <th>

                    Plaza

                </th>

                <th>

                    Fecha

                </th>

                <th>

                    Tipo

                </th>

                <th>

                    Estado

                </th>

                <th>

                    Acciones

                </th>

            </tr>

        </thead>

        <tbody>

            @forelse(
                $incidencias
                as $incidencia
            )

                <tr>

                    <td>

                        {{ $incidencia->supervision?->asignacion?->empleado?->nombre }}

                        {{ $incidencia->supervision?->asignacion?->empleado?->apellido_paterno }}

                    </td>

                    <td>

                        {{ $incidencia->servicio->nombre }}

                    </td>

                    <td>

                        {{ $incidencia->supervision?->asignacion?->plaza?->nombre_plaza }}

                    </td>

                    <td>

                        {{ $incidencia->supervision?->fecha_supervision }}

                    </td>

                    <td>

                        {{ ucfirst($incidencia->tipo) }}

                    </td>

                    <td>

                        @if($incidencia->estado == 'abierta')

                            <span class="badge bg-danger">

                                Abierta

                            </span>

                        @else

                            <span class="badge bg-success">

                                Cerrada

                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route(
                                'operaciones.incidencias.show',
                                $incidencia
                            ) }}"
                            class="btn btn-primary btn-sm"
                        >

                            Ver

                        </a>

                        @if($incidencia->estado != 'cerrada')

                            <form
                                method="POST"
                                action="{{ route(
                                    'operaciones.incidencias.cerrar',
                                    $incidencia
                                ) }}"
                                class="d-inline"
                            >

                                @csrf

                                @method('PATCH')

                                <button
                                    class="btn btn-success btn-sm"
                                >

                                    Cerrar

                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        Sin incidencias

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
