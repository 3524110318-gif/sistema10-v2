@php

    $esEdicion = isset($capacitacion);

@endphp


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

                    {{ $empleado->puesto ?? 'Sin puesto registrado' }}

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

        {{-- CURSO --}}
        <div class="col-12 col-md-6">

            <label
                for="curso"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Curso

                <span class="text-danger">*</span>

            </label>


            <select
                name="curso"
                id="curso"
                class="form-select gtri-input @error('curso') is-invalid @enderror"
                required
            >

                <option value="">

                    Selecciona un curso

                </option>


                <option
                    value="Primeros Auxilios"
                    @selected(
                        old(
                            'curso',
                            $capacitacion->curso ?? ''
                        ) === 'Primeros Auxilios'
                    )
                >

                    Primeros Auxilios

                </option>


                <option
                    value="Uso de Extintores"
                    @selected(
                        old(
                            'curso',
                            $capacitacion->curso ?? ''
                        ) === 'Uso de Extintores'
                    )
                >

                    Uso de Extintores

                </option>


                <option
                    value="Seguridad Privada"
                    @selected(
                        old(
                            'curso',
                            $capacitacion->curso ?? ''
                        ) === 'Seguridad Privada'
                    )
                >

                    Seguridad Privada

                </option>


                <option
                    value="Manejo Defensivo"
                    @selected(
                        old(
                            'curso',
                            $capacitacion->curso ?? ''
                        ) === 'Manejo Defensivo'
                    )
                >

                    Manejo Defensivo

                </option>


                <option
                    value="Protección Civil"
                    @selected(
                        old(
                            'curso',
                            $capacitacion->curso ?? ''
                        ) === 'Protección Civil'
                    )
                >

                    Protección Civil

                </option>

            </select>


            @error('curso')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- FECHA DE CAPACITACIÓN --}}
        <div class="col-12 col-md-6">

            <label
                for="fecha_capacitacion"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Fecha de capacitación

                <span class="text-danger">*</span>

            </label>


            <input
                type="date"
                name="fecha_capacitacion"
                id="fecha_capacitacion"
                class="form-control gtri-input @error('fecha_capacitacion') is-invalid @enderror"
                value="{{ old(
                    'fecha_capacitacion',
                    isset($capacitacion)
                        ? \Carbon\Carbon::parse(
                            $capacitacion->fecha_capacitacion
                        )->format('Y-m-d')
                        : ''
                ) }}"
                max="{{ now()->format('Y-m-d') }}"
                required
            >


            @error('fecha_capacitacion')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- CALIFICACIÓN --}}
        <div class="col-12 col-md-6">

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
                class="form-control gtri-input @error('calificacion') is-invalid @enderror"
                min="0"
                max="100"
                step="1"
                value="{{ old(
                    'calificacion',
                    $capacitacion->calificacion ?? ''
                ) }}"
                placeholder="Ejemplo: 95"
            >


            <small class="text-secondary">

                Ingresa una calificación de 0 a 100.

            </small>


            @error('calificacion')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- VIGENCIA --}}
        <div class="col-12 col-md-6">

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
                class="form-control gtri-input @error('vigencia_hasta') is-invalid @enderror"
                value="{{ old(
                    'vigencia_hasta',
                    isset($capacitacion) &&
                    $capacitacion->vigencia_hasta
                        ? \Carbon\Carbon::parse(
                            $capacitacion->vigencia_hasta
                        )->format('Y-m-d')
                        : ''
                ) }}"
            >


            <small class="text-secondary">

                Déjalo vacío si la capacitación no tiene vigencia.

            </small>


            @error('vigencia_hasta')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>


{{-- ARCHIVOS --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Evidencias y constancias

    </div>


    <div class="row g-3">

        {{-- EVIDENCIA --}}
        <div class="col-12 col-md-6">

            <label
                for="evidencia"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Evidencia

            </label>


            <input
                type="file"
                name="evidencia"
                id="evidencia"
                class="form-control gtri-input @error('evidencia') is-invalid @enderror"
                accept=".pdf,.jpg,.jpeg,.png"
            >


            <small class="text-secondary d-block mt-1">

                PDF, JPG, JPEG o PNG. Máximo 5 MB.

            </small>


            @if (
                $esEdicion &&
                $capacitacion->evidencia
            )

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        flex-wrap
                        gap-2
                        mt-3
                        p-3
                        rounded-3
                    "
                    style="
                        background:#111827;
                        border:1px solid rgba(255,255,255,.08);
                    "
                >

                    <div>

                        <small class="text-secondary d-block">

                            Evidencia actual

                        </small>

                        <span class="text-light">

                            <i class="bi bi-file-earmark-check me-1 text-success"></i>

                            Archivo registrado

                        </span>

                    </div>


                    <a
                        href="{{ asset(
                            'storage/' .
                            $capacitacion->evidencia
                        ) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn gtri-btn-secondary btn-sm"
                    >

                        <i class="bi bi-eye me-1"></i>

                        Ver archivo

                    </a>

                </div>


                <small class="text-warning d-block mt-2">

                    Si seleccionas otro archivo, reemplazará la evidencia actual.

                </small>

            @endif


            @error('evidencia')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- DC3 --}}
        <div class="col-12 col-md-6">

            <label
                for="dc3"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Constancia DC3

            </label>


            <input
                type="file"
                name="dc3"
                id="dc3"
                class="form-control gtri-input @error('dc3') is-invalid @enderror"
                accept=".pdf"
            >


            <small class="text-secondary d-block mt-1">

                Únicamente archivo PDF. Máximo 5 MB.

            </small>


            @if (
                $esEdicion &&
                $capacitacion->dc3
            )

                <div
                    class="
                        d-flex
                        align-items-center
                        justify-content-between
                        flex-wrap
                        gap-2
                        mt-3
                        p-3
                        rounded-3
                    "
                    style="
                        background:#111827;
                        border:1px solid rgba(255,255,255,.08);
                    "
                >

                    <div>

                        <small class="text-secondary d-block">

                            Constancia actual

                        </small>

                        <span class="text-light">

                            <i class="bi bi-award me-1 text-warning"></i>

                            DC3 registrado

                        </span>

                    </div>


                    <a
                        href="{{ asset(
                            'storage/' .
                            $capacitacion->dc3
                        ) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn gtri-btn-secondary btn-sm"
                    >

                        <i class="bi bi-eye me-1"></i>

                        Ver DC3

                    </a>

                </div>


                <small class="text-warning d-block mt-2">

                    Si seleccionas otro archivo, reemplazará el DC3 actual.

                </small>

            @endif


            @error('dc3')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>

</div>


{{-- ACCIONES --}}
<div class="gtri-section mb-0">

    <div
        class="
            d-flex
            flex-wrap
            justify-content-end
            gap-2
        "
    >

        <a
            href="{{ route('rh.capacitaciones.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-circle me-1"></i>

            Cancelar

        </a>


        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            @if ($esEdicion)

                <i class="bi bi-floppy me-1"></i>

                Guardar cambios

            @else

                <i class="bi bi-mortarboard me-1"></i>

                Registrar capacitación

            @endif

        </button>

    </div>

</div>