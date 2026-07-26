@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO Y RESUMEN --}}
    <div class="gtri-section">

        <div
            class="
                d-flex
                flex-column
                flex-lg-row
                justify-content-between
                align-items-lg-center
                gap-4
                mb-4
            "
        >

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-calendar3 me-2"></i>

                    Calendario laboral

                </h2>

                <p class="gtri-page-subtitle mb-0">

                    Consulta los días laborales, descansos, festivos
                    y vacaciones registrados.

                </p>

            </div>


            <a
                href="{{ route('rh.calendario.create') }}"
                class="
                    btn
                    gtri-btn-primary
                    px-4
                    py-3
                    fw-bold
                    flex-shrink-0
                "
            >

                <i class="bi bi-calendar-plus me-2"></i>

                Nuevo día

            </a>

        </div>

    </div>

    <div class="gtri-section">

        {{-- INDICADORES --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 g-3">

            {{-- TOTAL --}}
            <div class="col">

                <div class="gtri-expediente-field h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="
                                d-flex
                                align-items-center
                                justify-content-center
                                rounded-circle
                                flex-shrink-0
                                text-warning
                            "
                            style="
                                width:58px;
                                height:58px;
                                background:rgba(212,169,53,.10);
                                border:1px solid rgba(212,169,53,.30);
                            "
                        >

                            <i class="bi bi-calendar2-week fs-4"></i>

                        </div>

                        <div>

                            <small class="text-secondary d-block">

                                Total de registros

                            </small>

                            <span class="fs-3 text-warning fw-bold">

                                {{ $totalDias }}

                            </span>

                            <small class="text-secondary d-block">

                                Fechas registradas

                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- LABORALES --}}
            <div class="col">

                <div class="gtri-expediente-field h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="
                                d-flex
                                align-items-center
                                justify-content-center
                                rounded-circle
                                flex-shrink-0
                                text-success
                            "
                            style="
                                width:58px;
                                height:58px;
                                background:rgba(25,135,84,.10);
                                border:1px solid rgba(25,135,84,.30);
                            "
                        >

                            <i class="bi bi-briefcase fs-4"></i>

                        </div>

                        <div>

                            <small class="text-secondary d-block">

                                Días laborales

                            </small>

                            <span class="fs-3 text-success fw-bold">

                                {{ $totalLaborales }}

                            </span>

                            <small class="text-secondary d-block">

                                Jornadas registradas

                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FESTIVOS --}}
            <div class="col">

                <div class="gtri-expediente-field h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="
                                d-flex
                                align-items-center
                                justify-content-center
                                rounded-circle
                                flex-shrink-0
                                text-danger
                            "
                            style="
                                width:58px;
                                height:58px;
                                background:rgba(220,53,69,.10);
                                border:1px solid rgba(220,53,69,.30);
                            "
                        >

                            <i class="bi bi-stars fs-4"></i>

                        </div>

                        <div>

                            <small class="text-secondary d-block">

                                Días festivos

                            </small>

                            <span class="fs-3 text-danger fw-bold">

                                {{ $totalFestivos }}

                            </span>

                            <small class="text-secondary d-block">

                                Festivos registrados

                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- DESCANSOS --}}
            <div class="col">

                <div class="gtri-expediente-field h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="
                                d-flex
                                align-items-center
                                justify-content-center
                                rounded-circle
                                flex-shrink-0
                                text-warning
                            "
                            style="
                                width:58px;
                                height:58px;
                                background:rgba(255,193,7,.10);
                                border:1px solid rgba(255,193,7,.30);
                            "
                        >

                            <i class="bi bi-moon-stars fs-4"></i>

                        </div>

                        <div>

                            <small class="text-secondary d-block">

                                Días de descanso

                            </small>

                            <span class="fs-3 text-warning fw-bold">

                                {{ $totalDescansos }}

                            </span>

                            <small class="text-secondary d-block">

                                Descansos registrados

                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- VACACIONES --}}
            <div class="col">

                <div class="gtri-expediente-field h-100">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="
                                d-flex
                                align-items-center
                                justify-content-center
                                rounded-circle
                                flex-shrink-0
                                text-info
                            "
                            style="
                                width:58px;
                                height:58px;
                                background:rgba(13,202,240,.10);
                                border:1px solid rgba(13,202,240,.30);
                            "
                        >

                            <i class="bi bi-sun fs-4"></i>

                        </div>

                        <div>

                            <small class="text-secondary d-block">

                                Vacaciones

                            </small>

                            <span class="fs-3 text-info fw-bold">

                                {{ $totalVacaciones }}

                            </span>

                            <small class="text-secondary d-block">

                                Periodos registrados

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <form
        method="GET"
        action="{{ route('rh.calendario.index') }}"
        class="mb-4"
    >

        <div class="row g-3 align-items-end">

            <div class="col-lg-8">

                <label
                    for="buscar"
                    class="form-label text-light fw-semibold"
                >

                    Buscar fecha

                </label>

                <input
                    type="text"
                    name="buscar"
                    id="buscar"
                    class="form-control gtri-input"
                    placeholder="Busca por fecha, tipo o descripción..."
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

    {{-- DÍAS REGISTRADOS --}}
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

                Días registrados

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

                    {{ $totalDias }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:28%">

                        <col style="width:25%">

                        <col style="width:47%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>

                                <i class="bi bi-calendar-event me-2"></i>

                                Fecha

                            </th>

                            <th>

                                <i class="bi bi-bookmark me-2"></i>

                                Tipo

                            </th>

                            <th>

                                <i class="bi bi-card-text me-2"></i>

                                Descripción

                            </th>

                            <th>

                                <i class="bi bi-gear me-2"></i>

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($dias as $dia)

                            <tr>

                                {{-- FECHA --}}
                                <td>

                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            gap-3
                                        "
                                    >

                                        <div
                                            class="
                                                d-flex
                                                align-items-center
                                                justify-content-center
                                                rounded-3
                                                flex-shrink-0
                                                text-warning
                                            "
                                            style="
                                                width:44px;
                                                height:44px;
                                                background:rgba(212,169,53,.08);
                                                border:1px solid rgba(212,169,53,.20);
                                            "
                                        >

                                            <i class="bi bi-calendar3"></i>

                                        </div>


                                        <div>

                                            <span
                                                class="
                                                    text-light
                                                    fw-bold
                                                    d-block
                                                "
                                            >

                                                {{ $dia->fecha }}

                                            </span>


                                            <small class="text-secondary">

                                                {{ \Carbon\Carbon::parse(
                                                    $dia->fecha
                                                )
                                                    ->locale('es')
                                                    ->translatedFormat('l')
                                                }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- TIPO --}}
                                <td>

                                    <x-rh.badge-tipo-dia
                                        :tipo="$dia->tipo"
                                    />

                                </td>


                                {{-- DESCRIPCIÓN --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $dia->descripcion
                                            ?: 'Sin descripción registrada.'
                                        }}

                                    </span>

                                </td>

                                {{-- ACCIONES --}}
                                <td>

                                    <div class="d-flex flex-wrap gap-2">

                                        <a
                                            href="{{ route(
                                                'rh.calendario.edit',
                                                $dia
                                            ) }}"
                                            class="btn btn-sm gtri-btn-search"
                                        >

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Editar

                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'rh.calendario.destroy',
                                                $dia
                                            ) }}"
                                            onsubmit="
                                                return confirm(
                                                    '¿Seguro que deseas eliminar este día del calendario?'
                                                );
                                            "
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >

                                                <i class="bi bi-trash me-1"></i>

                                                Eliminar

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
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
                                                text-warning
                                            "
                                            style="
                                                width:76px;
                                                height:76px;
                                                background:rgba(212,169,53,.10);
                                                border:1px solid rgba(212,169,53,.25);
                                            "
                                        >

                                            <i
                                                class="
                                                    bi
                                                    bi-calendar-x
                                                    fs-2
                                                "
                                            ></i>

                                        </div>


                                        <h5 class="text-light mb-2">

                                            No hay fechas registradas

                                        </h5>

                                        <p class="text-secondary mb-3">

                                            Registra un día para comenzar
                                            a construir el calendario laboral.

                                        </p>


                                        <a
                                            href="{{ route(
                                                'rh.calendario.create'
                                            ) }}"
                                            class="btn gtri-btn-primary"
                                        >

                                            <i
                                                class="
                                                    bi
                                                    bi-calendar-plus
                                                    me-1
                                                "
                                            ></i>

                                            Registrar primer día

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if (
            method_exists($dias, 'hasPages') &&
            $dias->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $dias->links() }}

            </div>

        @endif

    </div>

</div>

@endsection