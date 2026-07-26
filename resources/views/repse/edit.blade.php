@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar Expediente REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la documentación y datos de cumplimiento normativo del empleado.

            </p>

        </div>

        <a
            href="{{ route('expedientes.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>

                <i class="bi bi-exclamation-triangle me-1"></i>

                Se encontraron algunos errores:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('expedientes.update', $expediente) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <!-- 01 · INFORMACIÓN DEL EMPLEADO -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del empleado

            </div>

            <div class="row g-3">

                <div class="col-12">

                    <label
                        for="empleado_id"
                        class="form-label"
                    >

                        Empleado

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un empleado

                        </option>

                        @foreach ($empleados as $empleado)

                            <option
                                value="{{ $empleado->id }}"
                                {{ old('empleado_id', $expediente->empleado_id) == $empleado->id ? 'selected' : '' }}
                            >

                                {{ $empleado->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        <!-- 02 · DOCUMENTACIÓN ENTREGADA -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Documentación entregada

            </div>

            <p class="text-secondary mb-4">

                Marque únicamente los documentos que el empleado ya haya entregado.

            </p>


            <div class="row g-3">

                <div class="col-md-6">

                    <label class="gtri-card w-100 h-100 d-flex align-items-center gap-3 document-option">

                        <input
                            type="checkbox"
                            name="alta_imss"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('alta_imss', $expediente->alta_imss) ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-heart-pulse me-1"></i>

                                Alta IMSS

                            </div>

                            <small class="text-secondary">

                                Constancia de alta del trabajador ante el IMSS.

                            </small>

                        </div>

                    </label>

                </div>


                <div class="col-md-6">

                    <label class="gtri-card w-100 h-100 d-flex align-items-center gap-3 document-option">

                        <input
                            type="checkbox"
                            name="contrato_firmado"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('contrato_firmado', $expediente->contrato_firmado) ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-file-earmark-check me-1"></i>

                                Contrato firmado

                            </div>

                            <small class="text-secondary">

                                Contrato laboral firmado por ambas partes.

                            </small>

                        </div>

                    </label>

                </div>


                <div class="col-md-6">

                    <label class="gtri-card w-100 h-100 d-flex align-items-center gap-3 document-option">

                        <input
                            type="checkbox"
                            name="cedula_ssp"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('cedula_ssp', $expediente->cedula_ssp) ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-shield-check me-1"></i>

                                Cédula SSP

                            </div>

                            <small class="text-secondary">

                                Documento correspondiente a Seguridad Pública.

                            </small>

                        </div>

                    </label>

                </div>


                <div class="col-md-6">

                    <label class="gtri-card w-100 h-100 d-flex align-items-center gap-3 document-option">

                        <input
                            type="checkbox"
                            name="constancia_fiscal"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('constancia_fiscal', $expediente->constancia_fiscal) ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                <i class="bi bi-receipt me-1"></i>

                                Constancia fiscal

                            </div>

                            <small class="text-secondary">

                                Constancia de Situación Fiscal del empleado.

                            </small>

                        </div>

                    </label>

                </div>

            </div>


            <div class="gtri-card mt-4">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <span class="text-secondary">

                            Estado de documentación:

                        </span>

                        <span
                            id="estado-documentacion"
                            class="badge ms-2"
                        >

                            Estado

                        </span>

                    </div>

                    <div class="col-md-4 text-md-end mt-2 mt-md-0">

                        <strong id="contador-documentos">

                            0 / 4 documentos

                        </strong>

                    </div>

                </div>

            </div>

        </div>


        <!-- 03 · VIGENCIAS DOCUMENTALES -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Vigencias documentales

            </div>

            <p class="text-secondary mb-4">

                Registre la fecha de vigencia correspondiente.

            </p>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="vigencia_cedula_ssp"
                        class="form-label"
                    >

                        Vigencia Cédula SSP

                    </label>

                    <input
                        type="date"
                        name="vigencia_cedula_ssp"
                        id="vigencia_cedula_ssp"
                        value="{{ old(
                            'vigencia_cedula_ssp',
                            $expediente->vigencia_cedula_ssp
                                ? \Carbon\Carbon::parse(
                                    $expediente->vigencia_cedula_ssp
                                )->format('Y-m-d')
                                : ''
                        ) }}"
                        class="form-control gtri-input"
                    >

                    <div class="form-text">

                        Obligatoria cuando la Cédula SSP esté marcada como entregada.

                    </div>

                </div>

            </div>

        </div>


        <!-- 04 · VALIDACIÓN FISCAL -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Validación fiscal

            </div>

            <p class="text-secondary mb-4">

                Capture el RFC que aparece en la Constancia de Situación Fiscal.

            </p>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="rfc_constancia"
                        class="form-label"
                    >

                        RFC de la constancia fiscal

                    </label>

                    <input
                        type="text"
                        name="rfc_constancia"
                        id="rfc_constancia"
                        value="{{ old(
                            'rfc_constancia',
                            $expediente->rfc_constancia
                        ) }}"
                        class="form-control gtri-input text-uppercase"
                        maxlength="13"
                        placeholder="Ej. GAAA010101ABC"
                    >

                    <div class="form-text">

                        Debe coincidir exactamente con el RFC registrado del empleado.

                    </div>

                </div>

            </div>

        </div>


        <!-- 05 · OBSERVACIONES -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>05</span>

                Observaciones

            </div>

            <label
                for="observaciones"
                class="form-label"
            >

                Observaciones del expediente

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                rows="5"
                maxlength="500"
                class="form-control gtri-textarea"
                placeholder="Ej. Documentación pendiente de validación, actualización de cédula o cualquier observación adicional..."
            >{{ old('observaciones', $expediente->observaciones) }}</textarea>

            <div class="text-end mt-1">

                <small
                    id="contador-caracteres"
                    class="text-secondary"
                >

                    0 / 500

                </small>

            </div>

        </div>


        <!-- 06 · ACCIONES -->

        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('expedientes.index') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-lg me-1"></i>

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-save me-1"></i>

                    Actualizar expediente

                </button>

            </div>

        </div>

    </form>

</div>

@endsection