@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

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


        <a
            href="{{ route('rh.prospectos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route('rh.prospectos.store') }}"
    >

        @csrf


        {{-- DATOS PERSONALES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos personales

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <label
                        for="nombre"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Nombre

                    </label>

                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        class="form-control gtri-input"
                        value="{{ old('nombre') }}"
                        required
                    >

                    @error('nombre')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-4">

                    <label
                        for="apellido_paterno"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Apellido paterno

                    </label>

                    <input
                        type="text"
                        name="apellido_paterno"
                        id="apellido_paterno"
                        class="form-control gtri-input"
                        value="{{ old('apellido_paterno') }}"
                        required
                    >

                    @error('apellido_paterno')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-4">

                    <label
                        for="apellido_materno"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Apellido materno

                    </label>

                    <input
                        type="text"
                        name="apellido_materno"
                        id="apellido_materno"
                        class="form-control gtri-input"
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


        {{-- CONTACTO Y PUESTO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Contacto y vacante

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <label
                        for="telefono"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Teléfono

                    </label>

                    <input
                        type="text"
                        name="telefono"
                        id="telefono"
                        class="form-control gtri-input"
                        value="{{ old('telefono') }}"
                    >

                </div>


                <div class="col-md-4">

                    <label
                        for="correo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Correo electrónico

                    </label>

                    <input
                        type="email"
                        name="correo"
                        id="correo"
                        class="form-control gtri-input"
                        value="{{ old('correo') }}"
                    >

                </div>


                <div class="col-md-4">

                    <label
                        for="puesto_solicitado"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Puesto solicitado

                    </label>

                    <input
                        type="text"
                        name="puesto_solicitado"
                        id="puesto_solicitado"
                        class="form-control gtri-input"
                        value="{{ old('puesto_solicitado') }}"
                    >

                </div>

            </div>

        </div>


        {{-- ENTREVISTA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Entrevista

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="fecha_entrevista"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
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
                placeholder="Escribe aquí información adicional del candidato..."
            >{{ old('observaciones') }}</textarea>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

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

    </form>

</div>

@endsection