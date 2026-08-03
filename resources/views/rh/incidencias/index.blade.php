@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div
            class="
                d-flex
                flex-column
                flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
            "
        >
            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    Incidencias RH

                </h2>

                <p class="gtri-page-subtitle">

                    Consulta, registra y da seguimiento a las incidencias del personal.

                </p>

            </div>


            <a
                href="{{ route('rh.incidencias.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-2"></i>

                Nueva incidencia

            </a>
        </div>

    </div>

    <form
        method="GET"
        action="{{ route('rh.incidencias.index') }}"
        class="mb-4"
    >

        <div class="row g-3 align-items-end">

            <div class="col-lg-8">

                <label
                    for="buscar"
                    class="form-label text-light fw-semibold"
                >

                    Buscar incidencia

                </label>

                <input
                    type="text"
                    name="buscar"
                    id="buscar"
                    class="form-control gtri-input"
                    placeholder="Empleado, número de control, tipo, estado o fecha..."
                    value="{{ request('buscar') }}"
                >

            </div>


            <div class="col-lg-4">

                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>


                    @if (request('buscar'))

                        <a
                            href="{{ route('rh.incidencias.index') }}"
                            class="btn gtri-btn-secondary"
                        >

                            <i class="bi bi-x-circle me-1"></i>

                            Limpiar

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </form>

    {{-- RESUMEN --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-4">

        <div class="col">

            <div class="gtri-card h-100">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-secondary d-block mb-1">

                            Total

                        </span>

                        <span class="fs-3 fw-bold text-light">

                            {{ $totalIncidencias }}

                        </span>

                    </div>

                    <div class="gtri-summary-icon text-light">

                        <i class="bi bi-clipboard-data"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col">

            <div class="gtri-card h-100">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-secondary d-block mb-1">

                            Pendientes

                        </span>

                        <span class="fs-3 fw-bold text-warning">

                            {{ $pendientes }}

                        </span>

                    </div>

                    <div class="gtri-summary-icon">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col">

            <div class="gtri-card h-100">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-secondary d-block mb-1">

                            Justificadas

                        </span>

                        <span class="fs-3 fw-bold text-success">

                            {{ $justificadas }}

                        </span>

                    </div>

                    <div class="gtri-summary-icon text-success">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col">

            <div class="gtri-card h-100">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-secondary d-block mb-1">

                            Injustificadas

                        </span>

                        <span class="fs-3 fw-bold text-danger">

                            {{ $injustificadas }}

                        </span>

                    </div>

                    <div class="gtri-summary-icon text-danger">

                        <i class="bi bi-x-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- CONTENIDO PRINCIPAL --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
                gap-3
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de incidencias

            </div>


            <div>

                <span class="text-secondary">

                    Registros encontrados:

                </span>

                <span class="text-warning fw-bold">

                    {{ $incidencias->total() }}

                </span>

            </div>

        </div>


        {{-- TABLA --}}
        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:28%">

                        <col style="width:15%">

                        <col style="width:15%">

                        <col style="width:16%">

                        <col style="width:26%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>

                                <i class="bi bi-person me-1"></i>

                                Empleado

                            </th>

                            <th>

                                <i class="bi bi-tag me-1"></i>

                                Tipo

                            </th>

                            <th>

                                <i class="bi bi-calendar-event me-1"></i>

                                Fecha

                            </th>

                            <th>

                                <i class="bi bi-circle-half me-1"></i>

                                Estado

                            </th>

                            <th class="text-center">

                                <i class="bi bi-sliders me-1"></i>

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

                                            {{ $incidencia->empleado->apellido_materno }}

                                        </span>

                                        <small class="text-secondary">

                                            <i class="bi bi-person-badge me-1"></i>

                                            {{ $incidencia->empleado->numero_control }}

                                        </small>

                                    </div>

                                </td>


                                {{-- TIPO --}}
                                <td>

                                    <span class="gtri-type-badge">

                                        @switch($incidencia->tipo)

                                            @case('falta')

                                                <i class="bi bi-person-x me-1"></i>

                                                @break

                                            @case('retardo')

                                                <i class="bi bi-clock-history me-1"></i>

                                                @break

                                            @case('permiso')

                                                <i class="bi bi-file-earmark-check me-1"></i>

                                                @break

                                            @case('incapacidad')

                                                <i class="bi bi-heart-pulse me-1"></i>

                                                @break

                                        @endswitch

                                        {{ ucfirst($incidencia->tipo) }}

                                    </span>

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    <span class="text-light">

                                        <i class="bi bi-calendar3 me-1 text-secondary"></i>

                                        {{ \Carbon\Carbon::parse(
                                            $incidencia->fecha
                                        )->format('d/m/Y') }}

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
                                                align-items-center
                                                gap-2
                                            "
                                        >

                                            {{-- EDITAR --}}
                                            <a
                                                href="{{ route('rh.incidencias.edit', $incidencia->id) }}"
                                                class="btn gtri-btn-secondary btn-sm gtri-btn-icon"
                                                title="Editar incidencia"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- JUSTIFICAR --}}
                                            <form
                                                method="POST"
                                                action="{{ route('rh.incidencias.justificar', $incidencia->id) }}"
                                                class="mb-0"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn gtri-btn-secondary btn-sm gtri-btn-icon"
                                                    title="Justificar incidencia"
                                                    onclick="return confirm('¿Seguro que deseas justificar esta incidencia?')"
                                                >
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                            </form>

                                            {{-- INJUSTIFICAR --}}
                                            <form
                                                method="POST"
                                                action="{{ route('rh.incidencias.injustificar', $incidencia->id) }}"
                                                class="mb-0"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn gtri-btn-secondary btn-sm gtri-btn-icon"
                                                    title="Marcar como injustificada"
                                                    onclick="return confirm('¿Seguro que deseas marcar esta incidencia como injustificada?')"
                                                >
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </form>

                                        </div>

                                    @else

                                        <span class="text-secondary small">

                                            <i class="bi bi-check2-all me-1"></i>

                                            Procesada

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
                                            bi-clipboard-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>


                                    @if(request('buscar'))

                                        <h5 class="text-light">

                                            No se encontraron incidencias

                                        </h5>

                                        <p class="text-secondary mb-3">

                                            No existen resultados para:

                                            <span class="text-warning">

                                                "{{ request('buscar') }}"

                                            </span>

                                        </p>

                                        <a
                                            href="{{ route('rh.incidencias.index') }}"
                                            class="btn btn-outline-light btn-sm"
                                        >

                                            <i class="bi bi-arrow-counterclockwise me-1"></i>

                                            Mostrar todas

                                        </a>

                                    @else

                                        <h5 class="text-light">

                                            No hay incidencias registradas

                                        </h5>

                                        <p class="text-secondary mb-3">

                                            Actualmente no existen incidencias de Recursos Humanos.

                                        </p>

                                        <a
                                            href="{{ route('rh.incidencias.create') }}"
                                            class="btn gtri-btn-primary btn-sm"
                                        >

                                            <i class="bi bi-plus-circle me-1"></i>

                                            Registrar primera incidencia

                                        </a>

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if ($incidencias->hasPages())

            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                    gap-3
                    mt-4
                "
            >

                <small class="text-secondary">

                    Mostrando

                    <span class="text-light fw-semibold">

                        {{ $incidencias->firstItem() }}

                    </span>

                    a

                    <span class="text-light fw-semibold">

                        {{ $incidencias->lastItem() }}

                    </span>

                    de

                    <span class="text-warning fw-semibold">

                        {{ $incidencias->total() }}

                    </span>

                    registros

                </small>


                <div>

                    {{ $incidencias->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@endsection