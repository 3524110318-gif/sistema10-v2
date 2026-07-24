@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-check me-2"></i>

                Asignaciones

            </h2>

            <p class="gtri-page-subtitle">

                Consulta las asignaciones activas del personal a plazas operativas.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.asignaciones.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva asignación

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

                Lista de asignaciones

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $asignaciones->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:32%">

                        <col style="width:28%">

                        <col style="width:20%">

                        <col style="width:20%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Plaza</th>

                            <th>Fecha de inicio</th>

                            <th>Estado</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse(
                            $asignaciones
                            as $asignacion
                        )

                            <tr>

                                {{-- EMPLEADO --}}
                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $asignacion->empleado->nombre }}

                                            {{ $asignacion->empleado->apellido_paterno }}

                                        </span>

                                        <small class="text-secondary">

                                            {{ $asignacion->empleado->numero_control }}

                                        </small>

                                    </div>

                                </td>


                                {{-- PLAZA --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $asignacion->plaza->nombre_plaza }}

                                    </span>

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    <span class="text-light">

                                        <i class="bi bi-calendar3 me-1 text-warning"></i>

                                        {{ $asignacion->fecha_inicio }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($asignacion->estado === 'activo')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @elseif($asignacion->estado === 'finalizado')

                                        <span class="badge bg-secondary">

                                            <i class="bi bi-check2-square me-1"></i>

                                            Finalizado

                                        </span>

                                    @elseif($asignacion->estado === 'cancelado')

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Cancelado

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst(
                                                $asignacion->estado
                                            ) }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-person-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin asignaciones registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra una nueva asignación para comenzar.

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
            method_exists($asignaciones, 'hasPages')
            &&
            $asignaciones->hasPages()
        )

            <div
                class="
                    d-flex
                    justify-content-center
                    mt-4
                "
            >

                {{ $asignaciones->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection