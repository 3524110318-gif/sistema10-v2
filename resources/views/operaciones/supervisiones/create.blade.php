@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-clipboard-check me-2"></i>

                Nueva supervisión

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva supervisión operativa al personal asignado.

            </p>

        </div>

        <a
            href="{{ route('operaciones.supervisiones.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    {{-- ERRORES --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle me-1"></i>

                Se encontraron los siguientes errores:

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('operaciones.supervisiones.store') }}"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- GUARDIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Guardia a supervisar

            </div>

            <div class="row g-3">

                <div class="col-lg-7">

                    <label
                        for="asignacion"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Guardia

                    </label>

                    <select
                        id="asignacion"
                        name="asignacion_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un guardia

                        </option>

                        @foreach($asignaciones as $asignacion)

                            <option
                                value="{{ $asignacion->id }}"
                                data-servicio="{{ $asignacion->plaza->servicio->nombre }}"
                                data-plaza="{{ $asignacion->plaza->nombre_plaza }}"
                                data-turno="{{ $asignacion->plaza->turno }}"
                                @selected(
                                    old('asignacion_id')
                                    ==
                                    $asignacion->id
                                )
                            >

                                {{ $asignacion->empleado->nombre }}

                                {{
                                    $asignacion->apellido_paterno
                                    ??
                                    $asignacion->empleado->apellido_paterno
                                }}

                                {{ $asignacion->empleado->apellido_materno }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DE LA ASIGNACIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Información operativa

            </div>

            <div class="row g-3">

                <div class="col-md-4">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Servicio

                        </div>

                        <div
                            id="info_servicio"
                            class="gtri-info-value"
                        >

                            Seleccione un guardia

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Plaza

                        </div>

                        <div
                            id="info_plaza"
                            class="gtri-info-value"
                        >

                            Seleccione un guardia

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Turno

                        </div>

                        <div
                            id="info_turno"
                            class="gtri-info-value"
                        >

                            Seleccione un guardia

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DATOS DE SUPERVISIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Datos de la supervisión

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="fecha_supervision"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha

                    </label>

                    <input
                        type="date"
                        name="fecha_supervision"
                        id="fecha_supervision"
                        class="form-control gtri-input"
                        value="{{ old('fecha_supervision') }}"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label
                        for="resultado"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Resultado

                    </label>

                    <select
                        name="resultado"
                        id="resultado"
                        class="form-select gtri-input"
                        required
                    >

                        <option
                            value="correcto"
                            @selected(old('resultado') === 'correcto')
                        >

                            Correcto

                        </option>

                        <option
                            value="incidencia"
                            @selected(old('resultado') === 'incidencia')
                        >

                            Incidencia

                        </option>

                        <option
                            value="ausente"
                            @selected(old('resultado') === 'ausente')
                        >

                            Ausente

                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Observaciones

            </div>

            <textarea
                name="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe los hallazgos o detalles de la supervisión..."
            >{{ old('observaciones') }}</textarea>

        </div>


        {{-- EVIDENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>05</span>

                Evidencia fotográfica

            </div>

            <label
                for="foto"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Fotografía

            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control gtri-input"
                accept="image/*"
            >

            <small class="text-secondary d-block mt-2">

                Opcional. Formatos permitidos: JPG, JPEG y PNG.

            </small>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('operaciones.supervisiones.index') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-check-circle me-1"></i>

                    Guardar supervisión

                </button>

            </div>

        </div>

    </form>

</div>


@push('scripts')

<script>

    const asignacion = document.getElementById('asignacion');

    const infoServicio = document.getElementById('info_servicio');

    const infoPlaza = document.getElementById('info_plaza');

    const infoTurno = document.getElementById('info_turno');


    function actualizarInformacion() {

        const opcion = asignacion.options[asignacion.selectedIndex];

        if (!opcion || !opcion.value) {

            infoServicio.textContent = 'Seleccione un guardia';

            infoPlaza.textContent = 'Seleccione un guardia';

            infoTurno.textContent = 'Seleccione un guardia';

            return;

        }

        infoServicio.textContent =
            opcion.dataset.servicio || 'Sin información';

        infoPlaza.textContent =
            opcion.dataset.plaza || 'Sin información';

        infoTurno.textContent =
            opcion.dataset.turno || 'Sin información';

    }


    if (asignacion) {

        asignacion.addEventListener(
            'change',
            actualizarInformacion
        );

        actualizarInformacion();

    }

</script>

@endpush

@endsection