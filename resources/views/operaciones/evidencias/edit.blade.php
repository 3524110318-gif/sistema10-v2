@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar evidencia

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información y fotografía de la evidencia.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.evidencias.show',
                $evidencia
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
            'operaciones.evidencias.update',
            $evidencia
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


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

                        @foreach(
                            $supervisiones
                            as $supervision
                        )

                            <option
                                value="{{ $supervision->id }}"
                                @selected(
                                    old(
                                        'supervision_id',
                                        $evidencia->supervision_id
                                    )
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

                                {{
                                    $supervision
                                        ->asignacion
                                        ->empleado
                                        ->apellido_paterno
                                }}

                                -

                                {{
                                    $supervision
                                        ->asignacion
                                        ->plaza
                                        ->servicio
                                        ->nombre
                                }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Información de la evidencia

            </div>

            <div class="row">

                <div class="col-md-8">

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
                        value="{{ old(
                            'titulo',
                            $evidencia->titulo
                        ) }}"
                        placeholder="Título descriptivo de la evidencia"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- DESCRIPCIÓN --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Descripción

            </div>

            <textarea
                name="descripcion"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe lo que se observa en la evidencia o cualquier detalle relevante..."
            >{{ old(
                'descripcion',
                $evidencia->descripcion
            ) }}</textarea>

        </div>


        {{-- FOTOGRAFÍA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Evidencia fotográfica

            </div>

            @if($evidencia->foto)

                <div class="mb-4">

                    <div
                        class="text-secondary mb-2"
                    >

                        Fotografía actual

                    </div>

                    <img
                        src="{{ asset(
                            'storage/' .
                            $evidencia->foto
                        ) }}"
                        class="rounded shadow"
                        style="
                            max-width:350px;
                            width:100%;
                            max-height:260px;
                            object-fit:cover;
                            border:2px solid #D4AF37;
                        "
                    >

                </div>

            @endif


            <label
                for="foto"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Cambiar fotografía

            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control gtri-input"
                accept="image/*"
            >

            <small class="text-secondary d-block mt-2">

                Déjalo vacío si deseas conservar la fotografía actual.

            </small>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route(
                        'operaciones.evidencias.show',
                        $evidencia
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

                    Actualizar evidencia

                </button>

            </div>

        </div>

    </form>

</div>

@endsection