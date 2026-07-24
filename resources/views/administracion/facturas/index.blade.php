@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-receipt me-2"></i>

                    Facturación

                </h2>

                <p class="gtri-page-subtitle">

                    Administración y seguimiento de facturas por cliente y contrato.

                </p>

            </div>

            <a
                href="{{ route('administracion.facturas.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva factura

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

                        Folio o cliente

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por folio o cliente..."
                        value="{{ request('buscar') }}"
                    >

                </div>

                <div class="col-auto">

                    <button
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                </div>

                @if(request('buscar'))

                    <div class="col-auto">

                        <a
                            href="{{ route('administracion.facturas.index') }}"
                            class="btn gtri-btn-secondary"
                        >

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

            Listado de facturas

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Folio</th>

                            <th>Cliente</th>

                            <th>Contrato</th>

                            <th>Fecha</th>

                            <th>Total</th>

                            <th class="text-center">
                                Estado
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($facturas as $factura)

                            <tr>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $factura->folio }}

                                    </span>

                                </td>

                                <td class="text-light">

                                    {{ $factura->cliente->razon_social }}

                                </td>

                                <td class="text-secondary">

                                    {{ $factura->contrato->numero_contrato }}

                                </td>

                                <td class="text-secondary">

                                    {{ $factura->fecha_factura->format('d/m/Y') }}

                                </td>

                                <td class="fw-semibold text-light">

                                    ${{ number_format($factura->total, 2) }}

                                </td>

                                <td class="text-center">

                                    @switch($factura->estado)

                                        @case('borrador')

                                            <span class="badge gtri-badge-warning">
                                                Borrador
                                            </span>

                                            @break

                                        @case('emitida')

                                            <span class="badge gtri-badge-success">
                                                Emitida
                                            </span>

                                            @break

                                        @case('cancelada')

                                            <span class="badge gtri-badge-danger">
                                                Cancelada
                                            </span>

                                            @break

                                    @endswitch

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.facturas.show',
                                                $factura
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a
                                            href="{{ route(
                                                'administracion.facturas.edit',
                                                $factura
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar factura"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        @if($factura->estado != 'cancelada')

                                            <form
                                                action="{{ route(
                                                    'administracion.facturas.destroy',
                                                    $factura
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm(
                                                        '¿Cancelar esta factura?'
                                                    )"
                                                    title="Cancelar factura"
                                                >

                                                    <i class="bi bi-x-circle"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i class="bi bi-receipt fs-1 d-block mb-3"></i>

                                        No existen facturas registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($facturas->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $facturas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection