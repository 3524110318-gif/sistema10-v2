@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header gtri-expediente-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-vcard me-2"></i>

                Expediente del empleado

            </h2>

            <p class="gtri-page-subtitle">

                Información personal, laboral y documental del empleado.

            </p>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('rh.empleados') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>


            @if ($empleado->estado === 'activo')

                <a
                    href="{{ route(
                        'rh.empleados.edit',
                        $empleado->id
                    ) }}"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-pencil-square me-1"></i>

                    Editar empleado

                </a>

            @else

                <span class="btn gtri-btn-secondary disabled">

                    <i class="bi bi-lock-fill me-1"></i>

                    Solo lectura

                </span>

            @endif

        </div>

    </div>

    {{-- PERFIL PRINCIPAL --}}
    <div class="gtri-section">

        <div
            class="
                d-flex
                flex-column
                flex-md-row
                align-items-center
                justify-content-center
                gap-4
                py-3
            "
        >

            {{-- FOTOGRAFÍA --}}
            <div class="flex-shrink-0">

                <div class="gtri-expediente-avatar">

                    @if ($empleado->foto)

                        <img
                            src="{{ asset(
                                'fotos_empleados/' .
                                $empleado->foto
                            ) }}"
                            alt="Foto de {{ $empleado->nombre }}"
                            style="
                                width: 200px;
                                height: 200px;
                                object-fit: cover;
                            "
                        >

                    @else

                        <div
                            class="
                                gtri-expediente-avatar-placeholder
                                d-flex
                                align-items-center
                                justify-content-center
                            "
                            style="
                                width: 155px;
                                height: 155px;
                            "
                        >

                            <i class="bi bi-person"></i>

                        </div>

                    @endif

                </div>

            </div>


            {{-- IDENTIDAD --}}
            <div class="text-center text-md-start">

                <small
                    class="
                        text-secondary
                        text-uppercase
                        fw-semibold
                        d-block
                        mb-2
                    "
                >

                    <i class="bi bi-person-vcard me-1"></i>

                    Perfil del empleado

                </small>


                <h2 class="text-light fw-bold mb-1">

                    {{ $empleado->nombre }}

                    {{ $empleado->apellido_paterno }}

                    {{ $empleado->apellido_materno }}

                </h2>


                <p class="text-secondary mb-3">

                    Expediente individual de Recursos Humanos

                </p>


                @if ($empleado->estado === 'activo')

                    <span class="gtri-badge-success">

                        <i class="bi bi-check-circle-fill me-1"></i>

                        Empleado activo

                    </span>

                @else

                    <span class="gtri-badge-danger">

                        <i class="bi bi-x-circle-fill me-1"></i>

                        Empleado inactivo

                    </span>

                @endif

            </div>

        </div>

    </div>

    {{-- INFORMACIÓN PRINCIPAL --}}
    <div class="gtri-expediente-main-grid">

        {{-- INFORMACIÓN GENERAL --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información general

            </div>


            <div class="row g-3">

                <div class="col-md-5">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            No. de control

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->numero_control }}

                        </span>

                    </div>

                </div>


                <div class="col-md-7">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Nombre completo

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->nombre }}

                            {{ $empleado->apellido_paterno }}

                            {{ $empleado->apellido_materno }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- DOCUMENTOS DE IDENTIDAD --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Documentos de identidad

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            CURP

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->curp }}

                        </span>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            RFC

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->rfc }}

                        </span>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            NSS

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->nss }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DE CONTACTO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Información de contacto

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-telephone me-1"></i>

                            Teléfono

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->telefono }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-envelope me-1"></i>

                            Correo electrónico

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->correo }}

                        </span>

                    </div>

                </div>


                <div class="col-12">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-geo-alt me-1"></i>

                            Dirección

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->direccion }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- FECHAS Y CONTACTO DE EMERGENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>05</span>

                Fechas y contacto de emergencia

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-calendar-heart me-1"></i>

                            Fecha de nacimiento

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->fecha_nacimiento }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-calendar-check me-1"></i>

                            Fecha de ingreso

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->fecha_ingreso }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-person-exclamation me-1"></i>

                            Contacto de emergencia

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->contacto_emergencia }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            <i class="bi bi-telephone-outbound me-1"></i>

                            Teléfono de emergencia

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->telefono_emergencia }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DE RECURSOS HUMANOS --}}
        <div class="gtri-section gtri-section-wide">

            <div class="gtri-section-title">

                <span>04</span>

                Información de Recursos Humanos

            </div>


            <div class="row g-3">

                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Puesto

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->puesto }}

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Rango

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->rango }}

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Salario base

                        </small>

                        <span class="gtri-expediente-field-value text-warning">

                            ${{ number_format(
                                $empleado->salario_base,
                                2
                            ) }}

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Tipo de sangre

                        </small>

                        <span class="gtri-expediente-field-value text-danger">

                            {{ $empleado->tipo_sangre }}

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Antigüedad

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $empleado->antiguedad() }}

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Vacaciones disponibles

                        </small>

                        <span class="gtri-expediente-field-value text-info">

                            {{ $empleado->vacaciones() }} días

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Vacaciones tomadas

                        </small>

                        <span class="gtri-expediente-field-value text-warning">

                            {{ $empleado->vacacionesTomadas() }} días

                        </span>

                    </div>

                </div>


                <div class="col-xl-3 col-md-4 col-sm-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Vacaciones restantes

                        </small>

                        <span class="gtri-expediente-field-value text-success">

                            {{ $empleado->vacacionesRestantes() }} días

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DOCUMENTOS RH --}}
    <div class="gtri-section gtri-expediente-documents-section">

        <div class="gtri-section-title">

            <span>06</span>

            Documentos RH

        </div>


        <div class="gtri-expediente-doc-progress">

            <div class="gtri-expediente-doc-progress-header">

                <div>

                    <div class="gtri-expediente-doc-progress-title">

                        <i class="bi bi-folder-check"></i>

                        Progreso del expediente

                    </div>

                    <small>

                        Documentación entregada por el empleado.

                    </small>

                </div>

            </div>

        </div>


        <div class="gtri-expediente-documents-grid">

            @foreach ($documentosRH as $documentoRH)

                @php

                    $documentoSubido = $documentos
                        ->where(
                            'nombre',
                            $documentoRH
                        )
                        ->first();

                @endphp


                <div
                    class="
                        gtri-expediente-document-item

                        {{ $documentoSubido
                            ? 'gtri-document-delivered'
                            : 'gtri-document-pending'
                        }}
                    "
                >

                    <div class="gtri-expediente-document-information">

                        <div class="gtri-expediente-document-icon">

                            @if ($documentoSubido)

                                <i class="bi bi-file-earmark-check"></i>

                            @else

                                <i class="bi bi-file-earmark-excel"></i>

                            @endif

                        </div>


                        <div>

                            <span class="gtri-expediente-document-name">

                                {{ $documentoRH }}

                            </span>

                            <small>

                                @if ($documentoSubido)

                                    Documento entregado

                                @else

                                    Documento pendiente

                                @endif

                            </small>

                        </div>

                    </div>


                    <div class="gtri-expediente-document-action">

                        @if ($empleado->estado === 'activo')

                            @if ($documentoSubido)

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'rh.documentos.pendiente',
                                        $empleado->id
                                    ) }}"
                                    class="gtri-document-form"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="nombre"
                                        value="{{ $documentoRH }}"
                                    >

                                    <button
                                        type="submit"
                                        class="btn gtri-btn-secondary btn-sm"
                                    >

                                        <i class="bi bi-arrow-counterclockwise"></i>

                                        <span>

                                            Marcar pendiente

                                        </span>

                                    </button>

                                </form>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'rh.documentos.store',
                                        $empleado->id
                                    ) }}"
                                    class="gtri-document-form"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="nombre"
                                        value="{{ $documentoRH }}"
                                    >

                                    <button
                                        type="submit"
                                        class="btn gtri-btn-primary btn-sm"
                                    >

                                        <i class="bi bi-check2-circle"></i>

                                        <span>

                                            Marcar entregado

                                        </span>

                                    </button>

                                </form>

                            @endif

                        @else

                            <span class="gtri-expediente-readonly">

                                <i class="bi bi-lock-fill"></i>

                                Solo lectura

                            </span>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- HISTORIAL --}}
    <div class="gtri-section gtri-expediente-history-section">

        <div class="gtri-section-title">

            <span>07</span>

            Historial del empleado

        </div>


        <ul
            class="nav nav-pills gtri-expediente-history-tabs"
            id="historialEmpleado"
            role="tablist"
        >

            <li class="nav-item" role="presentation">

                <button
                    class="nav-link active"
                    id="vacaciones-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#vacaciones"
                    type="button"
                    role="tab"
                >

                    <i class="bi bi-calendar2-week"></i>

                    Vacaciones

                    <span>

                        {{ $vacaciones->count() }}

                    </span>

                </button>

            </li>


            <li class="nav-item" role="presentation">

                <button
                    class="nav-link"
                    id="incidencias-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#incidencias"
                    type="button"
                    role="tab"
                >

                    <i class="bi bi-exclamation-triangle"></i>

                    Incidencias

                    <span>

                        {{ $incidencias->count() }}

                    </span>

                </button>

            </li>


            <li class="nav-item" role="presentation">

                <button
                    class="nav-link"
                    id="uniformes-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#uniformes"
                    type="button"
                    role="tab"
                >

                    <i class="bi bi-box-seam"></i>

                    Uniformes

                    <span>

                        {{ $uniformes->count() }}

                    </span>

                </button>

            </li>


            <li class="nav-item" role="presentation">

                <button
                    class="nav-link"
                    id="vigencias-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#vigencias"
                    type="button"
                    role="tab"
                >

                    <i class="bi bi-calendar-check"></i>

                    Vigencias

                    <span>

                        {{ $vigencias->count() }}

                    </span>

                </button>

            </li>


            <li class="nav-item" role="presentation">

                <button
                    class="nav-link"
                    id="capacitaciones-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#capacitaciones"
                    type="button"
                    role="tab"
                >

                    <i class="bi bi-mortarboard"></i>

                    Capacitaciones

                    <span>

                        {{ $capacitaciones->count() }}

                    </span>

                </button>

            </li>

        </ul>


        <div
            class="tab-content gtri-expediente-history-content"
            id="historialEmpleadoContenido"
        >

            {{-- VACACIONES --}}
            <div
                class="tab-pane fade show active"
                id="vacaciones"
                role="tabpanel"
            >

                <div class="gtri-table-wrapper">

                    <div class="table-responsive">

                        <table class="table gtri-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Fecha de inicio</th>

                                    <th>Fecha de término</th>

                                    <th>Días</th>

                                    <th>Estado</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($vacaciones as $vacacion)

                                    <tr>

                                        <td>

                                            <i class="bi bi-calendar-event me-2 text-warning"></i>

                                            {{ $vacacion->fecha_inicio }}

                                        </td>

                                        <td>

                                            {{ $vacacion->fecha_fin }}

                                        </td>

                                        <td>

                                            {{ $vacacion->dias }}

                                        </td>

                                        <td>

                                            @if ($vacacion->estado === 'aprobada')

                                                <span class="gtri-badge-success">

                                                    Aprobada

                                                </span>

                                            @elseif ($vacacion->estado === 'rechazada')

                                                <span class="gtri-badge-danger">

                                                    Rechazada

                                                </span>

                                            @else

                                                <span class="gtri-badge-warning">

                                                    {{ ucfirst(
                                                        $vacacion->estado
                                                    ) }}

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="gtri-expediente-empty-table"
                                        >

                                            <i class="bi bi-calendar-x"></i>

                                            <span>

                                                Sin vacaciones registradas

                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- INCIDENCIAS --}}
            <div
                class="tab-pane fade"
                id="incidencias"
                role="tabpanel"
            >

                <div class="gtri-table-wrapper">

                    <div class="table-responsive">

                        <table class="table gtri-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Tipo</th>

                                    <th>Fecha</th>

                                    <th>Descripción</th>

                                    <th>Estado</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($incidencias as $incidencia)

                                    <tr>

                                        <td>

                                            <span class="gtri-badge-warning">

                                                {{ ucfirst(
                                                    $incidencia->tipo
                                                ) }}

                                            </span>

                                        </td>

                                        <td>

                                            {{ $incidencia->fecha }}

                                        </td>

                                        <td>

                                            {{ $incidencia->descripcion
                                                ?: 'Sin descripción'
                                            }}

                                        </td>

                                        <td>

                                            @if (
                                                $incidencia->estado
                                                ===
                                                'justificada'
                                            )

                                                <span class="gtri-badge-success">

                                                    Justificada

                                                </span>

                                            @elseif (
                                                $incidencia->estado
                                                ===
                                                'injustificada'
                                            )

                                                <span class="gtri-badge-danger">

                                                    Injustificada

                                                </span>

                                            @else

                                                <span class="gtri-badge-warning">

                                                    Pendiente

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="gtri-expediente-empty-table"
                                        >

                                            <i class="bi bi-shield-check"></i>

                                            <span>

                                                Sin incidencias registradas

                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- UNIFORMES --}}
            <div
                class="tab-pane fade"
                id="uniformes"
                role="tabpanel"
            >

                <div class="gtri-table-wrapper">

                    <div class="table-responsive">

                        <table class="table gtri-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Código</th>

                                    <th>Artículo</th>

                                    <th>Cantidad</th>

                                    <th>Tipo</th>

                                    <th>Fecha de entrega</th>

                                    <th>Observaciones</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($uniformes as $uniforme)

                                    <tr>

                                        <td>

                                            <span class="text-warning fw-semibold">

                                                {{ $uniforme->producto?->codigo ?? 'Sin código' }}

                                            </span>

                                        </td>


                                        <td>

                                            <i class="bi bi-box-seam me-2 text-warning"></i>

                                            {{ $uniforme->articulo }}

                                        </td>


                                        <td>

                                            {{ $uniforme->cantidad }}

                                        </td>


                                        <td>

                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $uniforme->tipo
                                                )
                                            ) }}

                                        </td>


                                        <td>

                                            {{ $uniforme->fecha_entrega?->format('d/m/Y') }}

                                        </td>


                                        <td>

                                            {{ $uniforme->observaciones
                                                ?: 'Sin observaciones'
                                            }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="gtri-expediente-empty-table"
                                        >

                                            <i class="bi bi-box"></i>

                                            <span>

                                                Sin uniformes registrados

                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- VIGENCIAS --}}
            <div
                class="tab-pane fade"
                id="vigencias"
                role="tabpanel"
            >

                <div class="gtri-table-wrapper">

                    <div class="table-responsive">

                        <table class="table gtri-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Documento</th>

                                    <th>Fecha de vencimiento</th>

                                    <th>Días restantes</th>

                                    <th>Estado</th>

                                    <th>Evidencia</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($vigencias as $vigencia)

                                    @php

                                        $diasVigencia = now()
                                            ->startOfDay()
                                            ->diffInDays(
                                                $vigencia
                                                    ->fecha_vencimiento
                                                    ->startOfDay(),
                                                false
                                            );

                                    @endphp


                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center gap-2">

                                                <i
                                                    class="
                                                        bi
                                                        bi-file-earmark-text
                                                        text-warning
                                                    "
                                                ></i>

                                                <span>

                                                    {{ $vigencia->documento }}

                                                </span>

                                            </div>

                                        </td>


                                        <td>

                                            {{ $vigencia
                                                ->fecha_vencimiento
                                                ?->format('d/m/Y')
                                            }}

                                        </td>


                                        <td>

                                            @if ($diasVigencia < 0)

                                                <span class="text-danger fw-semibold">

                                                    Hace {{ abs($diasVigencia) }}

                                                    {{ abs($diasVigencia) === 1
                                                        ? 'día'
                                                        : 'días'
                                                    }}

                                                </span>

                                            @elseif ($diasVigencia === 0)

                                                <span class="text-warning fw-semibold">

                                                    Vence hoy

                                                </span>

                                            @else

                                                <span class="text-light fw-semibold">

                                                    {{ $diasVigencia }}

                                                    {{ $diasVigencia === 1
                                                        ? 'día'
                                                        : 'días'
                                                    }}

                                                </span>

                                            @endif

                                        </td>


                                        <td class="text-center">

                                            @if ($diasVigencia < 0)

                                                <span class="gtri-badge-danger">

                                                    Vencido

                                                </span>

                                            @elseif ($diasVigencia <= 30)

                                                <span class="gtri-badge-warning">

                                                    Próximo a vencer

                                                </span>

                                            @else

                                                <span class="gtri-badge-success">

                                                    Vigente

                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            @if ($vigencia->evidencia)

                                                <a
                                                    href="{{ asset(
                                                        'storage/' .
                                                        $vigencia->evidencia
                                                    ) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="
                                                        btn
                                                        btn-sm
                                                        gtri-btn-secondary
                                                    "
                                                >

                                                    <i
                                                        class="
                                                            bi
                                                            bi-eye
                                                            me-1
                                                        "
                                                    ></i>

                                                    Ver evidencia

                                                </a>

                                            @else

                                                <span class="text-secondary small">

                                                    <i
                                                        class="
                                                            bi
                                                            bi-file-earmark-x
                                                            me-1
                                                        "
                                                    ></i>

                                                    Sin evidencia

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="gtri-expediente-empty-table"
                                        >

                                            <i class="bi bi-calendar2-x"></i>

                                            <span>

                                                Sin vigencias registradas

                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            {{-- CAPACITACIONES --}}
            <div
                class="tab-pane fade"
                id="capacitaciones"
                role="tabpanel"
            >

                <div class="gtri-table-wrapper">

                    <div class="table-responsive">

                        <table class="table gtri-table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>Curso</th>

                                    <th>Calificación</th>

                                    <th>Vigencia</th>

                                    <th>Estado</th>

                                    <th class="text-center">Evidencia</th>

                                    <th class="text-center">DC3</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($capacitaciones as $capacitacion)

                                    @php

                                        $diasCapacitacion =
                                            $capacitacion->vigencia_hasta
                                                ? now()->diffInDays(
                                                    $capacitacion->vigencia_hasta,
                                                    false
                                                )
                                                : null;

                                    @endphp

                                    <tr>

                                        <td>

                                            <i class="bi bi-mortarboard me-2 text-warning"></i>

                                            {{ $capacitacion->curso }}

                                        </td>

                                        <td>

                                            {{ $capacitacion->calificacion ?? '-' }}

                                        </td>

                                        <td>

                                            {{ $capacitacion->vigencia_hasta ?? 'Sin vigencia' }}

                                        </td>

                                        <td>

                                            @if (!$capacitacion->vigencia_hasta)

                                                <span class="badge bg-secondary">

                                                    Sin vigencia

                                                </span>

                                            @elseif ($diasCapacitacion < 0)

                                                <span class="gtri-badge-danger">

                                                    Vencida

                                                </span>

                                            @elseif ($diasCapacitacion <= 30)

                                                <span class="gtri-badge-warning">

                                                    Próxima a vencer

                                                </span>

                                            @else

                                                <span class="gtri-badge-success">

                                                    Vigente

                                                </span>

                                            @endif

                                        </td>

                                        {{-- Evidencia --}}
                                        <td class="text-center">

                                            @if($capacitacion->evidencia)

                                                <a
                                                    href="{{ asset('storage/'.$capacitacion->evidencia) }}"
                                                    target="_blank"
                                                    class="btn btn-sm gtri-btn-secondary"
                                                >

                                                    <i class="bi bi-file-earmark-pdf me-1"></i>

                                                    Ver

                                                </a>

                                            @else

                                                <span class="text-secondary">

                                                    —

                                                </span>

                                            @endif

                                        </td>

                                        {{-- DC3 --}}
                                        <td class="text-center">

                                            @if($capacitacion->dc3)

                                                <a
                                                    href="{{ asset('storage/'.$capacitacion->dc3) }}"
                                                    target="_blank"
                                                    class="btn btn-sm gtri-btn-secondary"
                                                >

                                                    <i class="bi bi-award me-1"></i>

                                                    Ver

                                                </a>

                                            @else

                                                <span class="text-secondary">

                                                    —

                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="gtri-expediente-empty-table"
                                        >

                                            <i class="bi bi-mortarboard"></i>

                                            <span>

                                                Sin capacitaciones registradas

                                            </span>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ACCIONES --}}
    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>08</span>

            Acciones del expediente

        </div>


        <div class="row g-3">

            <div class="col-xl col-md-4 col-sm-6">

                <a
                    href="{{ route(
                        'rh.empleados.ficha',
                        $empleado->id
                    ) }}"
                    class="
                        btn
                        gtri-btn-secondary
                        w-100
                        h-100
                        d-flex
                        align-items-center
                        justify-content-center
                        gap-2
                        py-3
                    "
                    target="_blank"
                >

                    <i class="bi bi-file-earmark-pdf"></i>

                    <span>Ficha técnica</span>

                </a>

            </div>


            <div class="col-xl col-md-4 col-sm-6">

                <a
                    href="{{ route(
                        'rh.empleados.credencial',
                        $empleado->id
                    ) }}"
                    class="
                        btn
                        gtri-btn-secondary
                        w-100
                        h-100
                        d-flex
                        align-items-center
                        justify-content-center
                        gap-2
                        py-3
                    "
                    target="_blank"
                >

                    <i class="bi bi-person-badge text-warning"></i>

                    <span>Credencial</span>

                </a>

            </div>


            @if ($empleado->estado === 'activo')

                <div class="col-xl col-md-4 col-sm-6">

                    <a
                        href="{{ route(
                            'rh.uniformes.create',
                            $empleado->id
                        ) }}"
                        class="
                            btn
                            gtri-btn-secondary
                            w-100
                            h-100
                            d-flex
                            align-items-center
                            justify-content-center
                            gap-2
                            py-3
                        "
                    >

                        <i class="bi bi-box-seam text-success"></i>

                        <span>Registrar uniforme</span>

                    </a>

                </div>


                <div class="col-xl col-md-4 col-sm-6">

                    <a
                        href="{{ route(
                            'rh.vigencias.create',
                            $empleado->id
                        ) }}"
                        class="
                            btn
                            gtri-btn-secondary
                            w-100
                            h-100
                            d-flex
                            align-items-center
                            justify-content-center
                            gap-2
                            py-3
                        "
                    >

                        <i class="bi bi-calendar-check text-warning"></i>

                        <span>Registrar vigencia</span>

                    </a>

                </div>


                <div class="col-xl col-md-4 col-sm-6">

                    <a
                        href="{{ route(
                            'rh.capacitaciones.create',
                            $empleado->id
                        ) }}"
                        class="
                            btn
                            gtri-btn-secondary
                            w-100
                            h-100
                            d-flex
                            align-items-center
                            justify-content-center
                            gap-2
                            py-3
                        "
                    >

                        <i class="bi bi-mortarboard text-info"></i>

                        <span>Registrar capacitación</span>

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
