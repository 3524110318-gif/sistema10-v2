@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-camera me-2"></i>

                Nueva evidencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva evidencia fotográfica asociada a una supervisión.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.evidencias.index'
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
            'operaciones.evidencias.store'
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- SUPERVISIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Supervisión relacionada

            </div>

            <div class="row">

                <div class="col-lg-8">

                    <label
                        for="supervision_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Supervisión

                    </label>

                    <select
                        name="supervision_id"
                        id="supervision_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione una supervisión

                        </option>

                        @foreach(
                            $supervisiones
                            as $supervision
                        )

                            <option
                                value="{{ $supervision->id }}"
                                @selected(
                                    old('supervision_id')
                                    ==
                                    $supervision->id
                                )
                            >

                                {{
                                    $supervision
                                        ->asignacion
                                        ->empleado
                                        ->nombre
                                }}

                                -

                                {{
                                    $supervision
                                        ->asignacion
                                        ->plaza
                                        ->nombre_plaza
                                }}

                                -

                                {{ $supervision->fecha_supervision }}

                            </option>

                        @endforeach

                    </select>

                    @error('supervision_id')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DE LA EVIDENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Información de la evidencia

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="titulo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Título

                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        class="form-control gtri-input"
                        value="{{ old('titulo') }}"
                        placeholder="Ejemplo: Guardia presente en acceso principal"
                        required
                    >

                    @error('titulo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- DESCRIPCIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Descripción

            </div>

            <label
                for="descripcion"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Descripción de la evidencia

            </label>

            <textarea
                name="descripcion"
                id="descripcion"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe lo que se observa en la evidencia o cualquier detalle relevante..."
            >{{ old('descripcion') }}</textarea>

        </div>


        {{-- FOTOGRAFÍA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Evidencia fotográfica

            </div>

            <label
                for="foto"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Fotografía

            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control gtri-input"
                accept="image/*"
                required
            >

            <small class="text-secondary d-block mt-2">

                Selecciona una fotografía en formato JPG, JPEG o PNG.

            </small>

            @error('foto')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="{{ route(
                        'operaciones.evidencias.index'
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

                    Guardar evidencia

                </button>

            </div>

        </div>

    </form>

</div>

@endsection