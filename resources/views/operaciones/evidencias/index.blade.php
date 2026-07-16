@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Evidencias

        </h1>

        <a
            href="{{ route(
                'operaciones.evidencias.create'
            ) }}"
            class="btn btn-primary"
        >

            Nueva Evidencia

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

                    Título

                </th>

                <th>

                    Foto

                </th>

                <th>

                    Acciones

                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($evidencias as $evidencia)

                <tr>

                    <td>

                        {{ $evidencia->supervision->asignacion->empleado->nombre }}

                        {{ $evidencia->supervision->asignacion->empleado->apellido_paterno }}

                    </td>

                    <td>

                        {{ $evidencia->supervision->asignacion->plaza->servicio->nombre }}

                    </td>

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

                        <a
                            href="{{ route(
                                'operaciones.evidencias.edit',
                                $evidencia
                            ) }}"
                            class="btn btn-warning btn-sm"
                        >

                            Editar

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5">

                        Sin evidencias registradas.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
