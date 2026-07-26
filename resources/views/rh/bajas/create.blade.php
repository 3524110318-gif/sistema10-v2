@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-dash me-2"></i>

                Baja de empleado

            </h2>

            <p class="gtri-page-subtitle">

                Registra la devolución de equipo y documentación del empleado.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.bajas.store',
            $empleado->id
        ) }}"
    >

        @csrf


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del empleado

            </div>


            <div
                class="
                    d-flex
                    flex-wrap
                    align-items-center
                    gap-3
                    p-4
                    rounded-3
                "
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                @if ($empleado->foto)

                    <img
                        src="{{ asset(
                            'fotos_empleados/' .
                            $empleado->foto
                        ) }}"
                        alt="Foto del empleado"
                        class="rounded-circle"
                        style="
                            width:70px;
                            height:70px;
                            object-fit:cover;
                            border:3px solid #D4AF37;
                        "
                    >

                @else

                    <div
                        class="
                            rounded-circle
                            d-flex
                            align-items-center
                            justify-content-center
                        "
                        style="
                            width:70px;
                            height:70px;
                            background:#1F2937;
                            border:3px solid #D4AF37;
                        "
                    >

                        <i class="bi bi-person fs-3 text-secondary"></i>

                    </div>

                @endif


                <div>

                    <h5 class="text-light mb-1">

                        {{ $empleado->nombre }}

                        {{ $empleado->apellido_paterno }}

                        {{ $empleado->apellido_materno }}

                    </h5>


                    <div class="text-secondary">

                        No. de control:

                        <span class="text-warning fw-bold">

                            {{ $empleado->numero_control }}

                        </span>

                    </div>


                    <div class="text-secondary">

                        Puesto:

                        <span class="text-light">

                            {{ $empleado->puesto }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Fecha de baja

            </div>


            <div class="row">

                <div class="col-md-6">

                    <label
                        for="fecha_baja"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de baja

                    </label>


                    <input
                        type="date"
                        name="fecha_baja"
                        id="fecha_baja"
                        class="form-control gtri-input"
                        value="{{ old('fecha_baja') }}"
                        required
                    >

                    @error('fecha_baja')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Checklist de devolución

            </div>


            <div class="row g-3">

                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="uniforme_devuelto"
                            value="1"
                            @checked(old('uniforme_devuelto'))
                        >

                        <span>

                            <i class="bi bi-person-standing-dress me-2"></i>

                            Uniforme devuelto

                        </span>

                    </label>

                </div>


                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="botas_devueltas"
                            value="1"
                            @checked(old('botas_devueltas'))
                        >

                        <span>

                            <i class="bi bi-box-seam me-2"></i>

                            Botas devueltas

                        </span>

                    </label>

                </div>


                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="credencial_devuelta"
                            value="1"
                            @checked(old('credencial_devuelta'))
                        >

                        <span>

                            <i class="bi bi-person-vcard me-2"></i>

                            Credencial devuelta

                        </span>

                    </label>

                </div>


                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="radio_devuelto"
                            value="1"
                            @checked(old('radio_devuelto'))
                        >

                        <span>

                            <i class="bi bi-broadcast me-2"></i>

                            Radio devuelto

                        </span>

                    </label>

                </div>


                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="carta_renuncia"
                            value="1"
                            @checked(old('carta_renuncia'))
                        >

                        <span>

                            <i class="bi bi-file-earmark-text me-2"></i>

                            Carta de renuncia recibida

                        </span>

                    </label>

                </div>


                <div class="col-md-6 col-xl-4">

                    <label class="gtri-check-card">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="finiquito_entregado"
                            value="1"
                            @checked(old('finiquito_entregado'))
                        >

                        <span>

                            <i class="bi bi-cash-coin me-2"></i>

                            Finiquito entregado

                        </span>

                    </label>

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Observaciones

            </div>


            <label
                for="observaciones"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Observaciones de la baja

            </label>


            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="5"
                placeholder="Escribe aquí cualquier información adicional..."
            >{{ old('observaciones') }}</textarea>

            @error('observaciones')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route(
                        'rh.empleados',
                        $empleado->id
                    ) }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirm(
                        '¿Seguro que deseas dar de baja a este empleado?'
                    )"
                >

                    <i class="bi bi-person-x me-1"></i>

                    Dar de baja

                </button>

            </div>

        </div>

    </form>

</div>

@endsection