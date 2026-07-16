@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Plazas Operativas

        </h1>

        <a
            href="{{ route(
                'operaciones.plazas.create'
            ) }}"
            class="btn btn-primary"
        >

            Nueva Plaza

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Servicio</th>
                <th>Nombre Plaza</th>
                <th>Turno</th>
                <th>Horario</th>
                <th>Estado</th>

            </tr>

        </thead>

        <tbody>

            @forelse($plazas as $plaza)

                <tr>

                    <td>

                        {{ $plaza->servicio->nombre }}

                    </td>

                    <td>

                        {{ $plaza->nombre_plaza }}

                    </td>

                    <td>

                        {{ ucfirst($plaza->turno) }}

                    </td>

                    <td>

                        {{ $plaza->hora_entrada }}
                        -
                        {{ $plaza->hora_salida }}

                    </td>

                    <td>

                        {{ ucfirst($plaza->estado) }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        Sin plazas

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
