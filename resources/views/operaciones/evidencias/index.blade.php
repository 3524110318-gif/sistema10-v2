@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-images me-2"></i>

                Evidencias

            </h2>

            <p class="gtri-page-subtitle">

                Consulta las evidencias fotográficas registradas durante las supervisiones.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.evidencias.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-camera-fill me-1"></i>

            Nueva evidencia

        </a>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de evidencias

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $evidencias->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Guardia</th>

                            <th>Servicio</th>

                            <th>Título</th>

                            <th>Fotografía</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $evidencias
                            as $evidencia
                        )

                            <tr>

                                {{-- GUARDIA --}}
                                <td>

                                    <div>

                                        <span
                                            class="
                                                text-light
                                                fw-semibold
                                                d-block
                                            "
                                        >

                                            {{
                                                $evidencia
                                                    ->supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->nombre
                                            }}

                                            {{
                                                $evidencia
                                                    ->supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->apellido_paterno
                                            }}

                                        </span>

                                        <small class="text-secondary">

                                            {{
                                                $evidencia
                                                    ->supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->numero_control
                                            }}

                                        </small>

                                    </div>

                                </td>


                                {{-- SERVICIO --}}
                                <td>

                                    <span class="text-light">

                                        {{
                                            $evidencia
                                                ->supervision
                                                ->asignacion
                                                ->plaza
                                                ->servicio
                                                ->nombre
                                        }}

                                    </span>

                                </td>


                                {{-- TÍTULO --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $evidencia->titulo }}

                                    </span>

                                </td>


                                {{-- FOTO --}}
                                <td>

                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $evidencia->foto
                                        ) }}"
                                        width="120"
                                        height="75"
                                        class="rounded"
                                        style="
                                            object-fit:cover;
                                            border:
                                                1px solid
                                                rgba(212,175,55,.35);
                                        "
                                        alt="Evidencia"
                                    >

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <div
                                        class="
                                            d-flex
                                            justify-content-center
                                            gap-2
                                            flex-nowrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'operaciones.evidencias.show',
                                                $evidencia
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver evidencia"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-camera
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin evidencias registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra una nueva evidencia fotográfica para comenzar.

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
            method_exists($evidencias, 'hasPages')
            &&
            $evidencias->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $evidencias->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection