@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.facturas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle de la factura">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Folio

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Cliente

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->cliente->razon_social }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Contrato

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->contrato->numero_contrato }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Fecha

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->fecha_factura->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Periodo inicio

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->periodo_inicio->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Periodo fin

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $factura->periodo_fin->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Estado

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ ucfirst($factura->estado) }}"
                    readonly
                >

            </div>

        </div>

        <hr>

        <h5>

            Servicios facturados

        </h5>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

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

                            <td>

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

                                $ {{ number_format($detalle->precio_unitario,2) }}

                            </td>

                            <td>

                                $ {{ number_format($detalle->subtotal,2) }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="row justify-content-end">

            <div class="col-md-4">

                <table class="table table-bordered">

                    <tr>

                        <th>

                            Subtotal

                        </th>

                        <td>

                            $ {{ number_format($factura->subtotal,2) }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            IVA

                        </th>

                        <td>

                            $ {{ number_format($factura->iva,2) }}

                        </td>

                    </tr>

                    <tr class="table-light">

                        <th>

                            Total

                        </th>

                        <th>

                            $ {{ number_format($factura->total,2) }}

                        </th>

                    </tr>

                </table>

            </div>

        </div>

        <div class="mt-3">

            <label class="form-label fw-bold">

                Observaciones

            </label>

            <textarea
                class="form-control"
                rows="4"
                readonly
            >{{ $factura->observaciones }}</textarea>

        </div>

    </x-rh.card-rh>

</div>

@endsection
