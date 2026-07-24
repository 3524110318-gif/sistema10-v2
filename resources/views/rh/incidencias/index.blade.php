@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-circle me-2"></i>

                Incidencias RH

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y gestiona las incidencias registradas del personal.

            </p>

        </div>


        <a
            href="{{ route('rh.incidencias.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva incidencia

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

                Lista de incidencias

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $incidencias->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:28%">

                        <col style="width:16%">

                        <col style="width:16%">

                        <col style="width:16%">

                        <col style="width:24%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Tipo</th>

                            <th>Fecha</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($incidencias as $incidencia)

                            <tr>

                                {{-- EMPLEADO --}}
                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $incidencia->empleado->nombre }}

                                            {{ $incidencia->empleado->apellido_paterno }}

                                        </span>

                                        <small class="text-secondary">

                                            {{ $incidencia->empleado->numero_control }}

                                        </small>

                                    </div>

                                </td>


                                {{-- TIPO --}}
                                <td>

                                    <span class="text-light">

                                        {{ ucfirst($incidencia->tipo) }}

                                    </span>

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $incidencia->fecha }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    <x-rh.incidencias.badge-estado
                                        :estado="$incidencia->estado"
                                    />

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    @if ($incidencia->estado === 'pendiente')

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
                                                    'rh.incidencias.justificar',
                                                    $incidencia->id
                                                ) }}"
                                            >

                                                @csrf
                                                @method('PATCH')


                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm(
                                                        '¿Seguro que deseas justificar esta incidencia?'
                                                    )"
                                                >

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Justificar

                                                </button>

                                            </form>


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'rh.incidencias.injustificar',
                                                    $incidencia->id
                                                ) }}"
                                            >

                                                @csrf
                                                @method('PATCH')


                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm(
                                                        '¿Seguro que deseas marcar esta incidencia como injustificada?'
                                                    )"
                                                >

                                                    <i class="bi bi-x-circle me-1"></i>

                                                    Injustificar

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
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-clipboard-check
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay incidencias registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Actualmente no existen incidencias de Recursos Humanos.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if (
            method_exists($incidencias, 'hasPages') &&
            $incidencias->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $incidencias->links() }}

            </div>

        @endif

    </div>

</div>

@endsection