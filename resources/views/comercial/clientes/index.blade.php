@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-buildings me-2"></i>

                Clientes Comerciales

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra los clientes registrados en el área comercial.

            </p>

        </div>

        <a
            href="{{ route('comercial.clientes.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo Cliente

        </a>

    </div>


    <!-- 01 · BUSCADOR -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar clientes

        </div>

        <form
            method="GET"
            class="row g-3 align-items-end"
        >

            <div class="col-lg-8 col-md-7">

                <label
                    for="buscar"
                    class="form-label"
                >

                    Buscar

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-dark border-secondary text-warning">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        id="buscar"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por razón social, RFC o representante..."
                        value="{{ request('buscar') }}"
                    >

                </div>

            </div>

            <div class="col-lg-4 col-md-5">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary flex-grow-1"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                    @if(request('buscar'))

                        <a
                            href="{{ route('comercial.clientes.index') }}"
                            class="btn gtri-btn-secondary"
                            title="Limpiar búsqueda"
                        >

                            <i class="bi bi-x-lg"></i>

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    <!-- 02 · LISTADO -->

    <div class="gtri-section mb-0">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div class="gtri-section-title mb-0">

                <span>02</span>

                Listado de clientes

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $clientes->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Razón Social</th>

                            <th>RFC</th>

                            <th>Representante</th>

                            <th>Teléfono</th>

                            <th>Correo</th>

                            <th class="text-center">Estado</th>

                            <th width="140">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($clientes as $cliente)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $cliente->razon_social }}

                                    </div>

                                </td>

                                <td>

                                    {{ $cliente->rfc }}

                                </td>

                                <td>

                                    {{ $cliente->representante_legal }}

                                </td>

                                <td>

                                    <i class="bi bi-telephone me-1 text-secondary"></i>

                                    {{ $cliente->telefono }}

                                </td>

                                <td>

                                    <i class="bi bi-envelope me-1 text-secondary"></i>

                                    {{ $cliente->correo }}

                                </td>

                                <td class="text-center">

                                    @if($cliente->estatus == 'activo')

                                        <span class="badge bg-success">

                                            Activo

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Inactivo

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-2 flex-nowrap">

                                        <a
                                            href="{{ route('comercial.clientes.edit', $cliente) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Editar cliente"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form
                                            action="{{ route('comercial.clientes.destroy', $cliente) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar cliente"
                                                onclick="return confirm('¿Eliminar este cliente?')"
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
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-building-x fs-1 text-secondary d-block mb-3"></i>

                                    <h5 class="text-light mb-2">

                                        No existen clientes registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo cliente para comenzar su gestión comercial.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if(method_exists($clientes, 'hasPages') && $clientes->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $clientes->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection