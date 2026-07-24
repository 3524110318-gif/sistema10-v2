@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar2-week me-2"></i>

                Vacaciones RH

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y gestiona las solicitudes de vacaciones del personal.

            </p>

        </div>


        <a
            href="{{ route('rh.vacaciones.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva solicitud

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

                Solicitudes de vacaciones

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $vacaciones->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:25%">

                        <col style="width:14%">

                        <col style="width:14%">

                        <col style="width:9%">

                        <col style="width:14%">

                        <col style="width:24%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Inicio</th>

                            <th>Fin</th>

                            <th>Días</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($vacaciones as $vacacion)

                            <tr>

                                {{-- EMPLEADO --}}
                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $vacacion->empleado->nombre }}

                                            {{ $vacacion->empleado->apellido_paterno }}

                                        </span>

                                        <small class="text-secondary">

                                            {{ $vacacion->empleado->numero_control }}

                                        </small>

                                    </div>

                                </td>


                                {{-- INICIO --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $vacacion->fecha_inicio }}

                                    </span>

                                </td>


                                {{-- FIN --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $vacacion->fecha_fin }}

                                    </span>

                                </td>


                                {{-- DÍAS --}}
                                <td>

                                    <span class="text-warning fw-bold">

                                        {{ $vacacion->dias }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    <x-rh.vacaciones.badge-estado
                                        :estado="$vacacion->estado"
                                    />

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    @if ($vacacion->estado === 'pendiente')

                                        <div
                                            class="
                                                d-flex
                                                justify-content-center
                                                gap-2
                                                flex-nowrap
                                            "
                                        >

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'rh.vacaciones.aprobar',
                                                    $vacacion->id
                                                ) }}"
                                            >

                                                @csrf
                                                @method('PATCH')


                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm(
                                                        '¿Seguro que deseas aprobar esta solicitud?'
                                                    )"
                                                >

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Aprobar

                                                </button>

                                            </form>


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'rh.vacaciones.rechazar',
                                                    $vacacion->id
                                                ) }}"
                                            >

                                                @csrf
                                                @method('PATCH')


                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm(
                                                        '¿Seguro que deseas rechazar esta solicitud?'
                                                    )"
                                                >

                                                    <i class="bi bi-x-circle me-1"></i>

                                                    Rechazar

                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <span class="text-secondary">

                                            <i class="bi bi-dash-circle me-1"></i>

                                            Sin acciones

                                        </span>

                                    @endif

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
                                            bi-calendar-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay solicitudes de vacaciones

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Actualmente no existen solicitudes registradas.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if (
            method_exists($vacaciones, 'hasPages') &&
            $vacaciones->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $vacaciones->links() }}

            </div>

        @endif

    </div>

</div>

@endsection