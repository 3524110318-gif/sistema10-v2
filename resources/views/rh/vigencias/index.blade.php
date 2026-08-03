@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header gtri-expediente-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar2-check me-2"></i>

                Vigencias

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra las vigencias documentales del personal.

            </p>

        </div>


        <a
            href="{{ route('rh.empleados') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-person-check me-1"></i>

            Registrar vigencia

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


    {{-- ERRORES DE VALIDACIÓN --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Revisa la información ingresada.

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

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

                            Total de vigencias

                        </small>

                        <span class="fs-3 fw-bold text-light">

                            {{ $totalVigencias }}

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
                                bi-calendar2-check
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


    {{-- BÚSQUEDA --}}
    <form
        method="GET"
        action="{{ route('rh.vigencias.index') }}"
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
                    value="{{ request('buscar') }}"
                    placeholder="Empleado, número de control o documento"
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
                            href="{{ route('rh.vigencias.index') }}"
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

                Registro de vigencias

            </div>


            <small class="text-secondary">

                {{ $vigencias->total() }}

                {{ $vigencias->total() === 1
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

                            <th>Documento</th>

                            <th class="text-center">

                                Días restantes

                            </th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($vigencias as $vigencia)

                            @php

                                $fechaVencimiento =
                                    $vigencia->fecha_vencimiento
                                        ? $vigencia
                                            ->fecha_vencimiento
                                            ->copy()
                                            ->startOfDay()
                                        : null;

                                $diasRestantes =
                                    $fechaVencimiento
                                        ? today()->diffInDays(
                                            $fechaVencimiento,
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

                                                {{ $vigencia->empleado->nombre }}

                                                {{ $vigencia->empleado->apellido_paterno }}

                                                {{ $vigencia->empleado->apellido_materno }}

                                            </div>


                                            <small class="text-secondary">

                                                {{ $vigencia->empleado->numero_control }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- DOCUMENTO --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <i
                                            class="
                                                bi
                                                bi-file-earmark-text
                                                text-warning
                                            "
                                        ></i>

                                        <span class="text-light">

                                            {{ $vigencia->documento }}

                                        </span>

                                    </div>

                                </td>


                                {{-- DÍAS RESTANTES --}}
                                <td class="text-center">
                                    @if ($diasRestantes === null)

                                        <span class="text-secondary">

                                            —

                                        </span>

                                    @elseif ($diasRestantes < 0)

                                        <span class="text-danger fw-semibold">

                                            Venció hace {{ abs($diasRestantes) }}
                                            {{ abs($diasRestantes) == 1 ? 'día' : 'días' }}

                                        </span>

                                    @elseif ($diasRestantes == 0)

                                        <span class="text-warning fw-semibold">

                                            Vence hoy

                                        </span>

                                    @else

                                        <span class="{{ $diasRestantes <= 30 ? 'text-warning' : 'text-success' }} fw-semibold">

                                            {{ $diasRestantes }}
                                            {{ $diasRestantes == 1 ? 'día' : 'días' }}

                                        </span>

                                    @endif
                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if ($diasRestantes === null)

                                        <span class="gtri-badge-secondary">

                                            Sin fecha

                                        </span>

                                    @elseif ($diasRestantes < 0)

                                        <span class="gtri-badge-danger">

                                            Vencida

                                        </span>

                                    @elseif ($diasRestantes == 0)

                                        <span class="gtri-badge-warning">

                                            Vence hoy

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

                                        {{-- VER EXPEDIENTE --}}
                                        <a
                                            href="{{ route(
                                                'rh.empleados.show',
                                                $vigencia->empleado_id
                                            ) }}"
                                            class="
                                                btn
                                                gtri-btn-secondary
                                                btn-sm
                                                gtri-btn-icon
                                            "
                                            title="Ver expediente del empleado"
                                        >

                                            <i class="bi bi-folder2-open"></i>

                                        </a>


                                        {{-- EDITAR VIGENCIA --}}
                                        <a
                                            href="{{ route(
                                                'rh.vigencias.edit',
                                                $vigencia->id
                                            ) }}"
                                            class="
                                                btn
                                                gtri-btn-secondary
                                                btn-sm
                                                gtri-btn-icon
                                            "
                                            title="Editar vigencia"
                                        >

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="gtri-expediente-empty-table"
                                >

                                    <i class="bi bi-calendar2-x"></i>

                                    <span>

                                        No se encontraron vigencias

                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if ($vigencias->hasPages())

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

                    {{ $vigencias->firstItem() }}

                    a

                    {{ $vigencias->lastItem() }}

                    de

                    {{ $vigencias->total() }}

                    registros

                </small>


                <div>

                    {{ $vigencias->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@endsection