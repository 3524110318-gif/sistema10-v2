@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-building-add me-2"></i>

                Nuevo servicio

            </h2>

            <p class="gtri-page-subtitle">

                Registra un nuevo servicio asociado a un contrato activo.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.servicios.index'
            ) }}"
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

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route(
            'operaciones.servicios.store'
        ) }}"
    >

        @csrf


        {{-- INFORMACIÓN PRINCIPAL --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del servicio

            </div>


            <div class="row g-3">

                {{-- CONTRATO --}}
                <div class="col-md-6">

                    <label
                        for="contrato_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Contrato

                    </label>

                    <select
                        name="contrato_id"
                        id="contrato_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un contrato

                        </option>

                        @foreach($contratos as $contrato)

                            <option
                                value="{{ $contrato->id }}"
                                @selected(
                                    old('contrato_id')
                                    ==
                                    $contrato->id
                                )
                            >

                                {{ $contrato->numero_contrato }}

                                -

                                {{ $contrato->cliente->razon_social }}

                            </option>

                        @endforeach

                    </select>

                    @error('contrato_id')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- NOMBRE --}}
                <div class="col-md-6">

                    <label
                        for="nombre"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Nombre del servicio

                    </label>

                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        class="form-control gtri-input"
                        value="{{ old('nombre') }}"
                        placeholder="Ejemplo: Vigilancia Planta Norte"
                        required
                    >

                    @error('nombre')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- MUNICIPIO --}}
                <div class="col-md-6">

                    <label
                        for="municipio"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Municipio

                    </label>

                    <input
                        type="text"
                        name="municipio"
                        id="municipio"
                        class="form-control gtri-input"
                        value="{{ old('municipio') }}"
                        placeholder="Ejemplo: Huejotzingo"
                    >

                    @error('municipio')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- DIRECCIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Ubicación del servicio

            </div>


            <label
                for="direccion"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Dirección

            </label>

            <textarea
                name="direccion"
                id="direccion"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Escribe calle, número, colonia, municipio, estado y referencias..."
                required
            >{{ old('direccion') }}</textarea>

            @error('direccion')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route(
                        'operaciones.servicios.index'
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

                    Guardar servicio

                </button>

            </div>

        </div>

    </form>

</div>

@endsection