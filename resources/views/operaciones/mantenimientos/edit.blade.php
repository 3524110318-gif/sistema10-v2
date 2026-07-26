@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar mantenimiento

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información del mantenimiento registrado.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.mantenimientos.index'
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

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route(
            'operaciones.mantenimientos.update',
            $mantenimiento->id
        ) }}"
    >

        @csrf
        @method('PUT')


        {{-- VEHÍCULO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Vehículo

            </div>

            <div class="row">

                <div class="col-lg-8">

                    <label
                        for="vehiculo_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Vehículo

                    </label>

                    <select
                        name="vehiculo_id"
                        id="vehiculo_id"
                        class="form-select gtri-input"
                        required
                    >

                        @foreach(
                            $vehiculos as $vehiculo
                        )

                            <option
                                value="{{ $vehiculo->id }}"
                                @selected(
                                    old(
                                        'vehiculo_id',
                                        $mantenimiento->vehiculo_id
                                    )
                                    ==
                                    $vehiculo->id
                                )
                            >

                                {{ $vehiculo->unidad }}

                                -

                                {{ $vehiculo->placas }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- DATOS --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos del mantenimiento

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="fecha"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha

                    </label>

                    <input
                        type="date"
                        name="fecha"
                        id="fecha"
                        class="form-control gtri-input"
                        value="{{ old(
                            'fecha',
                            $mantenimiento->fecha
                        ) }}"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label
                        for="kilometraje"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Kilometraje

                    </label>

                    <input
                        type="number"
                        name="kilometraje"
                        id="kilometraje"
                        class="form-control gtri-input"
                        value="{{ old(
                            'kilometraje',
                            $mantenimiento->kilometraje
                        ) }}"
                        min="0"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Tipo de mantenimiento

                    </label>

                    <input
                        type="text"
                        name="tipo"
                        id="tipo"
                        class="form-control gtri-input"
                        value="{{ old(
                            'tipo',
                            $mantenimiento->tipo
                        ) }}"
                        placeholder="Ejemplo: Cambio de aceite"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Observaciones

            </div>

            <textarea
                name="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe los trabajos realizados, piezas reemplazadas o cualquier detalle relevante..."
            >{{ old(
                'observaciones',
                $mantenimiento->observaciones
            ) }}</textarea>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route(
                        'operaciones.mantenimientos.index'
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

                    Actualizar mantenimiento

                </button>

            </div>

        </div>

    </form>

</div>

@endsection