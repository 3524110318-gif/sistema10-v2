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

            <i class="bi bi-exclamation-circle me-1"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-buildings me-2"></i>

                Clientes

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra los clientes registrados en Operaciones.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.clientes.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo cliente

        </a>

    </div>


    {{-- BUSCADOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar clientes

        </div>


        <form
            method="GET"
            action="{{ route(
                'operaciones.clientes.index'
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
                        placeholder="Buscar por razón social, RFC o representante..."
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
                            'operaciones.clientes.index'
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

                Lista de clientes

            </div>


            <div>

                <span class="text-secondary">

                    Registros en esta página:

                </span>

                <span class="text-warning fw-bold">

                    {{ $clientes->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:28%">

                        <col style="width:18%">

                        <col style="width:24%">

                        <col style="width:12%">

                        <col style="width:18%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>Razón social</th>

                            <th>RFC</th>

                            <th>Representante</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse(
                            $clientes
                            as $cliente
                        )

                            <tr>

                                {{-- RAZÓN SOCIAL --}}
                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $cliente->razon_social }}

                                        </span>

                                        @if($cliente->correo)

                                            <small class="text-secondary">

                                                {{ $cliente->correo }}

                                            </small>

                                        @endif

                                    </div>

                                </td>


                                {{-- RFC --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $cliente->rfc }}

                                    </span>

                                </td>


                                {{-- REPRESENTANTE --}}
                                <td>

                                    <span class="text-light">

                                        {{
                                            $cliente->representante
                                            ?: 'No registrado'
                                        }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if(
                                        $cliente->estado
                                        ===
                                        'activo'
                                    )

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Inactivo

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
                                                'operaciones.clientes.show',
                                                $cliente
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver cliente"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'operaciones.clientes.destroy',
                                                $cliente
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                '¿Desea eliminar este cliente?'
                                            )"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar cliente"
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
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-buildings
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No existen clientes registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo cliente para comenzar.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if($clientes->hasPages())

            <div
                class="
                    d-flex
                    justify-content-center
                    mt-4
                "
            >

                {{ $clientes->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection