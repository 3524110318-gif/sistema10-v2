@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- CARD PRINCIPAL --}}

    <x-rh.card-rh titulo="Nuevo expediente REPSE">

        {{-- ERRORES --}}

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Se encontraron algunos errores:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('expedientes.store') }}"
            method="POST"
        >

            @csrf


            {{-- ========================================= --}}
            {{-- INFORMACIÓN DEL EMPLEADO --}}
            {{-- ========================================= --}}

            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-person-badge me-2"></i>

                    Información del empleado

                </h5>

                <hr>

            </div>


            <div class="row">

                <div class="col-md-12 mb-4">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                    >

                        Empleado

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select"
                        required
                    >

                        <option value="">

                            Seleccione un empleado

                        </option>

                        @foreach ($empleados as $empleado)

                            <option
                                value="{{ $empleado->id }}"
                                {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}
                            >

                                {{ $empleado->nombre }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- DOCUMENTACIÓN --}}
            {{-- ========================================= --}}

            <div class="mb-4 mt-2">

                <h5 class="fw-bold">

                    <i class="bi bi-folder-check me-2"></i>

                    Documentación entregada

                </h5>

                <p class="text-muted mb-2">

                    Marque únicamente los documentos que el empleado ya haya entregado.

                </p>

                <hr>

            </div>


            <div class="row g-3">

                {{-- ALTA IMSS --}}

                <div class="col-md-6">

                    <label
                        class="border rounded p-3 w-100 d-flex align-items-center gap-3 document-option"
                    >

                        <input
                            type="checkbox"
                            name="alta_imss"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('alta_imss') ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                Alta IMSS

                            </div>

                            <small class="text-muted">

                                Constancia de alta del trabajador ante el IMSS.

                            </small>

                        </div>

                    </label>

                </div>


                {{-- CONTRATO --}}

                <div class="col-md-6">

                    <label
                        class="border rounded p-3 w-100 d-flex align-items-center gap-3 document-option"
                    >

                        <input
                            type="checkbox"
                            name="contrato_firmado"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('contrato_firmado') ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                Contrato firmado

                            </div>

                            <small class="text-muted">

                                Contrato laboral firmado por ambas partes.

                            </small>

                        </div>

                    </label>

                </div>


                {{-- CÉDULA SSP --}}

                <div class="col-md-6">

                    <label
                        class="border rounded p-3 w-100 d-flex align-items-center gap-3 document-option"
                    >

                        <input
                            type="checkbox"
                            name="cedula_ssp"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('cedula_ssp') ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                Cédula SSP

                            </div>

                            <small class="text-muted">

                                Documento correspondiente a Seguridad Pública.

                            </small>

                        </div>

                    </label>

                </div>


                {{-- CONSTANCIA FISCAL --}}

                <div class="col-md-6">

                    <label
                        class="border rounded p-3 w-100 d-flex align-items-center gap-3 document-option"
                    >

                        <input
                            type="checkbox"
                            name="constancia_fiscal"
                            value="1"
                            class="form-check-input document-checkbox"
                            {{ old('constancia_fiscal') ? 'checked' : '' }}
                        >

                        <div>

                            <div class="fw-bold">

                                Constancia fiscal

                            </div>

                            <small class="text-muted">

                                Constancia de Situación Fiscal del empleado.

                            </small>

                        </div>

                    </label>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- RESUMEN DE DOCUMENTACIÓN --}}
            {{-- ========================================= --}}

            <div class="alert alert-light border mt-4 mb-4">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <strong>

                            Estado de documentación:

                        </strong>

                        <span
                            id="estado-documentacion"
                            class="badge bg-danger ms-2"
                        >

                            Sin documentación

                        </span>

                    </div>

                    <div class="col-md-4 text-md-end mt-2 mt-md-0">

                        <strong id="contador-documentos">

                            0 / 4 documentos

                        </strong>

                    </div>

                </div>

            </div>

            <div class="mb-4 mt-4">

                <h5 class="fw-bold">

                    <i class="bi bi-calendar-check me-2"></i>

                    Vigencias documentales

                </h5>

                <p class="text-muted mb-2">

                    Registre la fecha de vigencia correspondiente.

                </p>

                <hr>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        for="vigencia_cedula_ssp"
                        class="form-label fw-semibold"
                    >

                        Vigencia Cédula SSP

                    </label>

                    <input
                        type="date"
                        name="vigencia_cedula_ssp"
                        id="vigencia_cedula_ssp"
                        value="{{ old('vigencia_cedula_ssp') }}"
                        class="form-control"
                    >

                    <div class="form-text">

                        Obligatoria cuando la Cédula SSP esté marcada como entregada.

                    </div>

                </div>

            </div>
            {{-- ========================================= --}}
            {{-- VALIDACIÓN FISCAL --}}
            {{-- ========================================= --}}
            <div class="mb-4 mt-4">

                <h5 class="fw-bold">

                    <i class="bi bi-file-earmark-text me-2"></i>

                    Validación fiscal

                </h5>

                <p class="text-muted mb-2">

                    Capture el RFC que aparece en la Constancia de Situación Fiscal.

                </p>

                <hr>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        for="rfc_constancia"
                        class="form-label fw-semibold"
                    >

                        RFC de la constancia fiscal

                    </label>

                    <input
                        type="text"
                        name="rfc_constancia"
                        id="rfc_constancia"
                        value="{{ old('rfc_constancia') }}"
                        class="form-control text-uppercase"
                        maxlength="13"
                        placeholder="Ej. GAAA010101ABC"
                    >

                    <div class="form-text">

                        Debe coincidir exactamente con el RFC registrado del empleado.

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- OBSERVACIONES --}}
            {{-- ========================================= --}}

            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-chat-left-text me-2"></i>

                    Observaciones

                </h5>

                <hr>

            </div>


            <div class="mb-3">

                <label
                    for="observaciones"
                    class="form-label fw-semibold"
                >

                    Observaciones del expediente

                </label>

                <textarea
                    name="observaciones"
                    id="observaciones"
                    rows="5"
                    maxlength="500"
                    class="form-control"
                    placeholder="Escriba aquí cualquier observación adicional..."
                >{{ old('observaciones') }}</textarea>

                <div class="text-end mt-1">

                    <small
                        id="contador-caracteres"
                        class="text-muted"
                    >

                        0 / 500

                    </small>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- BOTONES --}}
            {{-- ========================================= --}}

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="{{ route('expedientes.index') }}"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-x-circle"></i>

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="btn btn-success"
                >

                    <i class="bi bi-save"></i>

                    Guardar expediente

                </button>

            </div>

        </form>

    </x-rh.card-rh>

</div>
@endsection