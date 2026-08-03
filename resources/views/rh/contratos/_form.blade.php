@php

    $renovando = $renovando ?? false;

@endphp


{{-- INFORMACIÓN DEL EMPLEADO --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>01</span>

        Empleado

    </div>


    @if ($renovando)

        <div class="gtri-expediente-field">

            <small class="gtri-expediente-field-label">

                Empleado seleccionado

            </small>

            <span class="gtri-expediente-field-value">

                {{ $contrato->empleado->numero_control }}

                -

                {{ $contrato->empleado->nombre }}

                {{ $contrato->empleado->apellido_paterno }}

                {{ $contrato->empleado->apellido_materno }}

            </span>

        </div>

    @else

        <div class="row g-3">

            <div class="col-12">

                <label
                    for="empleado_id"
                    class="form-label text-light fw-semibold"
                >

                    Empleado

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="empleado_id"
                    id="empleado_id"
                    class="
                        form-select
                        gtri-input
                        @error('empleado_id')
                            is-invalid
                        @enderror
                    "
                    required
                >

                    <option value="">

                        Selecciona un empleado

                    </option>

                    @foreach ($empleados as $empleado)

                        <option
                            value="{{ $empleado->id }}"
                            @selected(
                                old('empleado_id')
                                ==
                                $empleado->id
                            )
                        >

                            {{ $empleado->numero_control }}

                            -

                            {{ $empleado->nombre }}

                            {{ $empleado->apellido_paterno }}

                            {{ $empleado->apellido_materno }}

                        </option>

                    @endforeach

                </select>


                @error('empleado_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

    @endif

</div>


{{-- DATOS Y FECHAS DEL CONTRATO --}}
<div class="row g-3">

    {{-- INFORMACIÓN DEL CONTRATO --}}
    <div class="col-12 col-xl-6">

        <div class="gtri-section h-100">

            <div class="gtri-section-title">

                <span>02</span>

                Información del contrato

            </div>


            <div class="row g-3">

                <div class="col-12">

                    <x-rh.input-rh
                        label="Número de contrato"
                        name="numero_contrato"
                        type="text"
                        placeholder="Ej. GTRI-RH-2026-001"
                        :value="old('numero_contrato')"
                    />

                </div>


                <div class="col-12">

                    <label
                        for="tipo_contrato"
                        class="form-label text-light fw-semibold"
                    >

                        Tipo de contrato

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="tipo_contrato"
                        id="tipo_contrato"
                        class="
                            form-select
                            gtri-input
                            @error('tipo_contrato')
                                is-invalid
                            @enderror
                        "
                        required
                    >

                        <option value="">

                            Selecciona el tipo de contrato

                        </option>

                        <option
                            value="indeterminado"
                            @selected(
                                old('tipo_contrato')
                                ===
                                'indeterminado'
                            )
                        >

                            Tiempo indeterminado

                        </option>

                        <option
                            value="determinado"
                            @selected(
                                old('tipo_contrato')
                                ===
                                'determinado'
                            )
                        >

                            Tiempo determinado

                        </option>

                        <option
                            value="eventual"
                            @selected(
                                old('tipo_contrato')
                                ===
                                'eventual'
                            )
                        >

                            Eventual

                        </option>

                        <option
                            value="prueba"
                            @selected(
                                old('tipo_contrato')
                                ===
                                'prueba'
                            )
                        >

                            Periodo de prueba

                        </option>

                    </select>


                    @error('tipo_contrato')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- FECHAS DEL CONTRATO --}}
    <div class="col-12 col-xl-6">

        <div class="gtri-section h-100">

            <div class="gtri-section-title">

                <span>03</span>

                Fechas del contrato

            </div>


            <div class="row g-3">

                <div class="col-12 col-md-6 col-xl-12 col-xxl-6">

                    <x-rh.input-rh
                        label="Fecha de inicio"
                        name="fecha_inicio"
                        type="date"
                        :value="old('fecha_inicio')"
                    />

                </div>


                <div class="col-12 col-md-6 col-xl-12 col-xxl-6">

                    <x-rh.input-rh
                        label="Fecha de término"
                        name="fecha_fin"
                        type="date"
                        :value="old('fecha_fin')"
                    />

                    <small class="text-secondary">

                        Déjala vacía cuando el contrato sea por tiempo indeterminado.

                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- FIRMA Y OBSERVACIONES --}}
<div class="row g-3 mt-0">

    {{-- FIRMA DEL CONTRATO --}}
    <div class="col-12 col-xl-6">

        <div class="gtri-section ">

            <div class="gtri-section-title">

                <span>04</span>

                Firma del contrato

            </div>

            <div class="gtri-expediente-field">

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        gap-3
                    "
                >

                    <div>

                        <div
                            class="
                                fw-bold
                                text-light
                                mb-1
                            "
                        >

                            Estado del contrato

                        </div>

                        <small
                            id="estadoFirmaTexto"
                            class="text-secondary"
                        >

                            Pendiente de firma física.

                        </small>

                    </div>


                    <div class="form-check form-switch m-0">

                        <input
                            type="hidden"
                            name="firmado"
                            value="0"
                        >

                        <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            name="firmado"
                            id="firmado"
                            value="1"
                            @checked(old('firmado'))
                        >

                    </div>

                </div>

            </div>


            <div class="row g-3 mt-1">

                <div class="col-12">

                    <x-rh.input-rh
                        label="Fecha de firma"
                        name="fecha_firma"
                        type="date"
                        :value="old('fecha_firma')"
                    />

                </div>

            </div>


            <div class="mt-3">

                <small class="text-secondary">

                    La fecha se habilita solamente cuando el contrato físico está firmado.

                </small>

            </div>

        </div>

    </div>


    {{-- OBSERVACIONES --}}
    <div class="col-12 col-xl-6">

        <div class="gtri-section ">

            <div class="gtri-section-title">

                <span>05</span>

                Observaciones

            </div>

                <x-rh.textarea-rh
                    label="Observaciones del contrato"
                    name="observaciones"
                    placeholder="Escribe información adicional relacionada con el contrato."
                >{{ old('observaciones') }}</x-rh.textarea-rh>

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
            align-items-center
            gap-2
        "
    >

        <a
            href="{{
                $renovando
                    ? route(
                        'rh.contratos.show',
                        $contrato->id
                    )
                    : route('rh.contratos.index')
            }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-circle me-1"></i>

            Cancelar

        </a>


        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-floppy me-1"></i>

            {{ $renovando
                ? 'Guardar renovación'
                : 'Guardar contrato'
            }}

        </button>

    </div>

</div>


<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const tipoContrato =
                document.getElementById('tipo_contrato');

            const fechaFin =
                document.getElementById('fecha_fin');

            const firmado =
                document.getElementById('firmado');

            const fechaFirma =
                document.getElementById('fecha_firma');


            function controlarFechaFin() {

                if (!tipoContrato || !fechaFin) {

                    return;

                }

                if (
                    tipoContrato.value ===
                    'indeterminado'
                ) {

                    fechaFin.value = '';

                    fechaFin.disabled = true;

                } else {

                    fechaFin.disabled = false;

                }

            }


            function controlarFechaFirma() {

                if (!firmado || !fechaFirma) {

                    return;

                }

                const texto =
                    document.getElementById(
                        'estadoFirmaTexto'
                    );

                if (!firmado.checked) {

                    fechaFirma.value = '';

                    fechaFirma.disabled = true;

                    texto.textContent =
                        'Pendiente de firma física.';

                    texto.className =
                        'text-warning';

                } else {

                    fechaFirma.disabled = false;

                    texto.textContent =
                        'Contrato firmado correctamente.';

                    texto.className =
                        'text-success';

                }

            }


            tipoContrato?.addEventListener(
                'change',
                controlarFechaFin
            );

            firmado?.addEventListener(
                'change',
                controlarFechaFirma
            );


            controlarFechaFin();

            controlarFechaFirma();

        }
    );
</script>