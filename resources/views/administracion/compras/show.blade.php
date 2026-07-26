@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-receipt me-2"></i>

                    Detalle de la compra

                </h2>

                <p class="gtri-page-subtitle">

                    Información general de la compra seleccionada.

                </p>

            </div>

            <a
                href="{{ route('administracion.compras.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- IDENTIFICACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de la compra

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Folio

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Proveedor

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->proveedor->razon_social }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Fecha de compra

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->fecha_compra->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Estado

                </label>

                <div class="pt-2">

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

                </div>

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Registró

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $compra->usuario->name ?? 'Sin usuario' }}"
                    readonly
                >

            </div>

        </div>

    </div>

    {{-- PRODUCTOS DE LA COMPRA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Productos de la compra

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Producto</th>

                            <th class="text-center">
                                Cantidad
                            </th>

                            <th class="text-end">
                                Precio unitario
                            </th>

                            <th class="text-end">
                                Subtotal
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($compra->detalles as $detalle)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $detalle->producto->codigo }}

                                        -

                                        {{ $detalle->producto->nombre }}

                                    </div>

                                </td>

                                <td class="text-center">

                                    {{ $detalle->cantidad }}

                                </td>

                                <td class="text-end">

                                    ${{ number_format(
                                        $detalle->precio_unitario,
                                        2
                                    ) }}

                                </td>

                                <td class="text-end fw-semibold text-warning">

                                    ${{ number_format(
                                        $detalle->subtotal,
                                        2
                                    ) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-4 text-secondary"
                                >

                                    No hay productos registrados en esta compra.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="row justify-content-end mt-4">

            <div class="col-md-5">

                <div class="d-flex justify-content-between mb-2">

                    <span class="text-secondary">

                        Subtotal

                    </span>

                    <strong class="text-light">

                        ${{ number_format(
                            $compra->subtotal,
                            2
                        ) }}

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-2">

                    <span class="text-secondary">

                        IVA

                    </span>

                    <strong class="text-light">

                        ${{ number_format(
                            $compra->iva,
                            2
                        ) }}

                    </strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <span class="fw-bold text-warning">

                        Total

                    </span>

                    <strong class="text-warning fs-5">

                        ${{ number_format(
                            $compra->total,
                            2
                        ) }}

                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Observaciones

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $compra->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>


    <div class="d-flex justify-content-end">

        <a
            href="{{ route('administracion.compras.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>

</div>

@endsection