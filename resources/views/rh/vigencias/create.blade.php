@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar-check me-2"></i>

                Registrar vigencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra la vigencia de un documento del empleado.

            </p>

        </div>

        <a
            href="{{ route('rh.empleados.show', $empleado->id) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.vigencias.store',
            $empleado->id
        ) }}"
    >

        @csrf


        {{-- INFORMACIÓN DEL EMPLEADO --}}
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


        {{-- DATOS DE LA VIGENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la vigencia

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="documento"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Documento

                    </label>


                    <select
                        name="documento"
                        id="documento"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un documento

                        </option>

                        <option
                            value="Carta de antecedentes"
                            @selected(
                                old('documento') ===
                                'Carta de antecedentes'
                            )
                        >

                            Carta de antecedentes

                        </option>

                        <option
                            value="Examen médico"
                            @selected(
                                old('documento') ===
                                'Examen médico'
                            )
                        >

                            Examen médico

                        </option>

                        <option
                            value="Cédula SSP"
                            @selected(
                                old('documento') ===
                                'Cédula SSP'
                            )
                        >

                            Cédula SSP

                        </option>

                        <option
                            value="Licencia"
                            @selected(
                                old('documento') ===
                                'Licencia'
                            )
                        >

                            Licencia

                        </option>

                        <option
                            value="Otro"
                            @selected(
                                old('documento') ===
                                'Otro'
                            )
                        >

                            Otro

                        </option>

                    </select>

                    @error('documento')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="fecha_vencimiento"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de vencimiento

                    </label>


                    <input
                        type="date"
                        name="fecha_vencimiento"
                        id="fecha_vencimiento"
                        class="form-control gtri-input"
                        value="{{ old('fecha_vencimiento') }}"
                        required
                    >

                    @error('fecha_vencimiento')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route(
                        'rh.empleados.show',
                        $empleado->id
                    ) }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-calendar2-check me-1"></i>

                    Registrar vigencia

                </button>

            </div>

        </div>

    </form>

</div>

@endsection