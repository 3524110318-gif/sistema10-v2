@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-geo-alt me-2"></i>

                Plazas operativas

            </h2>

            <p class="gtri-page-subtitle">

                Consulta las plazas operativas registradas por servicio.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.plazas.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva plaza

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

                Lista de plazas operativas

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $plazas->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:24%">

                        <col style="width:24%">

                        <col style="width:16%">

                        <col style="width:22%">

                        <col style="width:14%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Servicio</th>

                            <th>Nombre de plaza</th>

                            <th>Turno</th>

                            <th>Horario</th>

                            <th>Estado</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($plazas as $plaza)

                            <tr>

                                {{-- SERVICIO --}}
                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $plaza->servicio->nombre }}

                                    </span>

                                </td>


                                {{-- PLAZA --}}
                                <td>

                                    <div>

                                        <span class="text-warning fw-semibold d-block">

                                            {{ $plaza->nombre_plaza }}

                                        </span>

                                        <small class="text-secondary">

                                            Plaza operativa

                                        </small>

                                    </div>

                                </td>


                                {{-- TURNO --}}
                                <td>

                                    @if($plaza->turno === 'diurno')

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-sun me-1"></i>

                                            Diurno

                                        </span>

                                    @elseif($plaza->turno === 'nocturno')

                                        <span class="badge bg-primary">

                                            <i class="bi bi-moon-stars me-1"></i>

                                            Nocturno

                                        </span>

                                    @elseif($plaza->turno === 'mixto')

                                        <span class="badge bg-info text-dark">

                                            <i class="bi bi-clock-history me-1"></i>

                                            Mixto

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst($plaza->turno) }}

                                        </span>

                                    @endif

                                </td>


                                {{-- HORARIO --}}
                                <td>

                                    <div class="text-light">

                                        <i
                                            class="
                                                bi
                                                bi-clock
                                                text-warning
                                                me-1
                                            "
                                        ></i>

                                        {{ $plaza->hora_entrada }}

                                        <span class="text-secondary mx-1">

                                            -

                                        </span>

                                        {{ $plaza->hora_salida }}

                                    </div>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($plaza->estado === 'cubierta')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Cubierta

                                        </span>

                                    @elseif($plaza->estado === 'vacante')

                                        <span class="badge bg-danger">

                                            <i class="bi bi-exclamation-circle me-1"></i>

                                            Vacante

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst($plaza->estado) }}

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
                                            bi-geo-alt
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay plazas operativas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra una nueva plaza para comenzar.

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
            method_exists($plazas, 'hasPages')
            &&
            $plazas->hasPages()
        )

            <div
                class="
                    d-flex
                    justify-content-center
                    mt-4
                "
            >

                {{ $plazas->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection