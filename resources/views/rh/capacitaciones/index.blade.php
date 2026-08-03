@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header gtri-expediente-header">


        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-mortarboard me-2"></i>

                Capacitaciones

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra las capacitaciones del personal.

            </p>

        </div>


        <a
            href="{{ route('rh.empleados') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-person-check me-1"></i>

            Registrar capacitación

        </a>


    </div>


    {{-- MENSAJES --}}
    @if (session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if (session('error'))

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- RESUMEN --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-xl-3 col-md-6">

            <div class="gtri-section mb-0 h-100">

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary d-block mb-1">

                            Total de capacitaciones

                        </small>

                        <span class="fs-3 fw-bold text-light">

                            {{ $totalCapacitaciones }}

                        </span>

                    </div>


                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-center
                            rounded-3
                        "
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(212,169,53,.12);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-mortarboard
                                fs-4
                                text-warning
                            "
                        ></i>

                    </div>

                </div>

            </div>
        </div>


        {{-- VIGENTES --}}
        <div class="col-xl-3 col-md-6">

            <div class="gtri-section mb-0 h-100">

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary d-block mb-1">

                            Vigentes

                        </small>

                        <span class="fs-3 fw-bold text-success">

                            {{ $vigentes }}

                        </span>

                    </div>


                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-center
                            rounded-3
                        "
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(25,135,84,.12);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-check-circle
                                fs-4
                                text-success
                            "
                        ></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRÓXIMAS A VENCER --}}
        <div class="col-xl-3 col-md-6">

            <div class="gtri-section mb-0 h-100">

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary d-block mb-1">

                            Próximas a vencer

                        </small>

                        <span class="fs-3 fw-bold text-warning">

                            {{ $proximasAVencer }}

                        </span>

                    </div>


                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-center
                            rounded-3
                        "
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(255,193,7,.12);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-hourglass-split
                                fs-4
                                text-warning
                            "
                        ></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- VENCIDAS --}}
        <div class="col-xl-3 col-md-6">

            <div class="gtri-section mb-0 h-100">

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        gap-3
                    "
                >

                    <div>

                        <small class="text-secondary d-block mb-1">

                            Vencidas

                        </small>

                        <span class="fs-3 fw-bold text-danger">

                            {{ $vencidas }}

                        </span>

                    </div>


                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-center
                            rounded-3
                        "
                        style="
                            width:50px;
                            height:50px;
                            background:rgba(220,53,69,.12);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-exclamation-triangle
                                fs-4
                                text-danger
                            "
                        ></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <form
        method="GET"
        action="{{ route('rh.capacitaciones.index') }}"
        class="mb-4"
    >

        <div class="row g-3 align-items-end">

            <div class="col-lg-8">

                <label
                    for="buscar"
                    class="form-label text-light fw-semibold"
                >

                    Buscar

                </label>

                <input
                    type="text"
                    name="buscar"
                    id="buscar"
                    class="form-control gtri-input"
                    value="{{ $buscar }}"
                    placeholder="Empleado, número de control o curso"
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
                            href="{{ route('rh.calendario.index') }}"
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


    {{-- LISTADO --}}
    <div class="gtri-section mb-0">

        <div
            class="
                gtri-section-title
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-2
            "
        >

            <div>

                <span>01</span>

                Registro de capacitaciones

            </div>


            <small class="text-secondary">

                {{ $capacitaciones->total() }}

                {{ $capacitaciones->total() === 1
                    ? 'registro encontrado'
                    : 'registros encontrados' }}

            </small>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Curso</th>

                            <th class="text-center">
                                Calificación
                            </th>

                            <th>Vigencia</th>

                            <th>Estado</th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($capacitaciones as $capacitacion)

                            @php

                                $fechaVigencia =
                                    $capacitacion->vigencia_hasta
                                        ? \Carbon\Carbon::parse(
                                            $capacitacion->vigencia_hasta
                                        )
                                        : null;

                                $diasRestantes =
                                    $fechaVigencia
                                        ? today()->diffInDays(
                                            $fechaVigencia,
                                            false
                                        )
                                        : null;

                            @endphp


                            <tr>

                                {{-- EMPLEADO --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div>

                                            <div class="fw-semibold text-light">

                                                {{ $capacitacion->empleado->nombre }}

                                                {{ $capacitacion->empleado->apellido_paterno }}

                                                {{ $capacitacion->empleado->apellido_materno }}

                                            </div>


                                            <small class="text-secondary">

                                                {{ $capacitacion->empleado->numero_control }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- CURSO --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <i
                                            class="
                                                bi
                                                bi-mortarboard
                                                text-warning
                                            "
                                        ></i>

                                        <span>

                                            {{ $capacitacion->curso }}

                                        </span>

                                    </div>

                                </td>


                                {{-- CALIFICACIÓN --}}
                                <td class="text-center">

                                    @if (
                                        $capacitacion->calificacion !== null
                                    )

                                        <span
                                            class="{{
                                                $capacitacion->calificacion >= 80
                                                    ? 'gtri-badge-success'
                                                    : (
                                                        $capacitacion->calificacion >= 60
                                                            ? 'gtri-badge-warning'
                                                            : 'gtri-badge-danger'
                                                    )
                                            }}"
                                        >

                                            {{ $capacitacion->calificacion }}

                                        </span>

                                    @else

                                        <span class="text-secondary">

                                            —

                                        </span>

                                    @endif

                                </td>


                                {{-- VIGENCIA --}}
                                <td>

                                    @if ($fechaVigencia)

                                        {{ $fechaVigencia->format('d/m/Y') }}

                                    @else

                                        <span class="text-secondary">

                                            Sin vigencia

                                        </span>

                                    @endif

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if (!$fechaVigencia)

                                        <span class="gtri-badge-secondary">

                                            Sin vigencia

                                        </span>

                                    @elseif ($diasRestantes < 0)

                                        <span class="gtri-badge-danger">

                                            Vencida

                                        </span>

                                    @elseif ($diasRestantes <= 30)

                                        <span class="gtri-badge-warning">

                                            Próxima a vencer

                                        </span>

                                    @else

                                        <span class="gtri-badge-success">

                                            Vigente

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <div
                                        class="
                                            d-inline-flex
                                            justify-content-center
                                            align-items-center
                                            gap-2
                                            p-1
                                            rounded-3
                                        "
                                    >

                                        {{-- VER EMPLEADO --}}
                                        <a
                                            href="{{ route(
                                                'rh.empleados.show',
                                                $capacitacion->empleado_id
                                            ) }}"
                                            class="btn gtri-btn-secondary btn-sm px-3"

                                            title="Ver expediente del empleado"
                                        >

                                                <i class="bi bi-folder2-open me-1"></i>
                                        </a>


                                        {{-- EDITAR CAPACITACIÓN --}}
                                        <a
                                            href="{{ route(
                                                'rh.capacitaciones.edit',
                                                $capacitacion->id
                                            ) }}"
                                            class="
                                                btn
                                                gtri-btn-secondary
                                                btn-sm
                                                gtri-btn-icon
                                            "
                                            title="Editar capacitación"
                                        >

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="gtri-expediente-empty-table"
                                >

                                    <i class="bi bi-mortarboard"></i>

                                    <span>

                                        No se encontraron capacitaciones

                                    </span>

                                    @if ($buscar !== '' || $estado)

                                        <a
                                            href="{{ route(
                                                'rh.capacitaciones.index'
                                            ) }}"
                                            class="
                                                btn
                                                gtri-btn-secondary
                                                btn-sm
                                                mt-2
                                            "
                                        >

                                            Limpiar filtros

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
        @if ($capacitaciones->hasPages())

            <div
                class="
                    d-flex
                    justify-content-between
                    align-items-center
                    flex-wrap
                    gap-3
                    mt-4
                "
            >

                <small class="text-secondary">

                    Mostrando

                    {{ $capacitaciones->firstItem() }}

                    a

                    {{ $capacitaciones->lastItem() }}

                    de

                    {{ $capacitaciones->total() }}

                    registros

                </small>


                <div>

                    {{ $capacitaciones->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@endsection