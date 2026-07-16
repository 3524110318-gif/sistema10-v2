@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.cobranzas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle de la cobranza">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Factura

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $cobranza->factura->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Cliente

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $cobranza->factura->cliente->razon_social }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Fecha de vencimiento

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $cobranza->fecha_vencimiento->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Fecha de pago

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $cobranza->fecha_pago ? $cobranza->fecha_pago->format('d/m/Y') : 'Sin registrar' }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Estado

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ ucfirst($cobranza->estado) }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Monto

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="$ {{ number_format($cobranza->monto,2) }}"
                    readonly
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Referencia de pago

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $cobranza->referencia_pago ?? 'Sin referencia' }}"
                    readonly
                >

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">

                Observaciones

            </label>

            <textarea
                class="form-control"
                rows="4"
                readonly
            >{{ $cobranza->observaciones }}</textarea>

        </div>

        <div class="text-end">

            <a
                href="{{ route('administracion.cobranzas.edit',$cobranza) }}"
                class="btn btn-warning"
            >

                <i class="bi bi-pencil"></i>

                Editar

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection
