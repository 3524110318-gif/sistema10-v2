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

                Registra la vigencia y evidencia de un documento del empleado.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.vigencias.store',
            $empleado->id
        ) }}"
        enctype="multipart/form-data"
        x-data="{
            documentoSeleccionado: @js(old('documento', ''))
        }"
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

                {{-- DOCUMENTO --}}
                <div class="col-md-6">

                    <label
                        for="documento"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
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

                        <option value="Carta de antecedentes">

                            Carta de antecedentes

                        </option>

                        <option value="Examen médico">

                            Examen médico

                        </option>

                        <option value="Cédula SSP">

                            Cédula SSP

                        </option>

                        <option value="Licencia">

                            Licencia

                        </option>

                        <option value="Otro">

                            Otro

                        </option>

                    </select>


                    @error('documento')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- FECHA DE VENCIMIENTO --}}
                <div class="col-md-6">

                    <label
                        for="fecha_vencimiento"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
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
                        value="{{ old('fecha_vencimiento') }}"
                        min="{{ now()->format('Y-m-d') }}"
                        required
                    >


                    @error('fecha_vencimiento')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- OTRO DOCUMENTO --}}
                <div
                    class="col-12"
                    x-show="documentoSeleccionado === 'Otro'"
                    x-cloak
                >

                    <label
                        for="otro_documento"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
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
                        value="{{ old('otro_documento') }}"
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

                        <div class="text-danger small mt-1">

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

                <div class="col-12">

                    <label
                        for="evidencia"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Archivo de evidencia

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

                        Formatos permitidos: PDF, JPG, JPEG y PNG.

                        Tamaño máximo: 5 MB.

                    </div>


                    @error('evidencia')

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