@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-box-seam me-2"></i>

                    Productos

                </h2>

                <p class="gtri-page-subtitle">

                    Administración y control general de productos.

                </p>

            </div>

            <a
                href="{{ route('administracion.productos.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nuevo producto

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

                            Total de productos

                        </small>

                        <h2 class="mt-2 mb-0 text-warning fw-bold">

                            {{ $totalProductos }}

                        </h2>

                    </div>

                    <div class="fs-1 text-warning">

                        <i class="bi bi-box-seam"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="gtri-card">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Stock crítico

                        </small>

                        <h2 class="mt-2 mb-0 text-danger fw-bold">

                            {{ $productosStockCritico }}

                        </h2>

                    </div>

                    <div class="fs-1 text-danger">

                        <i class="bi bi-exclamation-triangle"></i>

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

                        Nombre del producto

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar por nombre..."
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
                            href="{{ route('administracion.productos.index') }}"
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

            Listado de productos

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th class="text-nowrap">

                                Código

                            </th>

                            <th>

                                Producto

                            </th>

                            <th>

                                Categoría

                            </th>

                            <th class="text-center text-nowrap">

                                En bodega

                            </th>

                            <th class="text-center text-nowrap">

                                En uso

                            </th>

                            <th class="text-center">

                                Total

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

                        @forelse($productos as $producto)

                            <tr>

                                {{-- CÓDIGO --}}
                                <td class="text-nowrap">

                                    <span class="text-warning fw-semibold">

                                        {{ $producto->codigo }}

                                    </span>

                                </td>


                                {{-- PRODUCTO --}}
                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $producto->nombre }}

                                    </div>

                                    <small class="text-secondary">

                                        {{ ucfirst($producto->tipo_producto) }}

                                    </small>

                                </td>


                                {{-- CATEGORÍA --}}
                                <td>

                                    <span class="text-secondary">

                                        {{ $producto->categoria->nombre
                                            ?? 'Sin categoría' }}

                                    </span>

                                </td>


                                {{-- EN BODEGA --}}
                                <td class="text-center">

                                    @if($producto->tipo_producto === 'activo')

                                        <span class="fw-bold text-light">

                                            {{ $producto->activos_en_bodega ?? 0 }}

                                        </span>

                                    @else

                                        <span class="fw-bold text-light">

                                            {{ $producto->stock_actual }}

                                        </span>

                                    @endif

                                </td>


                                {{-- EN USO --}}
                                <td class="text-center">

                                    @if($producto->tipo_producto === 'activo')

                                        <span class="fw-bold text-info">

                                            {{ $producto->activos_en_uso ?? 0 }}

                                        </span>

                                    @else

                                        <span class="fw-bold text-info">

                                            {{ $producto->cantidad_en_uso ?? 0 }}

                                        </span>

                                    @endif

                                </td>


                                {{-- TOTAL --}}
                                <td class="text-center">

                                    @if($producto->tipo_producto === 'activo')

                                        <span class="fw-bold text-warning">

                                            {{
                                                ($producto->activos_en_bodega ?? 0)
                                                +
                                                ($producto->activos_en_uso ?? 0)
                                            }}

                                        </span>

                                    @else

                                        <span class="fw-bold text-warning">

                                            {{
                                                $producto->stock_actual
                                                +
                                                ($producto->cantidad_en_uso ?? 0)
                                            }}

                                        </span>

                                    @endif

                                </td>


                                {{-- ESTADO --}}
                                <td class="text-center">

                                    @if($producto->estado === 'activo')

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
                                <td class="text-center text-nowrap">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.productos.show',
                                                $producto
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <form
                                            action="{{ route(
                                                'administracion.productos.destroy',
                                                $producto
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm
                                                {{ $producto->estado === 'activo'
                                                    ? 'btn-outline-danger'
                                                    : 'btn-outline-success'
                                                }}"
                                                onclick="return confirm(
                                                    '¿Desea {{ $producto->estado === 'activo'
                                                        ? 'desactivar'
                                                        : 'activar'
                                                    }} este producto?'
                                                )"
                                                title="{{ $producto->estado === 'activo'
                                                    ? 'Desactivar'
                                                    : 'Activar'
                                                }}"
                                            >

                                                @if($producto->estado === 'activo')

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
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-box-seam fs-1 d-block mb-3"
                                        ></i>

                                        No hay productos registrados.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if($productos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $productos->links() }}

            </div>

        @endif

    </div>

</div>

@endsection