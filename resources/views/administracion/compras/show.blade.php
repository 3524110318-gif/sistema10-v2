@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.compras.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle de la compra">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Folio

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $compra->folio }}"
                    readonly
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Proveedor

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $compra->proveedor->razon_social }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Fecha de compra

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $compra->fecha_compra->format('d/m/Y') }}"
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
                    value="{{ ucfirst($compra->estado) }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Registró

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $compra->usuario->name ?? 'Sin usuario' }}"
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
            >{{ $compra->observaciones }}</textarea>

        </div>

        <div class="text-end">

            <a
                href="{{ route('administracion.compras.index') }}"
                class="btn btn-secondary"
            >

                Regresar

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection
