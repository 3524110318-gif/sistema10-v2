@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-car-front me-2"></i>

                Vehículos

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra las unidades vehiculares de Operaciones.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.vehiculos.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo vehículo

        </a>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de vehículos

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $vehiculos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Unidad</th>

                            <th>Placas</th>

                            <th>Marca</th>

                            <th>Modelo</th>

                            <th>Kilometraje</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse(
                            $vehiculos
                            as $vehiculo
                        )

                            <tr>

                                {{-- UNIDAD --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $vehiculo->unidad }}

                                    </span>

                                </td>


                                {{-- PLACAS --}}
                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $vehiculo->placas }}

                                    </span>

                                </td>


                                {{-- MARCA --}}
                                <td>

                                    {{ $vehiculo->marca }}

                                </td>


                                {{-- MODELO --}}
                                <td>

                                    <div>

                                        <span class="text-light d-block">

                                            {{ $vehiculo->modelo }}

                                        </span>

                                        <small class="text-secondary">

                                            Año {{ $vehiculo->anio }}

                                        </small>

                                    </div>

                                </td>


                                {{-- KILOMETRAJE --}}
                                <td>

                                    <i class="bi bi-speedometer2 text-warning me-1"></i>

                                    {{
                                        number_format(
                                            $vehiculo->kilometraje_actual
                                        )
                                    }}

                                    km

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($vehiculo->estado === 'activo')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @elseif($vehiculo->estado === 'taller')

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-wrench-adjustable me-1"></i>

                                            Taller

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Baja

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <a
                                        href="{{ route(
                                            'operaciones.vehiculos.edit',
                                            $vehiculo->id
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Editar vehículo"
                                    >

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-car-front
                                            fs-1
                                            text-secondary
                                            d-block
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin vehículos registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra una nueva unidad vehicular para comenzar.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if(
            method_exists($vehiculos, 'hasPages')
            &&
            $vehiculos->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $vehiculos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection