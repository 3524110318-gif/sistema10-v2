@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-geo-alt-fill me-2"></i>

                Nueva plaza operativa

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva plaza operativa asociada a un servicio.

            </p>

        </div>


        <a
            href="{{ route('operaciones.plazas.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    {{-- ERRORES --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle me-1"></i>

                Se encontraron los siguientes errores:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route(
            'operaciones.plazas.store'
        ) }}"
    >

        @csrf


        {{-- INFORMACIÓN DE LA PLAZA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información de la plaza

            </div>


            <div class="row g-3">

                {{-- SERVICIO --}}
                <div class="col-md-6">

                    <label
                        for="servicio_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Servicio

                    </label>

                    <select
                        name="servicio_id"
                        id="servicio_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un servicio

                        </option>

                        @foreach($servicios as $servicio)

                            <option
                                value="{{ $servicio->id }}"
                                @selected(
                                    old('servicio_id') ==
                                    $servicio->id
                                )
                            >

                                {{ $servicio->nombre }}

                            </option>

                        @endforeach

                    </select>

                    @error('servicio_id')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- NOMBRE PLAZA --}}
                <div class="col-md-6">

                    <label
                        for="nombre_plaza"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Nombre de la plaza

                    </label>

                    <input
                        type="text"
                        name="nombre_plaza"
                        id="nombre_plaza"
                        class="form-control gtri-input"
                        value="{{ old('nombre_plaza') }}"
                        placeholder="Ejemplo: Acceso principal"
                        required
                    >

                    @error('nombre_plaza')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- TURNO --}}
                <div class="col-md-6">

                    <label
                        for="turno"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Turno

                    </label>

                    <select
                        name="turno"
                        id="turno"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un turno

                        </option>

                        <option
                            value="diurno"
                            @selected(old('turno') === 'diurno')
                        >

                            Diurno

                        </option>

                        <option
                            value="nocturno"
                            @selected(old('turno') === 'nocturno')
                        >

                            Nocturno

                        </option>

                        <option
                            value="Mixto"
                            @selected(old('turno') === 'Mixto')
                        >

                            Mixto

                        </option>

                    </select>

                    @error('turno')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- HORARIO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Horario de la plaza

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="hora_entrada"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Hora de entrada

                    </label>

                    <input
                        type="time"
                        name="hora_entrada"
                        id="hora_entrada"
                        class="form-control gtri-input"
                        value="{{ old('hora_entrada') }}"
                        required
                    >

                    @error('hora_entrada')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="hora_salida"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Hora de salida

                    </label>

                    <input
                        type="time"
                        name="hora_salida"
                        id="hora_salida"
                        class="form-control gtri-input"
                        value="{{ old('hora_salida') }}"
                        required
                    >

                    @error('hora_salida')

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
                        'operaciones.plazas.index'
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

                    Guardar plaza

                </button>

            </div>

        </div>

    </form>

</div>

@endsection