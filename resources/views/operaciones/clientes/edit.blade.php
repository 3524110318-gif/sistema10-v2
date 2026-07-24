@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar cliente

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información del cliente.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.clientes.show',
                $cliente
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
            'operaciones.clientes.update',
            $cliente
        ) }}"
    >

        @csrf
        @method('PUT')


        {{-- INFORMACIÓN GENERAL --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información general

            </div>


            <div class="row g-3">

                {{-- RAZÓN SOCIAL --}}
                <div class="col-md-6">

                    <label
                        for="razon_social"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Razón social

                    </label>

                    <input
                        type="text"
                        name="razon_social"
                        id="razon_social"
                        class="form-control gtri-input"
                        value="{{ old(
                            'razon_social',
                            $cliente->razon_social
                        ) }}"
                        required
                    >

                    @error('razon_social')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- RFC --}}
                <div class="col-md-6">

                    <label
                        for="rfc"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        RFC

                    </label>

                    <input
                        type="text"
                        name="rfc"
                        id="rfc"
                        class="form-control gtri-input"
                        value="{{ old(
                            'rfc',
                            $cliente->rfc
                        ) }}"
                        style="text-transform:uppercase;"
                        required
                    >

                    @error('rfc')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- REPRESENTANTE --}}
                <div class="col-md-6">

                    <label
                        for="representante"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Representante

                    </label>

                    <input
                        type="text"
                        name="representante"
                        id="representante"
                        class="form-control gtri-input"
                        value="{{ old(
                            'representante',
                            $cliente->representante
                        ) }}"
                        placeholder="Nombre del representante legal o contacto"
                    >

                    @error('representante')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- TELÉFONO --}}
                <div class="col-md-6">

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
                        value="{{ old(
                            'telefono',
                            $cliente->telefono
                        ) }}"
                        placeholder="Ejemplo: 222 123 4567"
                    >

                    @error('telefono')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- CORREO --}}
                <div class="col-md-6">

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
                        value="{{ old(
                            'correo',
                            $cliente->correo
                        ) }}"
                        placeholder="Ejemplo: contacto@empresa.com"
                    >

                    @error('correo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- ESTADO --}}
                <div class="col-md-6">

                    <label
                        for="estado"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Estado

                    </label>

                    <select
                        name="estado"
                        id="estado"
                        class="form-select gtri-input"
                    >

                        <option
                            value="activo"
                            @selected(
                                old(
                                    'estado',
                                    $cliente->estado
                                ) === 'activo'
                            )
                        >

                            Activo

                        </option>

                        <option
                            value="inactivo"
                            @selected(
                                old(
                                    'estado',
                                    $cliente->estado
                                ) === 'inactivo'
                            )
                        >

                            Inactivo

                        </option>

                    </select>

                    @error('estado')

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

                Dirección

            </div>


            <label
                for="direccion"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Dirección completa

            </label>

            <textarea
                name="direccion"
                id="direccion"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Escribe calle, número, colonia, municipio, estado y código postal..."
            >{{ old(
                'direccion',
                $cliente->direccion
            ) }}</textarea>

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
                        'operaciones.clientes.show',
                        $cliente
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

                    Actualizar cliente

                </button>

            </div>

        </div>

    </form>

</div>

@endsection