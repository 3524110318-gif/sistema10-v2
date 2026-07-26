@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-car-front-fill me-2"></i>

                Nuevo vehículo

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva unidad vehicular para la operación.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.vehiculos.index'
            ) }}"
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
        action="{{ route(
            'operaciones.vehiculos.store'
        ) }}"
    >

        @csrf


        {{-- DATOS GENERALES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos generales

            </div>


            <div class="row g-3">

                {{-- UNIDAD --}}
                <div class="col-md-6">

                    <label
                        for="unidad"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Unidad

                    </label>

                    <input
                        type="text"
                        name="unidad"
                        id="unidad"
                        class="form-control gtri-input"
                        value="{{ old('unidad') }}"
                        placeholder="Ejemplo: Unidad 01"
                        required
                    >

                    @error('unidad')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- PLACAS --}}
                <div class="col-md-6">

                    <label
                        for="placas"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Placas

                    </label>

                    <input
                        type="text"
                        name="placas"
                        id="placas"
                        class="form-control gtri-input"
                        value="{{ old('placas') }}"
                        placeholder="Ejemplo: ABC-123-D"
                        style="text-transform:uppercase;"
                        required
                    >

                    @error('placas')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- MARCA --}}
                <div class="col-md-6">

                    <label
                        for="marca"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Marca

                    </label>

                    <input
                        type="text"
                        name="marca"
                        id="marca"
                        class="form-control gtri-input"
                        value="{{ old('marca') }}"
                        placeholder="Ejemplo: Nissan"
                        required
                    >

                    @error('marca')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- MODELO --}}
                <div class="col-md-6">

                    <label
                        for="modelo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Modelo

                    </label>

                    <input
                        type="text"
                        name="modelo"
                        id="modelo"
                        class="form-control gtri-input"
                        value="{{ old('modelo') }}"
                        placeholder="Ejemplo: NP300"
                        required
                    >

                    @error('modelo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- DATOS OPERATIVOS --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos operativos

            </div>


            <div class="row g-3">

                {{-- AÑO --}}
                <div class="col-md-6">

                    <label
                        for="anio"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Año

                    </label>

                    <input
                        type="number"
                        name="anio"
                        id="anio"
                        class="form-control gtri-input"
                        value="{{ old('anio') }}"
                        placeholder="Ejemplo: 2023"
                        required
                    >

                    @error('anio')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- KILOMETRAJE --}}
                <div class="col-md-6">

                    <label
                        for="kilometraje_actual"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Kilometraje actual

                    </label>

                    <input
                        type="number"
                        name="kilometraje_actual"
                        id="kilometraje_actual"
                        class="form-control gtri-input"
                        value="{{ old('kilometraje_actual') }}"
                        placeholder="Ejemplo: 45000"
                        min="0"
                        required
                    >

                    @error('kilometraje_actual')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="{{ route(
                        'operaciones.vehiculos.index'
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

                    <i class="bi bi-floppy me-1"></i>

                    Guardar vehículo

                </button>

            </div>

        </div>

    </form>

</div>

@endsection