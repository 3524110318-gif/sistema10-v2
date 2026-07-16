@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Mantenimientos

        </h1>

        <a
            href="{{ route(
                'operaciones.mantenimientos.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Mantenimiento

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>
                <th>Vehículo</th>
                <th>Fecha</th>
                <th>Km</th>
                <th>Tipo</th>
                <th>Próximo</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            @forelse(
                $mantenimientos as $mantenimiento
            )

                <tr>

                    <td>

                        {{ $mantenimiento
                            ->vehiculo
                            ->unidad }}

                    </td>

                    <td>

                        {{ $mantenimiento
                            ->fecha }}

                    </td>

                    <td>

                        {{ number_format(
                            $mantenimiento
                            ->kilometraje
                        ) }}

                    </td>

                    <td>

                        {{ $mantenimiento
                            ->tipo }}

                    </td>

                    <td>

                        {{ number_format(
                            $mantenimiento
                            ->proximo_mantenimiento
                        ) }}

                        km

                    </td>

                    <td>

                        <a
                            href="{{ route(
                                'operaciones.mantenimientos.edit',
                                $mantenimiento->id
                            ) }}"
                            class="btn btn-warning btn-sm"
                        >

                            Editar

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">

                        Sin mantenimientos

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
