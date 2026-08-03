@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Nueva incidencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra una incidencia operativa de forma manual
                o a partir de una supervisión.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.incidencias.index'
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

                <i class="bi bi-exclamation-circle me-1"></i>

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
            'operaciones.incidencias.store'
        ) }}"
    >

        @csrf


        {{-- ORIGEN DE LA INCIDENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Origen de la incidencia

            </div>


            @if(isset($supervision))

                <input
                    type="hidden"
                    name="servicio_id"
                    value="{{
                        $supervision
                            ->asignacion
                            ->plaza
                            ->servicio
                            ->id
                    }}"
                >

                <input
                    type="hidden"
                    name="supervision_id"
                    value="{{ $supervision->id }}"
                >


                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="gtri-info-card h-100">

                            <div class="gtri-info-label">

                                Guardia

                            </div>

                            <div class="gtri-info-value">

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

                                {{
                                    $supervision
                                        ->asignacion
                                        ->empleado
                                        ->apellido_materno
                                }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="gtri-info-card h-100">

                            <div class="gtri-info-label">

                                Servicio

                            </div>

                            <div class="gtri-info-value">

                                {{
                                    $supervision
                                        ->asignacion
                                        ->plaza
                                        ->servicio
                                        ->nombre
                                }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="gtri-info-card h-100">

                            <div class="gtri-info-label">

                                Plaza

                            </div>

                            <div class="gtri-info-value">

                                {{
                                    $supervision
                                        ->asignacion
                                        ->plaza
                                        ->nombre_plaza
                                }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="gtri-info-card h-100">

                            <div class="gtri-info-label">

                                Fecha de supervisión

                            </div>

                            <div class="gtri-info-value">

                                {{ $supervision->fecha_supervision }}

                            </div>

                        </div>

                    </div>

                </div>


                <div
                    class="rounded-3 p-3 mt-4"
                    style="
                        background:#111827;
                        border:1px solid rgba(212,175,55,.30);
                    "
                >

                    <i class="bi bi-link-45deg text-warning me-1"></i>

                    <span class="text-secondary">

                        Esta incidencia quedará relacionada automáticamente
                        con la supervisión seleccionada.

                    </span>

                </div>

            @else

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
                                        old('servicio_id')
                                        ==
                                        $servicio->id
                                    )
                                >

                                    {{ $servicio->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- SUPERVISIÓN --}}
                    <div class="col-md-6">

                        <label
                            for="supervision_id"
                            class="form-label fw-semibold"
                            style="color:#CBD5E1;"
                        >

                            Supervisión relacionada

                        </label>

                        <select
                            name="supervision_id"
                            id="supervision_id"
                            class="form-select gtri-input"
                        >

                            <option value="">

                                Sin supervisión

                            </option>

                            @foreach(
                                $supervisiones
                                as $supervisionItem
                            )

                                <option
                                    value="{{ $supervisionItem->id }}"
                                    @selected(
                                        old('supervision_id')
                                        ==
                                        $supervisionItem->id
                                    )
                                >

                                    {{
                                        $supervisionItem
                                            ->asignacion
                                            ->empleado
                                            ->nombre
                                    }}

                                    {{
                                        $supervisionItem
                                            ->asignacion
                                            ->empleado
                                            ->apellido_paterno
                                    }}

                                    -

                                    {{
                                        $supervisionItem
                                            ->asignacion
                                            ->plaza
                                            ->nombre_plaza
                                    }}

                                    -

                                    {{
                                        $supervisionItem
                                            ->fecha_supervision
                                    }}

                                </option>

                            @endforeach

                        </select>

                        <small class="text-secondary d-block mt-2">

                            Este campo es opcional.

                        </small>

                    </div>

                </div>

            @endif

        </div>


        {{-- DATOS DE LA INCIDENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la incidencia

            </div>


            <div class="row g-3">

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

                        <option
                            value="ausencia"
                            @selected(
                                old(
                                    'tipo',
                                    isset($supervision)
                                    &&
                                    $supervision->resultado === 'ausente'
                                    ? 'ausencia'
                                    : null
                                ) === 'ausencia'
                            )
                        >

                            Ausencia

                        </option>

                        <option
                            value="retardo"
                            @selected(old('tipo') === 'retardo')
                        >

                            Retardo

                        </option>

                        <option
                            value="cliente"
                            @selected(old('tipo') === 'cliente')
                        >

                            Cliente

                        </option>

                        <option
                            value="robo"
                            @selected(old('tipo') === 'robo')
                        >

                            Robo

                        </option>

                        <option
                            value="accidente"
                            @selected(old('tipo') === 'accidente')
                        >

                            Accidente

                        </option>

                        <option
                            value="novedad"
                            @selected(
                                old(
                                    'tipo',
                                    isset($supervision)
                                    &&
                                    $supervision->resultado === 'incidencia'
                                    ? 'novedad'
                                    : null
                                ) === 'novedad'
                            )
                        >

                            Novedad

                        </option>

                    </select>

                </div>


                {{-- FOLIO --}}
                <div class="col-md-6">

                    <label
                        for="folio_fisico"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Folio físico

                    </label>

                    <input
                        type="text"
                        name="folio_fisico"
                        id="folio_fisico"
                        class="form-control gtri-input"
                        value="{{ old('folio_fisico') }}"
                        placeholder="Ejemplo: INC-2026-001"
                    >

                    <small
                        id="mensaje-folio"
                        class="text-secondary d-block mt-2"
                    >

                        Obligatorio para robos y accidentes.
                        Opcional para los demás tipos.

                    </small>

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

                Descripción de la incidencia

            </label>

            <textarea
                name="descripcion"
                id="descripcion"
                class="form-control gtri-textarea"
                rows="5"
                placeholder="Describe detalladamente lo ocurrido, las personas involucradas y cualquier información relevante..."
                required
            >{{ old(
                'descripcion',
                isset($supervision)
                    ? $supervision->observaciones
                    : ''
            ) }}</textarea>

            <div class="d-flex justify-content-between mt-2">

                <small class="text-secondary">

                    Máximo 300 palabras.

                </small>

                <small
                    id="contador-palabras"
                    class="text-secondary"
                >

                    0 / 300

                </small>

            </div>

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="{{ route(
                        'operaciones.incidencias.index'
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

                    Guardar incidencia

                </button>

            </div>

        </div>

    </form>

</div>

@endsection