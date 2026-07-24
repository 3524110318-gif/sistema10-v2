@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar3 me-2"></i>

                Calendario laboral

            </h2>

            <p class="gtri-page-subtitle">

                Consulta los días laborales, descansos, festivos y vacaciones registrados.

            </p>

        </div>


        <a
            href="{{ route('rh.calendario.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-calendar-plus me-1"></i>

            Nuevo día

        </a>

    </div>


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

                Días registrados

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $dias->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:25%">

                        <col style="width:25%">

                        <col style="width:50%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Fecha</th>

                            <th>Tipo</th>

                            <th>Descripción</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($dias as $dia)

                            <tr>

                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $dia->fecha }}

                                    </span>

                                </td>


                                <td>

                                    <x-rh.badge-tipo-dia
                                        :tipo="$dia->tipo"
                                    />

                                </td>


                                <td>

                                    <span class="text-secondary">

                                        {{ $dia->descripcion ?: 'Sin descripción' }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-calendar-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay fechas registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo día para comenzar a construir el calendario laboral.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if (method_exists($dias, 'hasPages') && $dias->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $dias->links() }}

            </div>

        @endif

    </div>

</div>

@endsection