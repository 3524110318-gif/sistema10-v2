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

                    <i class="bi bi-calendar2-week me-2"></i>

                    Vacaciones RH

                </h2>

                <p class="gtri-page-subtitle">

                    Consulta y gestiona las solicitudes de vacaciones del personal.

                </p>

            </div>

            <div>

                <a
                    href="{{ route('rh.vacaciones.create') }}"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Nueva solicitud

                </a>

            </div>
        </div>

    </div>

    <form
        method="GET"
        action="{{ route('rh.vacaciones.index') }}"
        class="mb-4"
    >

        <div class="row g-3 align-items-end">

            <div class="col-lg-8">

                <label
                    for="buscar"
                    class="form-label text-light"
                >

                    Buscar solicitud

                </label>

                <input
                    type="text"
                    name="buscar"
                    id="buscar"
                    class="form-control gtri-input"
                    placeholder="Busca por nombre, apellido, número de control o estado..."
                    value="{{ request('buscar') }}"
                >

            </div>


            <div class="col-lg-4">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>


                    @if (request('buscar'))

                        <a
                            href="{{ route('rh.vacaciones.index') }}"
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

                            Total de solicitudes

                        </small>

                        <span class="fs-3 fw-bold text-light">

                            {{ $vacaciones->count() }}

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
                                bi-calendar2-week
                                fs-4
                                text-warning
                            "
                        ></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENDIENTES --}}
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

                            Pendientes

                        </small>

                        <span class="fs-3 fw-bold text-warning">

                            {{ $vacaciones
                                ->where(
                                    'estado',
                                    'pendiente'
                                )
                                ->count()
                            }}

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


        {{-- APROBADAS --}}
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

                            Aprobadas

                        </small>

                        <span class="fs-3 fw-bold text-success">

                            {{ $vacaciones
                                ->where(
                                    'estado',
                                    'aprobada'
                                )
                                ->count()
                            }}

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


        {{-- RECHAZADAS --}}
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

                            Rechazadas

                        </small>

                        <span class="fs-3 fw-bold text-danger">

                            {{ $vacaciones
                                ->where(
                                    'estado',
                                    'rechazada'
                                )
                                ->count()
                            }}

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
                                bi-x-circle
                                fs-4
                                text-danger
                            "
                        ></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SOLICITUDES --}}
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

                Solicitudes de vacaciones

            </div>


            <div
                class="
                    d-flex
                    align-items-center
                    gap-2
                "
            >

                <i class="bi bi-list-ul text-warning"></i>

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

                        <col style="width:26%">

                        <col style="width:15%">

                        <col style="width:15%">

                        <col style="width:10%">

                        <col style="width:14%">

                        <col style="width:20%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Fecha de inicio</th>

                            <th>Fecha de fin</th>

                            <th class="text-center">

                                Días

                            </th>

                            <th class="text-center">

                                Estado

                            </th>

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

                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            gap-3
                                        "
                                    >


                                        <div>

                                            <span
                                                class="
                                                    text-light
                                                    fw-semibold
                                                    d-block
                                                "
                                            >

                                                {{ $vacacion
                                                    ->empleado
                                                    ->nombre
                                                }}

                                                {{ $vacacion
                                                    ->empleado
                                                    ->apellido_paterno
                                                }}

                                                {{ $vacacion
                                                    ->empleado
                                                    ->apellido_materno
                                                }}

                                            </span>

                                            <small class="text-secondary">

                                                <i class="bi bi-person-badge me-1"></i>

                                                {{ $vacacion
                                                    ->empleado
                                                    ->numero_control
                                                }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- FECHA DE INICIO --}}
                                <td>

                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            gap-2
                                        "
                                    >

                                        <i
                                            class="
                                                bi
                                                bi-calendar-event
                                                text-warning
                                            "
                                        ></i>

                                        <span class="text-light">

                                            {{ $vacacion->fecha_inicio }}

                                        </span>

                                    </div>

                                </td>


                                {{-- FECHA DE FIN --}}
                                <td>

                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            gap-2
                                        "
                                    >

                                        <i
                                            class="
                                                bi
                                                bi-calendar-check
                                                text-secondary
                                            "
                                        ></i>

                                        <span class="text-light">

                                            {{ $vacacion->fecha_fin }}

                                        </span>

                                    </div>

                                </td>


                                {{-- DÍAS --}}
                                <td class="text-center">

                                    <div
                                        class="
                                            d-inline-flex
                                            flex-column
                                            align-items-center
                                            justify-content-center
                                            rounded-3
                                            px-3
                                            py-2
                                        "
                                        style="
                                            min-width:65px;
                                            background:rgba(212,169,53,.10);
                                            border:1px solid rgba(212,169,53,.25);
                                        "
                                    >

                                        <span
                                            class="
                                                text-warning
                                                fw-bold
                                                fs-5
                                                lh-1
                                            "
                                        >

                                            {{ $vacacion->dias }}

                                        </span>

                                        <small class="text-secondary">

                                            días

                                        </small>

                                    </div>

                                </td>


                                {{-- ESTADO --}}
                                <td class="text-center">

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
        align-items-center
        gap-2
    "
>

    {{-- EDITAR --}}
    <a
        href="{{ route(
            'rh.vacaciones.edit',
            $vacacion->id
        ) }}"
        class="btn btn-outline-primary btn-sm rounded-circle"
        style="width:40px;height:40px;"
        title="Editar solicitud"
    >

        <i class="bi bi-pencil-square"></i>

    </a>


    {{-- APROBAR --}}
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
            class="btn btn-outline-success btn-sm rounded-circle"
            style="width:40px;height:40px;"
            title="Aprobar solicitud"
            onclick="return confirm(
                '¿Seguro que deseas aprobar esta solicitud?'
            )"
        >

            <i class="bi bi-check-lg"></i>

        </button>

    </form>


    {{-- RECHAZAR --}}
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
            class="btn btn-outline-warning btn-sm rounded-circle"
            style="width:40px;height:40px;"
            title="Rechazar solicitud"
            onclick="return confirm(
                '¿Seguro que deseas rechazar esta solicitud?'
            )"
        >

            <i class="bi bi-x-lg"></i>

        </button>

    </form>


    {{-- CANCELAR --}}
    <form
        method="POST"
        action="{{ route(
            'rh.vacaciones.cancelar',
            $vacacion->id
        ) }}"
    >

        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="btn btn-outline-secondary btn-sm rounded-circle"
            style="width:40px;height:40px;"
            title="Cancelar solicitud"
            onclick="return confirm(
                '¿Seguro que deseas cancelar esta solicitud?'
            )"
        >

            <i class="bi bi-slash-circle"></i>

        </button>

    </form>

</div>

                                    @else

                                        <span
                                            class="
                                                d-inline-flex
                                                align-items-center
                                                gap-1
                                                text-secondary
                                            "
                                        >

                                            <i class="bi bi-lock"></i>

                                            Procesada

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

                                    <div
                                        class="
                                            d-flex
                                            flex-column
                                            align-items-center
                                        "
                                    >

                                        <div
                                            class="
                                                d-flex
                                                align-items-center
                                                justify-content-center
                                                rounded-circle
                                                mb-3
                                            "
                                            style="
                                                width:72px;
                                                height:72px;
                                                background:rgba(212,169,53,.10);
                                            "
                                        >

                                            <i
                                                class="
                                                    bi
                                                    bi-calendar-x
                                                    fs-2
                                                    text-warning
                                                "
                                            ></i>

                                        </div>


                                        <h5 class="text-light mb-2">

                                            No hay solicitudes de vacaciones

                                        </h5>

                                        <p class="text-secondary mb-3">

                                            Actualmente no existen solicitudes registradas.

                                        </p>


                                        <a
                                            href="{{ route(
                                                'rh.vacaciones.create'
                                            ) }}"
                                            class="btn gtri-btn-primary"
                                        >

                                            <i class="bi bi-plus-circle me-1"></i>

                                            Crear primera solicitud

                                        </a>

                                    </div>

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