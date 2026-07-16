@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.activos.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle del activo">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Código del activo

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->codigo_activo }}"
                    readonly
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Producto

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->producto->nombre }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Número de serie

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->numero_serie }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Marca

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->marca }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Modelo

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->modelo }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Fecha de adquisición

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $activo->fecha_adquisicion ? $activo->fecha_adquisicion->format('d/m/Y') : '' }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Valor

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="${{ number_format($activo->valor,2) }}"
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
                    value="{{ ucfirst($activo->estado) }}"
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
            >{{ $activo->observaciones }}</textarea>

        </div>

        <div class="text-end">

            <a
                href="{{ route('administracion.activos.index') }}"
                class="btn btn-secondary"
            >

                Regresar

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection
