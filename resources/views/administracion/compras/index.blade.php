@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-cart-check me-2"></i>

                    Compras

                </h2>

                <p class="gtri-page-subtitle">

                    Gestión y seguimiento de las compras realizadas a proveedores.

                </p>

            </div>

            <a
                href="{{ route('administracion.compras.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva compra

            </a>

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

                        Folio de compra

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar por folio..."
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
                            href="{{ route('administracion.compras.index') }}"
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

            Listado de compras

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Folio</th>

                            <th>Proveedor</th>

                            <th>Fecha</th>

                            <th class="text-center">
                                Estado
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($compras as $compra)

                            <tr>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $compra->folio }}

                                    </span>

                                </td>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $compra->proveedor->razon_social }}

                                    </div>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $compra->fecha_compra->format('d/m/Y') }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    @if($compra->estado == 'pendiente')

                                        <span class="badge gtri-badge-warning">

                                            <i class="bi bi-clock me-1"></i>

                                            Pendiente

                                        </span>

                                    @elseif($compra->estado == 'recibida')

                                        <span class="badge gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Recibida

                                        </span>

                                    @else

                                        <span class="badge gtri-badge-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Cancelada

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.compras.show',
                                                $compra
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a
                                            href="{{ route(
                                                'administracion.compras.edit',
                                                $compra
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar compra"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        @if($compra->estado != 'cancelada')

                                            <form
                                                action="{{ route(
                                                    'administracion.compras.destroy',
                                                    $compra
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm(
                                                        '¿Desea cancelar esta compra?'
                                                    )"
                                                    title="Cancelar compra"
                                                >

                                                    <i class="bi bi-x-lg"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-cart-x fs-1 d-block mb-3"
                                        ></i>

                                        No hay compras registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($compras->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $compras->links() }}

            </div>

        @endif

    </div>

</div>

@endsection