@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-arrow-return-left me-2"></i>

                Registrar devolución

            </h2>

            <p class="gtri-page-subtitle">

                Registra la devolución de un uniforme o artículo entregado al empleado.

            </p>

        </div>

        <a
            href="{{ route(
                'rh.empleados.show',
                $entregaUniforme->empleado_id
            ) }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    {{-- MENSAJES DE ERROR --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                Revisa la información capturada:

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row g-4">

        {{-- INFORMACIÓN DE LA ENTREGA --}}
        <div class="col-12 col-xl-5">

            <div class="gtri-card h-100">

                <div class="gtri-section">

                    <div class="gtri-section-header">

                        <span class="gtri-section-number">

                            01

                        </span>

                        <div>

                            <h5 class="gtri-section-title">

                                Información de la entrega

                            </h5>

                            <p class="gtri-section-subtitle">

                                Datos del empleado y del artículo entregado.

                            </p>

                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-12">

                            <small class="text-secondary d-block">

                                Empleado

                            </small>

                            <strong>

                                {{ $entregaUniforme->empleado->numero_control }}

                                -

                                {{ $entregaUniforme->empleado->nombre }}

                                {{ $entregaUniforme->empleado->apellido_paterno }}

                                {{ $entregaUniforme->empleado->apellido_materno }}

                            </strong>

                        </div>


                        <div class="col-12">

                            <small class="text-secondary d-block">

                                Producto

                            </small>

                            <strong>

                                {{ $entregaUniforme->producto->nombre }}

                            </strong>

                        </div>


                        <div class="col-6">

                            <small class="text-secondary d-block">

                                Fecha de entrega

                            </small>

                            <strong>

                                {{ $entregaUniforme->fecha_entrega->format('d/m/Y') }}

                            </strong>

                        </div>


                        <div class="col-6">

                            <small class="text-secondary d-block">

                                Cantidad entregada

                            </small>

                            <strong>

                                {{ $entregaUniforme->cantidad }}

                            </strong>

                        </div>


                        <div class="col-6">

                            <small class="text-secondary d-block">

                                Cantidad devuelta

                            </small>

                            <strong class="text-info">

                                {{ $cantidadDevuelta }}

                            </strong>

                        </div>


                        <div class="col-6">

                            <small class="text-secondary d-block">

                                Cantidad pendiente

                            </small>

                            <strong class="text-warning">

                                {{ $cantidadPendiente }}

                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FORMULARIO --}}
        <div class="col-12 col-xl-7">

            <div class="gtri-card">

                <form
                    method="POST"
                    action="{{ route(
                        'uniformes.devolucion.store',
                        $entregaUniforme
                    ) }}"
                >

                    @csrf

                    <div class="gtri-section">

                        <div class="gtri-section-header">

                            <span class="gtri-section-number">

                                02

                            </span>

                            <div>

                                <h5 class="gtri-section-title">

                                    Datos de la devolución

                                </h5>

                                <p class="gtri-section-subtitle">

                                    Indica la cantidad y el estado del artículo devuelto.

                                </p>

                            </div>

                        </div>


                        <div class="row g-3">

                            {{-- CANTIDAD --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="cantidad"
                                    class="form-label"
                                >

                                    Cantidad a devolver

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="number"
                                    name="cantidad"
                                    id="cantidad"
                                    class="form-control
                                        @error('cantidad')
                                            is-invalid
                                        @enderror"
                                    value="{{ old('cantidad', 1) }}"
                                    min="1"
                                    max="{{ $cantidadPendiente }}"
                                    required
                                >

                                <div class="form-text">

                                    Máximo disponible:

                                    {{ $cantidadPendiente }}

                                </div>

                                @error('cantidad')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                            {{-- FECHA --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="fecha_devolucion"
                                    class="form-label"
                                >

                                    Fecha de devolución

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="date"
                                    name="fecha_devolucion"
                                    id="fecha_devolucion"
                                    class="form-control
                                        @error('fecha_devolucion')
                                            is-invalid
                                        @enderror"
                                    value="{{ old(
                                        'fecha_devolucion',
                                        now()->format('Y-m-d')
                                    ) }}"
                                    max="{{ now()->format('Y-m-d') }}"
                                    required
                                >

                                @error('fecha_devolucion')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                            {{-- RESULTADO --}}
                            <div class="col-12">

                                <label class="form-label">

                                    Resultado de la revisión

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="row g-3">

                                    <div class="col-12 col-md-6">

                                        <label
                                            class="
                                                border
                                                rounded-3
                                                p-3
                                                d-flex
                                                gap-3
                                                align-items-start
                                                h-100
                                                w-100
                                            "
                                            for="resultado_reutilizable"
                                        >

                                            <input
                                                class="form-check-input mt-1"
                                                type="radio"
                                                name="resultado"
                                                id="resultado_reutilizable"
                                                value="reutilizable"
                                                @checked(
                                                    old('resultado')
                                                    ===
                                                    'reutilizable'
                                                )
                                                required
                                            >

                                            <span>

                                                <strong class="d-block text-success">

                                                    <i class="bi bi-arrow-repeat me-1"></i>

                                                    Reutilizable

                                                </strong>

                                                <small class="text-secondary">

                                                    El artículo está en buenas condiciones y regresará al inventario.

                                                </small>

                                            </span>

                                        </label>

                                    </div>


                                    <div class="col-12 col-md-6">

                                        <label
                                            class="
                                                border
                                                rounded-3
                                                p-3
                                                d-flex
                                                gap-3
                                                align-items-start
                                                h-100
                                                w-100
                                            "
                                            for="resultado_merma"
                                        >

                                            <input
                                                class="form-check-input mt-1"
                                                type="radio"
                                                name="resultado"
                                                id="resultado_merma"
                                                value="merma"
                                                @checked(
                                                    old('resultado')
                                                    ===
                                                    'merma'
                                                )
                                                required
                                            >

                                            <span>

                                                <strong class="d-block text-danger">

                                                    <i class="bi bi-trash3 me-1"></i>

                                                    Merma

                                                </strong>

                                                <small class="text-secondary">

                                                    El artículo está dañado y no regresará al inventario disponible.

                                                </small>

                                            </span>

                                        </label>

                                    </div>

                                </div>

                                @error('resultado')

                                    <div class="text-danger small mt-2">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>


                            {{-- OBSERVACIONES --}}
                            <div class="col-12">

                                <label
                                    for="observaciones"
                                    class="form-label"
                                >

                                    Observaciones

                                </label>

                                <textarea
                                    name="observaciones"
                                    id="observaciones"
                                    rows="4"
                                    maxlength="500"
                                    class="form-control
                                        @error('observaciones')
                                            is-invalid
                                        @enderror"
                                    placeholder="Describe las condiciones en que se recibe el artículo..."
                                >{{ old('observaciones') }}</textarea>

                                @error('observaciones')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- ACCIONES --}}
                    <div
                        class="
                            d-flex
                            justify-content-end
                            gap-2
                            mt-4
                        "
                    >

                        <a
                            href="{{ route(
                                'rh.empleados.show',
                                $entregaUniforme->empleado_id
                            ) }}"
                            class="btn btn-outline-secondary"
                        >

                            Cancelar

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                            onclick="
                                return confirm(
                                    '¿Confirmas el registro de esta devolución?'
                                );
                            "
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Registrar devolución

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection