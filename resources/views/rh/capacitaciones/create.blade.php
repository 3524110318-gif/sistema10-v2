@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-mortarboard me-2"></i>

                Registrar capacitación

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva capacitación para el empleado.

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
            'rh.capacitaciones.store',
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


        {{-- DATOS DE LA CAPACITACIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la capacitación

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="curso"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Curso

                    </label>


                    <select
                        name="curso"
                        id="curso"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un curso

                        </option>

                        <option
                            value="Primeros Auxilios"
                            @selected(
                                old('curso') ===
                                'Primeros Auxilios'
                            )
                        >

                            Primeros Auxilios

                        </option>

                        <option
                            value="Uso de Extintores"
                            @selected(
                                old('curso') ===
                                'Uso de Extintores'
                            )
                        >

                            Uso de Extintores

                        </option>

                        <option
                            value="Seguridad Privada"
                            @selected(
                                old('curso') ===
                                'Seguridad Privada'
                            )
                        >

                            Seguridad Privada

                        </option>

                        <option
                            value="Manejo Defensivo"
                            @selected(
                                old('curso') ===
                                'Manejo Defensivo'
                            )
                        >

                            Manejo Defensivo

                        </option>

                        <option
                            value="Protección Civil"
                            @selected(
                                old('curso') ===
                                'Protección Civil'
                            )
                        >

                            Protección Civil

                        </option>

                    </select>

                    @error('curso')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="fecha_capacitacion"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de capacitación

                    </label>


                    <input
                        type="date"
                        name="fecha_capacitacion"
                        id="fecha_capacitacion"
                        class="form-control gtri-input"
                        value="{{ old('fecha_capacitacion') }}"
                        required
                    >

                    @error('fecha_capacitacion')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="calificacion"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Calificación

                    </label>


                    <input
                        type="number"
                        name="calificacion"
                        id="calificacion"
                        class="form-control gtri-input"
                        min="0"
                        max="100"
                        step="1"
                        value="{{ old('calificacion') }}"
                        placeholder="Ejemplo: 95"
                    >

                    <small class="text-secondary">

                        Ingresa una calificación de 0 a 100.

                    </small>

                    @error('calificacion')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="vigencia_hasta"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Vigencia hasta

                    </label>


                    <input
                        type="date"
                        name="vigencia_hasta"
                        id="vigencia_hasta"
                        class="form-control gtri-input"
                        value="{{ old('vigencia_hasta') }}"
                    >

                    @error('vigencia_hasta')

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

                    <i class="bi bi-mortarboard me-1"></i>

                    Registrar capacitación

                </button>

            </div>

        </div>

    </form>

</div>

@endsection