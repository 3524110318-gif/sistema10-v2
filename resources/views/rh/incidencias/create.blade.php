@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Nueva incidencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra una incidencia relacionada con un empleado.

            </p>

        </div>


        <a
            href="{{ route('rh.incidencias.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route('rh.incidencias.store') }}"
    >

        @csrf


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos de la incidencia

            </div>


            <div class="row g-3">

                {{-- EMPLEADO --}}
                <div class="col-md-6">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Empleado

                    </label>


                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un empleado

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

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- TIPO --}}
                <div class="col-md-6">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Tipo de incidencia

                    </label>


                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select gtri-input"
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

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- FECHA --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha"
                        name="fecha"
                        type="date"
                    />

                </div>


                {{-- DESCRIPCIÓN --}}
                <div class="col-12">

                    <x-rh.textarea-rh
                        label="Descripción"
                        name="descripcion"
                        placeholder="Describe el motivo o los detalles de la incidencia..."

                    />

                </div>

            </div>

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route('rh.incidencias.index') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-save me-1"></i>

                    Guardar incidencia

                </button>

            </div>

        </div>

    </form>

</div>

@endsection