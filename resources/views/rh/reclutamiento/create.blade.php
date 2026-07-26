@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-plus me-2"></i>

                Nuevo prospecto

            </h2>

            <p class="gtri-page-subtitle">

                Registra un nuevo candidato para el proceso de reclutamiento.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('rh.prospectos.store') }}"
    >

        @csrf


        {{-- INFORMACIÓN PRINCIPAL --}}
        <div class="row g-4">

            {{-- DATOS PERSONALES --}}
            <div class="col-xl-8">

                <div class="gtri-section h-100">

                    <div class="gtri-section-title">

                        <span>01</span>

                        Datos personales

                    </div>


                    <div class="row g-3">

                        {{-- NOMBRE --}}
                        <div class="col-12">

                            <label
                                for="nombre"
                                class="form-label fw-semibold text-light"
                            >

                                Nombre

                            </label>

                            <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control gtri-input"
                                placeholder="Ej. Jorge Luis"
                                value="{{ old('nombre') }}"
                                required
                            >

                            @error('nombre')

                                <div class="text-danger small mt-1">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- APELLIDO PATERNO --}}
                        <div class="col-md-6">

                            <label
                                for="apellido_paterno"
                                class="form-label fw-semibold text-light"
                            >

                                Apellido paterno

                            </label>

                            <input
                                type="text"
                                name="apellido_paterno"
                                id="apellido_paterno"
                                class="form-control gtri-input"
                                placeholder="Ej. Cortés"
                                value="{{ old('apellido_paterno') }}"
                                required
                            >

                            @error('apellido_paterno')

                                <div class="text-danger small mt-1">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- APELLIDO MATERNO --}}
                        <div class="col-md-6">

                            <label
                                for="apellido_materno"
                                class="form-label fw-semibold text-light"
                            >

                                Apellido materno

                            </label>

                            <input
                                type="text"
                                name="apellido_materno"
                                id="apellido_materno"
                                class="form-control gtri-input"
                                placeholder="Ej. Flores"
                                value="{{ old('apellido_materno') }}"
                            >

                            @error('apellido_materno')

                                <div class="text-danger small mt-1">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- ENTREVISTA --}}
            <div class="col-xl-4">

                <div class="gtri-section h-100">

                    <div class="gtri-section-title">

                        <span>02</span>

                        Entrevista

                    </div>


                    <label
                        for="fecha_entrevista"
                        class="form-label fw-semibold text-light"
                    >

                        Fecha de entrevista

                    </label>

                    <input
                        type="date"
                        name="fecha_entrevista"
                        id="fecha_entrevista"
                        class="form-control gtri-input"
                        value="{{ old('fecha_entrevista') }}"
                    >


                    <small class="text-secondary d-block mt-3">

                        Selecciona la fecha programada para entrevistar al candidato.

                    </small>

                </div>

            </div>

        </div>


        {{-- CONTACTO Y VACANTE --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Contacto y vacante

            </div>


            <div class="row g-3">

                {{-- TELÉFONO --}}
                <div class="col-xl-4 col-md-6">

                    <label
                        for="telefono"
                        class="form-label fw-semibold text-light"
                    >

                        <i class="bi bi-telephone me-1 text-warning"></i>

                        Teléfono

                    </label>

                    <input
                        type="text"
                        name="telefono"
                        id="telefono"
                        class="form-control gtri-input"
                        placeholder="Ej. 222 123 4567"
                        value="{{ old('telefono') }}"
                        inputmode="numeric"
                        maxlength="12"
                    >

                </div>


                {{-- CORREO --}}
                <div class="col-xl-4 col-md-6">

                    <label
                        for="correo"
                        class="form-label fw-semibold text-light"
                    >

                        <i class="bi bi-envelope me-1 text-warning"></i>

                        Correo electrónico

                    </label>

                    <input
                        type="email"
                        name="correo"
                        id="correo"
                        class="form-control gtri-input"
                        placeholder="Ej. candidato@correo.com"
                        value="{{ old('correo') }}"
                    >

                </div>


                {{-- PUESTO --}}
                <div class="col-xl-4 col-md-12">

                    <label
                        for="puesto_solicitado"
                        class="form-label fw-semibold text-light"
                    >

                        <i class="bi bi-briefcase me-1 text-warning"></i>

                        Puesto solicitado

                    </label>

                    <input
                        type="text"
                        name="puesto_solicitado"
                        id="puesto_solicitado"
                        class="form-control gtri-input"
                        placeholder="Ej. Guardia de Seguridad"
                        value="{{ old('puesto_solicitado') }}"
                    >

                </div>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Observaciones

            </div>


            <label
                for="observaciones"
                class="form-label fw-semibold text-light"
            >

                Información adicional

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Ej. Cuenta con experiencia en seguridad privada, disponibilidad inmediata y documentación completa..."
            >{{ old('observaciones') }}</textarea>


            <small class="text-secondary d-block mt-2">

                Este campo es opcional.

            </small>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                    gap-3
                "
            >

                <small class="text-secondary">

                    Verifica la información antes de registrar al prospecto.

                </small>


                <div class="d-flex flex-wrap gap-2">

                    <a
                        href="{{ route('rh.prospectos.index') }}"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-x-circle me-1"></i>

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-person-check me-1"></i>

                        Registrar prospecto

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection