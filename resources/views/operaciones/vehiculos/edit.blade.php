@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar vehículo

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información y estado de la unidad vehicular.

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
            'operaciones.vehiculos.update',
            $vehiculo->id
        ) }}"
    >

        @csrf
        @method('PUT')


        {{-- DATOS GENERALES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos generales

            </div>


            <div class="row g-3">

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
                        value="{{ old(
                            'unidad',
                            $vehiculo->unidad
                        ) }}"
                        required
                    >

                </div>


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
                        value="{{ old(
                            'placas',
                            $vehiculo->placas
                        ) }}"
                        style="text-transform:uppercase;"
                        required
                    >

                </div>


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
                        value="{{ old(
                            'marca',
                            $vehiculo->marca
                        ) }}"
                        required
                    >

                </div>


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
                        value="{{ old(
                            'modelo',
                            $vehiculo->modelo
                        ) }}"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN OPERATIVA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Información operativa

            </div>


            <div class="row g-3">

                <div class="col-md-4">

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
                        value="{{ old(
                            'anio',
                            $vehiculo->anio
                        ) }}"
                        required
                    >

                </div>


                <div class="col-md-4">

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
                        value="{{ old(
                            'kilometraje_actual',
                            $vehiculo->kilometraje_actual
                        ) }}"
                        min="0"
                        required
                    >

                </div>


                <div class="col-md-4">

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
                                    $vehiculo->estado
                                ) === 'activo'
                            )
                        >

                            Activo

                        </option>

                        <option
                            value="taller"
                            @selected(
                                old(
                                    'estado',
                                    $vehiculo->estado
                                ) === 'taller'
                            )
                        >

                            Taller

                        </option>

                        <option
                            value="baja"
                            @selected(
                                old(
                                    'estado',
                                    $vehiculo->estado
                                ) === 'baja'
                            )
                        >

                            Baja

                        </option>

                    </select>

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

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

                    Actualizar vehículo

                </button>

            </div>

        </div>

    </form>

</div>

@endsection