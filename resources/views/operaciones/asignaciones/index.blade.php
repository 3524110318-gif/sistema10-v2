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

                        <col style="width:27%">

                        <col style="width:23%">

                        <col style="width:17%">

                        <col style="width:15%">

                        <col style="width:18%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Plaza</th>

                            <th>Vigencia</th>

                            <th>Estado</th>

                            <th class="text-end">Acciones</th>

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


                                {{-- VIGENCIA --}}
                                <td>

                                    <span class="text-light d-block">

                                        <i class="bi bi-calendar3 me-1 text-warning"></i>

                                        Inicio:

                                        {{ $asignacion->fecha_inicio }}

                                    </span>

                                    @if($asignacion->fecha_fin)

                                        <small class="text-secondary d-block mt-1">

                                            Fin:

                                            {{ $asignacion->fecha_fin }}

                                        </small>

                                    @endif

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($asignacion->estado === 'activa')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @elseif($asignacion->estado === 'finalizada')

                                        <span class="badge bg-secondary">

                                            <i class="bi bi-check2-square me-1"></i>

                                            Finalizado

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst(
                                                $asignacion->estado
                                            ) }}

                                        </span>

                                    @endif

                                </td>

                                {{-- ACCIONES --}}
                                <td class="text-end">

                                    @if($asignacion->estado === 'activa')

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'operaciones.asignaciones.finalizar',
                                                $asignacion
                                            ) }}"
                                            class="d-inline"
                                            onsubmit="
                                                return confirm(
                                                    '¿Deseas finalizar esta asignación? La plaza volverá a quedar vacante.'
                                                );
                                            "
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-sm gtri-btn-secondary"
                                            >

                                                <i class="bi bi-check2-circle me-1"></i>

                                                Finalizar

                                            </button>

                                        </form>

                                    @else

                                        <span class="text-secondary">

                                            Sin acciones

                                        </span>

                                    @endif

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