@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-tags me-2"></i>

                    Categorías

                </h2>

                <p class="gtri-page-subtitle">

                    Administración de categorías para la clasificación de productos.

                </p>

            </div>


            <a
                href="{{ route('administracion.categorias.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva categoría

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

                            Total de categorías

                        </small>

                        <h2 class="mt-2 mb-0 text-warning fw-bold">

                            {{ $totalCategorias }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-tags"></i>

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

                        Nombre de la categoría

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar categoría..."
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
                            href="{{ route('administracion.categorias.index') }}"
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

            Listado de categorías

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Descripción
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

                        @forelse($categorias as $categoria)

                            <tr>

                                {{-- NOMBRE --}}
                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $categoria->nombre }}

                                    </div>

                                </td>


                                {{-- DESCRIPCIÓN --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $categoria->descripcion ?: 'Sin descripción' }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td class="text-center">

                                    @if($categoria->estado == 'activo')

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
                                                'administracion.categorias.edit',
                                                $categoria
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar categoría"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'administracion.categorias.destroy',
                                                $categoria
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm
                                                {{ $categoria->estado == 'activo'
                                                    ? 'btn-outline-danger'
                                                    : 'btn-outline-success'
                                                }}"
                                                onclick="return confirm(
                                                    '¿Desea {{ $categoria->estado == 'activo'
                                                        ? 'desactivar'
                                                        : 'activar'
                                                    }} esta categoría?'
                                                )"
                                                title="{{ $categoria->estado == 'activo'
                                                    ? 'Desactivar'
                                                    : 'Activar'
                                                }}"
                                            >

                                                @if($categoria->estado == 'activo')

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
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-tags fs-1 d-block mb-3"
                                        ></i>

                                        No hay categorías registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if($categorias->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $categorias->links() }}

            </div>

        @endif

    </div>

</div>

@endsection