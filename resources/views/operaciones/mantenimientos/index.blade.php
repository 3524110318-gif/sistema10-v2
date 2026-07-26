@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-wrench-adjustable me-2"></i>

                Mantenimientos

            </h2>

            <p class="gtri-page-subtitle">

                Consulta el historial de mantenimientos y próximos servicios
                de las unidades vehiculares.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.mantenimientos.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo mantenimiento

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

                Historial de mantenimientos

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $mantenimientos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Vehículo</th>

                            <th>Fecha</th>

                            <th>Kilometraje</th>

                            <th>Tipo</th>

                            <th>Próximo mantenimiento</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $mantenimientos
                            as $mantenimiento
                        )

                            <tr>

                                {{-- VEHÍCULO --}}
                                <td>

                                    <div>

                                        <span class="text-warning fw-semibold d-block">

                                            {{
                                                $mantenimiento
                                                    ->vehiculo
                                                    ->unidad
                                            }}

                                        </span>

                                        <small class="text-secondary">

                                            {{
                                                $mantenimiento
                                                    ->vehiculo
                                                    ->placas
                                            }}

                                        </small>

                                    </div>

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    <i
                                        class="
                                            bi
                                            bi-calendar3
                                            text-warning
                                            me-1
                                        "
                                    ></i>

                                    {{ $mantenimiento->fecha }}

                                </td>


                                {{-- KM --}}
                                <td>

                                    <i
                                        class="
                                            bi
                                            bi-speedometer2
                                            text-warning
                                            me-1
                                        "
                                    ></i>

                                    {{
                                        number_format(
                                            $mantenimiento
                                                ->kilometraje
                                        )
                                    }}

                                    km

                                </td>


                                {{-- TIPO --}}
                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $mantenimiento->tipo }}

                                    </span>

                                </td>


                                {{-- PRÓXIMO --}}
                                <td>

                                    <span class="badge bg-info text-dark">

                                        {{
                                            number_format(
                                                $mantenimiento
                                                    ->proximo_mantenimiento
                                            )
                                        }}

                                        km

                                    </span>

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <a
                                        href="{{ route(
                                            'operaciones.mantenimientos.edit',
                                            $mantenimiento->id
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Editar mantenimiento"
                                    >

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-tools
                                            fs-1
                                            text-secondary
                                            d-block
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin mantenimientos registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra el primer mantenimiento
                                        de una unidad vehicular.

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
            method_exists($mantenimientos, 'hasPages')
            &&
            $mantenimientos->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $mantenimientos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection