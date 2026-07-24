@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-people me-2"></i>

                Empleados RH

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra los expedientes del personal.

            </p>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('rh.empleados.inactivos') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-person-x me-1"></i>

                Empleados inactivos

            </a>


            <a
                href="{{ route('rh.empleados.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-person-plus me-1"></i>

                Nuevo empleado

            </a>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar empleado

        </div>


        <form method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-lg-5 col-md-7">

                    <label
                        for="buscar"
                        class="form-label text-light fw-semibold"
                    >

                        Número de control

                    </label>


                    <div class="input-group">

                        <span
                            class="input-group-text"
                            style="
                                background: #111827;
                                border-color: rgba(255, 255, 255, .12);
                                color: #D4AF37;
                            "
                        >

                            <i class="bi bi-search"></i>

                        </span>


                        <input
                            type="text"
                            name="buscar"
                            id="buscar"
                            class="form-control gtri-input"
                            value="{{ request('buscar') }}"
                            placeholder="Ejemplo: GTRI0002"
                        >

                    </div>

                </div>


                <div class="col-auto">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                </div>


                @if (request('buscar'))

                    <div class="col-auto">

                        <a
                            href="{{ route('rh.empleados') }}"
                            class="btn gtri-btn-secondary"
                        >

                            <i class="bi bi-x-circle me-1"></i>

                            Limpiar

                        </a>

                    </div>

                @endif

            </div>

        </form>

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

                <span>02</span>

                Lista de empleados

            </div>


            <div>

                <span class="text-secondary">

                    Registros mostrados:

                </span>

                <span class="text-warning fw-bold">

                    {{ $empleados->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">
                     <colgroup>

                        <col style="width: 16%;">

                        <col style="width: 32%;">

                        <col style="width: 20%;">

                        <col style="width: 12%;">

                        <col style="width: 20%;">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>No. de control</th>

                            <th>Empleado</th>

                            <th>Puesto</th>

                            <th>Estado</th>

                            <th class="text-center">Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($empleados as $empleado)

                            <tr>

                                {{-- NÚMERO DE CONTROL --}}
                                <td>

                                    <span class="text-warning fw-bold">

                                        {{ $empleado->numero_control }}

                                    </span>

                                </td>


                                {{-- EMPLEADO --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        @if ($empleado->foto)

                                            <img
                                                src="{{ asset(
                                                    'fotos_empleados/' .
                                                    $empleado->foto
                                                ) }}"
                                                alt="Foto del empleado"
                                                class="rounded-circle"
                                                style="
                                                    width: 46px;
                                                    height: 46px;
                                                    object-fit: cover;
                                                    border: 2px solid #D4AF37;
                                                "
                                            >

                                        @else

                                            <div
                                                class="
                                                    rounded-circle
                                                    d-flex
                                                    align-items-center
                                                    justify-content-center
                                                "
                                                style="
                                                    width: 46px;
                                                    height: 46px;
                                                    min-width: 46px;
                                                    background: #111827;
                                                    border: 2px solid #D4AF37;
                                                "
                                            >

                                                <i class="bi bi-person text-secondary"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <span class="text-light fw-semibold d-block">

                                                {{ $empleado->nombre }}

                                                {{ $empleado->apellido_paterno }}

                                                {{ $empleado->apellido_materno }}

                                            </span>

                                            <small class="text-secondary">

                                                {{ $empleado->correo }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- PUESTO --}}
                                <td>

                                    <span class="text-light">

                                        {{ $empleado->puesto }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if ($empleado->estado == 'activo')

                                        <span class="gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @else

                                        <span class="gtri-badge-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Inactivo

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td>

                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            justify-content-center
                                            gap-2
                                            flex-nowrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'rh.empleados.show',
                                                $empleado->id
                                            ) }}"
                                            class="btn gtri-btn-secondary btn-sm px-3"
                                        >

                                            <i class="bi bi-folder2-open me-1"></i>

                                            Ver

                                        </a>


                                        <a
                                            href="{{ route(
                                                'rh.empleados.edit',
                                                $empleado->id
                                            ) }}"
                                            class="btn gtri-btn-primary btn-sm px-3"
                                        >

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Editar

                                        </a>


                                        <a
                                            href="{{ route(
                                                'rh.bajas.create',
                                                $empleado->id
                                            ) }}"
                                            class="btn btn-danger btn-sm px-3"
                                        >

                                            <i class="bi bi-person-dash me-1"></i>

                                            Baja

                                        </a>

                                    </div>

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
                                            bi-people
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay empleados registrados

                                    </h5>

                                    <p class="text-secondary mb-3">

                                        No se encontraron empleados con los criterios indicados.

                                    </p>


                                    <a
                                        href="{{ route('rh.empleados.create') }}"
                                        class="btn gtri-btn-primary"
                                    >

                                        <i class="bi bi-person-plus me-1"></i>

                                        Registrar empleado

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if ($empleados->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $empleados->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection