@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Vehículos

        </h1>

        <a
            href="{{ route(
                'operaciones.vehiculos.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Vehículo

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Unidad</th>

                <th>Placas</th>

                <th>Marca</th>

                <th>Modelo</th>

                <th>Km</th>

                <th>Estado</th>

                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse(
                $vehiculos as $vehiculo
            )

                <tr>

                    <td>

                        {{ $vehiculo->unidad }}

                    </td>

                    <td>

                        {{ $vehiculo->placas }}

                    </td>

                    <td>

                        {{ $vehiculo->marca }}

                    </td>

                    <td>

                        {{ $vehiculo->modelo }}

                    </td>

                    <td>

                        {{ number_format(
                            $vehiculo->kilometraje_actual
                        ) }}

                        km

                    </td>

                    <td>

                        {{ ucfirst(
                            $vehiculo->estado
                        ) }}

                    </td>

                    <td>

                        <a
                            href="{{ route(
                                'operaciones.vehiculos.edit',
                                $vehiculo->id
                            ) }}"
                            class="btn btn-warning btn-sm"
                        >

                            Editar

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        Sin vehículos

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
