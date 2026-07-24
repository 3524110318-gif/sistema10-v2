@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- MENSAJES --}}
    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle me-1"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-building me-2"></i>

                Servicios

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra los servicios operativos registrados.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.servicios.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo servicio

        </a>

    </div>


    {{-- BUSCADOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar servicios

        </div>

        <form
            method="GET"
            action="{{ route(
                'operaciones.servicios.index'
            ) }}"
        >

            <div class="row g-3 align-items-end">

                <div class="col-lg-7">

                    <label
                        for="buscar"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Buscar

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        id="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar servicio, cliente, contrato o municipio..."
                        value="{{ $buscar }}"
                    >

                </div>

                <div class="col-lg-2 col-md-6">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary w-100"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                </div>

                <div class="col-lg-2 col-md-6">

                    <a
                        href="{{ route(
                            'operaciones.servicios.index'
                        ) }}"
                        class="btn gtri-btn-secondary w-100"
                    >

                        <i class="bi bi-arrow-counterclockwise me-1"></i>

                        Limpiar

                    </a>

                </div>

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

                Lista de servicios

            </div>

            <div>

                <span class="text-secondary">

                    Registros en esta página:

                </span>

                <span class="text-warning fw-bold">

                    {{ $servicios->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Cliente</th>

                            <th>Contrato</th>

                            <th>Servicio</th>

                            <th>Municipio</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($servicios as $servicio)

                            <tr>

                                {{-- CLIENTE --}}
                                <td>

                                    <span class="text-light fw-semibold">

                                        {{
                                            $servicio
                                                ->contrato
                                                ->cliente
                                                ->razon_social
                                        }}

                                    </span>

                                </td>


                                {{-- CONTRATO --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{
                                            $servicio
                                                ->contrato
                                                ->numero_contrato
                                        }}

                                    </span>

                                </td>


                                {{-- SERVICIO --}}
                                <td>

                                    <span class="text-light">

                                        {{ $servicio->nombre }}

                                    </span>

                                </td>


                                {{-- MUNICIPIO --}}
                                <td>

                                    <span class="text-light">

                                        {{
                                            $servicio->municipio
                                            ?: 'No registrado'
                                        }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($servicio->estado === 'activo')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @elseif($servicio->estado === 'suspendido')

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-pause-circle me-1"></i>

                                            Suspendido

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Finalizado

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <div
                                        class="
                                            d-flex
                                            justify-content-center
                                            align-items-center
                                            gap-2
                                            flex-nowrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'operaciones.servicios.show',
                                                $servicio
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver servicio"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <form
                                            action="{{ route(
                                                'operaciones.servicios.destroy',
                                                $servicio
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                '¿Desea eliminar este servicio?'
                                            )"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar servicio"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

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
                                            bi-building-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No existen servicios registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo servicio para comenzar.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if($servicios->hasPages())

            <div
                class="
                    d-flex
                    justify-content-center
                    mt-4
                "
            >

                {{ $servicios->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection