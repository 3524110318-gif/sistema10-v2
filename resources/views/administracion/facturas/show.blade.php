@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-receipt me-2"></i>

                    Detalle de la factura

                </h2>

                <p class="gtri-page-subtitle">

                    Información general, servicios facturados y totales.

                </p>

            </div>

            <a
                href="{{ route('administracion.facturas.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- INFORMACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de la factura

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">
                    Folio
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">
                    Cliente
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->cliente->razon_social }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">
                    Contrato
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->contrato->numero_contrato }}"
                    readonly
                >

            </div>

            <div class="col-md-3">

                <label class="gtri-label mb-2">
                    Fecha
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->fecha_factura->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3">

                <label class="gtri-label mb-2">
                    Periodo inicio
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->periodo_inicio->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3">

                <label class="gtri-label mb-2">
                    Periodo fin
                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $factura->periodo_fin->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3">

                <label class="gtri-label mb-2">
                    Estado
                </label>

                <div class="pt-2">

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

                        @default

                            <span class="badge gtri-badge-danger">
                                Cancelada
                            </span>

                    @endswitch

                </div>

            </div>

        </div>

    </div>


    {{-- SERVICIOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Servicios facturados

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Servicio</th>

                            <th>Plazas contratadas</th>

                            <th>Plazas cubiertas</th>

                            <th>Vacantes</th>

                            <th>Precio unitario</th>

                            <th>Subtotal</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($factura->detalles as $detalle)

                            <tr>

                                <td class="text-light">

                                    {{ $detalle->servicio->nombre }}

                                </td>

                                <td>
                                    {{ $detalle->plazas_contratadas }}
                                </td>

                                <td>
                                    {{ $detalle->plazas_cubiertas }}
                                </td>

                                <td>

                                    {{ $detalle->plazas_contratadas - $detalle->plazas_cubiertas }}

                                </td>

                                <td>

                                    ${{ number_format(
                                        $detalle->precio_unitario,
                                        2
                                    ) }}

                                </td>

                                <td class="fw-semibold text-warning">

                                    ${{ number_format(
                                        $detalle->subtotal,
                                        2
                                    ) }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>


        {{-- TOTALES --}}
        <div class="row justify-content-end mt-4">

            <div class="col-md-4">

                <div class="gtri-card">

                    <div class="d-flex justify-content-between py-2">

                        <span class="text-secondary">
                            Subtotal
                        </span>

                        <strong>
                            ${{ number_format($factura->subtotal, 2) }}
                        </strong>

                    </div>

                    <div class="d-flex justify-content-between py-2">

                        <span class="text-secondary">
                            IVA
                        </span>

                        <strong>
                            ${{ number_format($factura->iva, 2) }}
                        </strong>

                    </div>

                    <hr class="border-secondary">

                    <div class="d-flex justify-content-between">

                        <span class="text-warning fw-bold">
                            Total
                        </span>

                        <strong class="text-warning fs-5">

                            ${{ number_format($factura->total, 2) }}

                        </strong>

                    </div>

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
        >{{ $factura->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>

</div>

@endsection