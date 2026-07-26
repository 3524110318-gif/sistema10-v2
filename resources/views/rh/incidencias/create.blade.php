@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Nueva incidencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra una incidencia relacionada con un empleado activo.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('rh.incidencias.store') }}"
        id="form-incidencia"
    >

        @csrf


        <div class="row g-4">

            {{-- FORMULARIO PRINCIPAL --}}
            <div class="col-12 ">

                <div class="gtri-section h-100">

                    <div
                        class="
                            d-flex
                            flex-wrap
                            justify-content-between
                            align-items-center
                            gap-3
                            mb-4
                        "
                    >

                        <div class="gtri-section-title mb-0">

                            <span>01</span>

                            Datos de la incidencia

                        </div>

                    </div>


                    <div class="row g-4">

                        {{-- EMPLEADO --}}
                        <div class="col-12">

                            <label
                                for="empleado_id"
                                class="form-label gtri-form-label"
                            >

                                <i class="bi bi-person-badge me-2"></i>

                                Empleado

                            </label>


                            <select
                                name="empleado_id"
                                id="empleado_id"
                                class="
                                    form-select
                                    gtri-input
                                    @error('empleado_id') is-invalid @enderror
                                "
                                required
                            >

                                <option value="">

                                    Selecciona un empleado activo

                                </option>


                                @foreach ($empleados as $empleado)

                                    <option
                                        value="{{ $empleado->id }}"
                                        @selected(
                                            old('empleado_id') ==
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

                                <div class="invalid-feedback d-block">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- TIPO --}}
                        <div class="col-12 col-lg-6">

                            <label
                                for="tipo"
                                class="form-label gtri-form-label"
                            >

                                <i class="bi bi-tag me-2"></i>

                                Tipo de incidencia

                            </label>


                            <select
                                name="tipo"
                                id="tipo"
                                class="
                                    form-select
                                    gtri-input
                                    @error('tipo') is-invalid @enderror
                                "
                                required
                            >

                                <option value="">

                                    Selecciona un tipo

                                </option>

                                <option
                                    value="falta"
                                    @selected(old('tipo') === 'falta')
                                >

                                    Falta

                                </option>

                                <option
                                    value="retardo"
                                    @selected(old('tipo') === 'retardo')
                                >

                                    Retardo

                                </option>

                                <option
                                    value="permiso"
                                    @selected(old('tipo') === 'permiso')
                                >

                                    Permiso

                                </option>

                                <option
                                    value="incapacidad"
                                    @selected(old('tipo') === 'incapacidad')
                                >

                                    Incapacidad

                                </option>

                            </select>


                            @error('tipo')

                                <div class="invalid-feedback d-block">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- FECHA --}}
                        <div class="col-12 col-lg-6">

                            <label
                                for="fecha"
                                class="form-label gtri-form-label"
                            >

                                <i class="bi bi-calendar-event me-2"></i>

                                Fecha

                            </label>


                            <input
                                type="date"
                                name="fecha"
                                id="fecha"
                                class="
                                    form-control
                                    gtri-input
                                    @error('fecha') is-invalid @enderror
                                "
                                value="{{ old('fecha') }}"
                                max="{{ now()->format('Y-m-d') }}"
                                required
                            >


                            @error('fecha')

                                <div class="invalid-feedback d-block">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPCIÓN --}}
                        <div class="col-12">

                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    align-items-center
                                    gap-2
                                    mb-2
                                "
                            >

                                <label
                                    for="descripcion"
                                    class="form-label gtri-form-label mb-0"
                                >

                                    <i class="bi bi-card-text me-2"></i>

                                    Descripción

                                </label>


                                <span
                                    id="contador-palabras"
                                    class="gtri-word-counter"
                                >

                                    0 / 300 palabras

                                </span>

                            </div>


                            <textarea
                                name="descripcion"
                                id="descripcion"
                                rows="6"
                                class="
                                    form-control
                                    gtri-input
                                    gtri-textarea-large
                                    @error('descripcion') is-invalid @enderror
                                "
                                placeholder="Describe el motivo, contexto o detalles relevantes de la incidencia..."
                            >{{ old('descripcion') }}</textarea>


                            <div class="gtri-field-help">

                                Incluye únicamente información relacionada con la incidencia.

                            </div>


                            @error('descripcion')

                                <div class="invalid-feedback d-block">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mt-4 mb-0">

            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-end
                    align-items-center
                    gap-3
                "
            >

                <div class="d-flex flex-wrap justify-content-end gap-2">

                    <a
                        href="{{ route('rh.incidencias.index') }}"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-x-circle me-2"></i>

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-save me-2"></i>

                        Guardar incidencia

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection