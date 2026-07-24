@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-truck me-2"></i>

                    Proveedores

                </h2>

                <p class="gtri-page-subtitle">

                    Administración y control de proveedores registrados.

                </p>

            </div>


            <a
                href="{{ route('administracion.proveedores.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nuevo proveedor

            </a>

        </div>

    </div>


    {{-- RESUMEN --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div class="gtri-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Total de proveedores

                        </small>

                        <h2 class="mt-2 mb-0 text-warning fw-bold">

                            {{ $totalProveedores }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-truck"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Filtros de búsqueda

        </div>


        <form method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label class="gtri-label mb-2">

                        Razón social

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar proveedor..."
                    >

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


                @if(request('buscar'))

                    <div class="col-auto">

                        <a
                            href="{{ route('administracion.proveedores.index') }}"
                            class="btn gtri-btn-secondary"
                        >

                            <i class="bi bi-arrow-clockwise me-1"></i>

                            Limpiar

                        </a>

                    </div>

                @endif

            </div>

        </form>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Listado de proveedores

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>
                                Razón Social
                            </th>

                            <th>
                                RFC
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Teléfono
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

                        @forelse($proveedores as $proveedor)

                            <tr>

                                {{-- RAZÓN SOCIAL --}}
                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $proveedor->razon_social }}

                                    </div>

                                </td>


                                {{-- RFC --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $proveedor->rfc }}

                                    </span>

                                </td>


                                {{-- CONTACTO --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $proveedor->nombre_contacto ?: 'Sin contacto' }}

                                    </span>

                                </td>


                                {{-- TELÉFONO --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $proveedor->telefono ?: 'Sin teléfono' }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td class="text-center">

                                    @if($proveedor->estado == 'activo')

                                        <span class="badge gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activo

                                        </span>

                                    @else

                                        <span class="badge gtri-badge-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Inactivo

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.proveedores.edit',
                                                $proveedor
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar proveedor"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'administracion.proveedores.destroy',
                                                $proveedor
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm
                                                {{ $proveedor->estado == 'activo'
                                                    ? 'btn-outline-danger'
                                                    : 'btn-outline-success'
                                                }}"
                                                onclick="return confirm(
                                                    '¿Desea {{ $proveedor->estado == 'activo'
                                                        ? 'desactivar'
                                                        : 'activar'
                                                    }} este proveedor?'
                                                )"
                                                title="{{ $proveedor->estado == 'activo'
                                                    ? 'Desactivar'
                                                    : 'Activar'
                                                }}"
                                            >

                                                @if($proveedor->estado == 'activo')

                                                    <i class="bi bi-power"></i>

                                                @else

                                                    <i class="bi bi-check-lg"></i>

                                                @endif

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

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-truck fs-1 d-block mb-3"
                                        ></i>

                                        No hay proveedores registrados.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if($proveedores->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $proveedores->links() }}

            </div>

        @endif

    </div>

</div>

@endsection