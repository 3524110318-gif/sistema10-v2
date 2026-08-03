@php

    /*
    |--------------------------------------------------------------------------
    | MODO DEL FORMULARIO
    |--------------------------------------------------------------------------
    */

    $editando = isset($vigencia);

    $empleadoActual = $editando
        ? $vigencia->empleado
        : $empleado;


    /*
    |--------------------------------------------------------------------------
    | CATÁLOGO DE DOCUMENTOS
    |--------------------------------------------------------------------------
    */

    $documentos = [
        'Carta de antecedentes',
        'Examen médico',
        'Cédula SSP',
        'Licencia',
    ];


    /*
    |--------------------------------------------------------------------------
    | DOCUMENTO ACTUAL
    |--------------------------------------------------------------------------
    */

    $documentoGuardado = $editando
        ? $vigencia->documento
        : null;

    $esDocumentoPredefinido = in_array(
        $documentoGuardado,
        $documentos,
        true
    );

    $documentoSeleccionado = old(
        'documento',
        $editando
            ? (
                $esDocumentoPredefinido
                    ? $documentoGuardado
                    : 'Otro'
            )
            : ''
    );

    $otroDocumento = old(
        'otro_documento',
        $editando && !$esDocumentoPredefinido
            ? $documentoGuardado
            : ''
    );

@endphp


<div
    x-data="{
        documentoSeleccionado: @js($documentoSeleccionado)
    }"
>

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

            {{-- FOTOGRAFÍA --}}
            @if ($empleadoActual->foto)

                <img
                    src="{{ asset(
                        'fotos_empleados/' .
                        $empleadoActual->foto
                    ) }}"
                    alt="Fotografía de {{ $empleadoActual->nombre }}"
                    class="rounded-circle flex-shrink-0"
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
                        flex-shrink-0
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


            {{-- DATOS DEL EMPLEADO --}}
            <div class="flex-grow-1">

                <h5 class="text-light mb-2">

                    {{ $empleadoActual->nombre }}

                    {{ $empleadoActual->apellido_paterno }}

                    {{ $empleadoActual->apellido_materno }}

                </h5>


                <div
                    class="
                        d-flex
                        flex-wrap
                        align-items-center
                        gap-2
                        gap-md-4
                    "
                >

                    <div class="text-secondary">

                        <i class="bi bi-person-vcard me-1 text-warning"></i>

                        No. de control:

                        <span class="text-light fw-semibold">

                            {{ $empleadoActual->numero_control }}

                        </span>

                    </div>


                    <div class="text-secondary">

                        <i class="bi bi-briefcase me-1 text-warning"></i>

                        Puesto:

                        <span class="text-light fw-semibold">

                            {{ $empleadoActual->puesto ?? 'Sin puesto registrado' }}

                        </span>

                    </div>


                    <div class="text-secondary">

                        <i class="bi bi-circle-fill me-1 text-success small"></i>

                        Estado:

                        <span class="text-light fw-semibold">

                            {{ ucfirst($empleadoActual->estado) }}

                        </span>

                    </div>

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

            {{-- DOCUMENTO --}}
            <div class="col-12 col-md-6">

                <label
                    for="documento"
                    class="form-label fw-semibold"
                >

                    Documento

                    <span class="text-danger">*</span>

                </label>


                <select
                    name="documento"
                    id="documento"
                    class="
                        form-select
                        gtri-input
                        @error('documento')
                            is-invalid
                        @enderror
                    "
                    x-model="documentoSeleccionado"
                    required
                >

                    <option value="">

                        Selecciona un documento

                    </option>

                    @foreach ($documentos as $documento)

                        <option
                            value="{{ $documento }}"
                            @selected(
                                $documentoSeleccionado === $documento
                            )
                        >

                            {{ $documento }}

                        </option>

                    @endforeach

                    <option
                        value="Otro"
                        @selected(
                            $documentoSeleccionado === 'Otro'
                        )
                    >

                        Otro documento

                    </option>

                </select>


                @error('documento')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            {{-- FECHA DE VENCIMIENTO --}}
            <div class="col-12 col-md-6">

                <label
                    for="fecha_vencimiento"
                    class="form-label fw-semibold"
                >

                    Fecha de vencimiento

                    <span class="text-danger">*</span>

                </label>


                <input
                    type="date"
                    name="fecha_vencimiento"
                    id="fecha_vencimiento"
                    class="
                        form-control
                        gtri-input
                        @error('fecha_vencimiento')
                            is-invalid
                        @enderror
                    "
                    value="{{ old(
                        'fecha_vencimiento',
                        $editando
                            ? $vigencia
                                ->fecha_vencimiento
                                ?->format('Y-m-d')
                            : ''
                    ) }}"
                    min="{{ now()->format('Y-m-d') }}"
                    required
                >


                @error('fecha_vencimiento')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            {{-- OTRO DOCUMENTO --}}
            <div
                class="col-12"
                x-show="documentoSeleccionado === 'Otro'"
                x-transition
                x-cloak
            >

                <label
                    for="otro_documento"
                    class="form-label fw-semibold"
                >

                    Nombre del documento

                    <span class="text-danger">*</span>

                </label>


                <input
                    type="text"
                    name="otro_documento"
                    id="otro_documento"
                    class="
                        form-control
                        gtri-input
                        @error('otro_documento')
                            is-invalid
                        @enderror
                    "
                    value="{{ $otroDocumento }}"
                    maxlength="150"
                    placeholder="Ejemplo: Licencia de conducir tipo A"
                    x-bind:required="
                        documentoSeleccionado === 'Otro'
                    "
                    x-bind:disabled="
                        documentoSeleccionado !== 'Otro'
                    "
                >


                <div class="form-text text-secondary">

                    Escribe el nombre exacto del documento.

                </div>


                @error('otro_documento')

                    <div class="invalid-feedback d-block">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

    </div>


    {{-- EVIDENCIA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Evidencia del documento

        </div>


        <div class="row g-3">

            {{-- EVIDENCIA ACTUAL --}}
            @if (
                $editando &&
                $vigencia->evidencia
            )

                <div class="col-12">

                    <div
                        class="
                            d-flex
                            flex-wrap
                            align-items-center
                            justify-content-between
                            gap-3
                            p-3
                            rounded-3
                        "
                        style="
                            background:rgba(255,255,255,.03);
                            border:1px solid rgba(255,255,255,.08);
                        "
                    >

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="
                                    d-flex
                                    align-items-center
                                    justify-content-center
                                    rounded-3
                                    text-warning
                                "
                                style="
                                    width:44px;
                                    height:44px;
                                    background:rgba(212,169,53,.12);
                                "
                            >

                                <i class="bi bi-file-earmark-check fs-5"></i>

                            </div>


                            <div>

                                <div class="text-light fw-semibold">

                                    Evidencia actual

                                </div>

                                <small class="text-secondary">

                                    Se conservará mientras no selecciones otro archivo.

                                </small>

                            </div>

                        </div>


                        <a
                            href="{{ asset(
                                'storage/' .
                                $vigencia->evidencia
                            ) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn gtri-btn-secondary btn-sm"
                        >

                            <i class="bi bi-eye me-1"></i>

                            Ver evidencia

                        </a>

                    </div>

                </div>

            @endif


            {{-- NUEVA EVIDENCIA --}}
            <div class="col-12">

                <label
                    for="evidencia"
                    class="form-label fw-semibold"
                >

                    {{ $editando
                        ? 'Sustituir evidencia'
                        : 'Archivo de evidencia' }}

                </label>


                <input
                    type="file"
                    name="evidencia"
                    id="evidencia"
                    class="
                        form-control
                        gtri-input
                        @error('evidencia')
                            is-invalid
                        @enderror
                    "
                    accept=".pdf,.jpg,.jpeg,.png"
                >


                <div class="form-text text-secondary">

                    <i class="bi bi-info-circle me-1"></i>

                    Formatos permitidos: PDF, JPG, JPEG y PNG.

                    Tamaño máximo: 5 MB.

                    @if ($editando)

                        Si no seleccionas un archivo, se conservará la evidencia actual.

                    @endif

                </div>


                @error('evidencia')

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
                align-items-center
                gap-2
            "
        >

            <a
                href="{{ $editando
                    ? route('rh.vigencias.index')
                    : route(
                        'rh.empleados.show',
                        $empleadoActual->id
                    ) }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Cancelar

            </a>


            <button
                type="submit"
                class="btn gtri-btn-primary"
            >

                <i
                    class="
                        bi
                        {{ $editando
                            ? 'bi-check-circle'
                            : 'bi-calendar2-check'
                        }}
                        me-1
                    "
                ></i>

                {{ $editando
                    ? 'Guardar cambios'
                    : 'Registrar vigencia' }}

            </button>

        </div>

    </div>

</div>