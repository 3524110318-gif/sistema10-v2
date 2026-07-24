@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar supervisión

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza los datos y evidencia de la supervisión.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.supervisiones.show',
                $supervision
            ) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


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
            'operaciones.supervisiones.update',
            $supervision->id
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Asignación

            </div>

            <label
                for="asignacion_id"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Guardia asignado

            </label>

            <select
                name="asignacion_id"
                id="asignacion_id"
                class="form-select gtri-input"
                required
            >

                @foreach($asignaciones as $asignacion)

                    <option
                        value="{{ $asignacion->id }}"
                        @selected(
                            old(
                                'asignacion_id',
                                $supervision->asignacion_id
                            )
                            ==
                            $asignacion->id
                        )
                    >

                        {{ $asignacion->empleado->nombre }}

                        {{ $asignacion->empleado->apellido_paterno }}

                        {{ $asignacion->empleado->apellido_materno }}

                        -

                        {{ $asignacion->plaza->nombre_plaza }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la supervisión

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="fecha_supervision"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha

                    </label>

                    <input
                        type="date"
                        name="fecha_supervision"
                        id="fecha_supervision"
                        class="form-control gtri-input"
                        value="{{ old(
                            'fecha_supervision',
                            $supervision->fecha_supervision
                        ) }}"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label
                        for="resultado"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Resultado

                    </label>

                    <select
                        name="resultado"
                        id="resultado"
                        class="form-select gtri-input"
                        required
                    >

                        <option
                            value="correcto"
                            @selected(
                                old(
                                    'resultado',
                                    $supervision->resultado
                                ) === 'correcto'
                            )
                        >

                            Correcto

                        </option>

                        <option
                            value="incidencia"
                            @selected(
                                old(
                                    'resultado',
                                    $supervision->resultado
                                ) === 'incidencia'
                            )
                        >

                            Incidencia

                        </option>

                        <option
                            value="ausente"
                            @selected(
                                old(
                                    'resultado',
                                    $supervision->resultado
                                ) === 'ausente'
                            )
                        >

                            Ausente

                        </option>

                    </select>

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Observaciones

            </div>

            <textarea
                name="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe los hallazgos o detalles de la supervisión..."
            >{{ old(
                'observaciones',
                $supervision->observaciones
            ) }}</textarea>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Evidencia fotográfica

            </div>

            @if($supervision->foto)

                <div class="mb-4">

                    <p class="text-secondary mb-2">

                        Evidencia actual

                    </p>

                    <img
                        src="{{ asset(
                            'storage/' .
                            $supervision->foto
                        ) }}"
                        class="rounded"
                        style="
                            max-width:300px;
                            max-height:220px;
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

                Cambiar evidencia fotográfica

            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control gtri-input"
                accept="image/*"
            >

            <small class="text-secondary d-block mt-2">

                Selecciona una imagen únicamente si deseas reemplazar la actual.

            </small>

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route(
                        'operaciones.supervisiones.show',
                        $supervision
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

                    Actualizar supervisión

                </button>

            </div>

        </div>

    </form>

</div>

@endsection