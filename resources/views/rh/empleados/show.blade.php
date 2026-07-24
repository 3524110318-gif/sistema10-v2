@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

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

        </div>

    </div>


    <div class="row g-4">

        {{-- PERFIL DEL EMPLEADO --}}
        {{-- PERFIL DEL EMPLEADO --}}
        <div class="col-xl-3 col-lg-4 align-self-start">

            <div class="gtri-card">

                <div class="text-center">

                    @if ($empleado->foto)

                        <img
                            src="{{ asset(
                                'fotos_empleados/' .
                                $empleado->foto
                            ) }}"
                            alt="Foto empleado"
                            class="img-fluid rounded-circle shadow mb-3"
                            style="
                                width: 210px;
                                height: 210px;
                                object-fit: cover;
                                border: 4px solid #D4AF37;
                            "
                        >

                    @else

                        <div
                            class="
                                rounded-circle
                                mx-auto
                                mb-3
                                d-flex
                                align-items-center
                                justify-content-center
                            "
                            style="
                                width: 210px;
                                height: 210px;
                                background: #111827;
                                border: 4px solid #D4AF37;
                            "
                        >

                            <i
                                class="bi bi-person text-secondary"
                                style="font-size: 6rem;"
                            ></i>

                        </div>

                    @endif


                    <h3 class="text-light fw-bold mb-1">

                        {{ $empleado->nombre }}

                        {{ $empleado->apellido_paterno }}

                    </h3>


                    @if ($empleado->apellido_materno)

                        <p class="text-secondary mb-2">

                            {{ $empleado->apellido_materno }}

                        </p>

                    @endif


                    <div class="mb-3">

                        @if ($empleado->estado == 'activo')

                            <span class="gtri-badge-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Activo

                            </span>

                        @else

                            <span class="gtri-badge-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Inactivo

                            </span>

                        @endif

                    </div>


                    <div
                        class="rounded-3 p-3 text-start"
                        style="
                            background: #111827;
                            border: 1px solid rgba(255, 255, 255, .08);
                        "
                    >

                        <div class="mb-3">

                            <small class="text-secondary d-block">

                                Número de control

                            </small>

                            <span class="text-warning fw-bold">

                                {{ $empleado->numero_control }}

                            </span>

                        </div>


                        <div class="mb-3">

                            <small class="text-secondary d-block">

                                Puesto

                            </small>

                            <span class="text-light">

                                {{ $empleado->puesto }}

                            </span>

                        </div>


                        <div>

                            <small class="text-secondary d-block">

                                Rango

                            </small>

                            <span class="text-light">

                                {{ $empleado->rango }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DEL EMPLEADO --}}
        <div class="col-xl-9 col-lg-8">

            {{-- INFORMACIÓN GENERAL --}}
            <div class="gtri-section">

                <div class="gtri-section-title">

                    <span>01</span>

                    Información general

                </div>


                <div class="row g-3">

                    <div class="col-md-4">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                No. de control

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->numero_control }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-8">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Nombre completo

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->nombre }}

                                {{ $empleado->apellido_paterno }}

                                {{ $empleado->apellido_materno }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- DOCUMENTOS --}}
            <div class="gtri-section">

                <div class="gtri-section-title">

                    <span>02</span>

                    Documentos de identidad

                </div>


                <div class="row g-3">

                    <div class="col-md-4">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                CURP

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->curp }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                RFC

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->rfc }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                NSS

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->nss }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- CONTACTO --}}
            <div class="gtri-section">

                <div class="gtri-section-title">

                    <span>03</span>

                    Información de contacto

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-telephone me-1"></i>

                                Teléfono

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->telefono }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-envelope me-1"></i>

                                Correo electrónico

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->correo }}

                            </span>

                        </div>

                    </div>


                    <div class="col-12">

                        <div
                            class="rounded-3 p-3"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-geo-alt me-1"></i>

                                Dirección

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->direccion }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- INFORMACIÓN RH --}}
            <div class="gtri-section">

                <div class="gtri-section-title">

                    <span>04</span>

                    Información de Recursos Humanos

                </div>


                <div class="row g-3">

                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Puesto

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->puesto }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Rango

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->rango }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Salario base

                            </small>

                            <span class="text-warning fw-bold">

                                ${{ number_format(
                                    $empleado->salario_base,
                                    2
                                ) }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Tipo de sangre

                            </small>

                            <span class="text-danger fw-bold">

                                {{ $empleado->tipo_sangre }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Antigüedad

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->antiguedad() }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Vacaciones disponibles

                            </small>

                            <span class="text-info fw-bold">

                                {{ $empleado->vacaciones() }} días

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Vacaciones tomadas

                            </small>

                            <span class="text-warning fw-bold">

                                {{ $empleado->vacacionesTomadas() }} días

                            </span>

                        </div>

                    </div>


                    <div class="col-md-3 col-sm-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                Vacaciones restantes

                            </small>

                            <span class="text-success fw-bold">

                                {{ $empleado->vacacionesRestantes() }} días

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FECHAS --}}
            <div class="gtri-section">

                <div class="gtri-section-title">

                    <span>05</span>

                    Fechas importantes

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-calendar-heart me-1"></i>

                                Fecha de nacimiento

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->fecha_nacimiento }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-calendar-check me-1"></i>

                                Fecha de ingreso

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->fecha_ingreso }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- CONTACTO DE EMERGENCIA --}}
            <div class="gtri-section mb-0">

                <div class="gtri-section-title">

                    <span>06</span>

                    Contacto de emergencia

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-person-exclamation me-1"></i>

                                Nombre del contacto

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->contacto_emergencia }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div
                            class="rounded-3 p-3 h-100"
                            style="
                                background: #111827;
                                border: 1px solid rgba(255, 255, 255, .08);
                            "
                        >

                            <small class="text-secondary d-block mb-1">

                                <i class="bi bi-telephone-outbound me-1"></i>

                                Teléfono de emergencia

                            </small>

                            <span class="text-light fw-semibold">

                                {{ $empleado->telefono_emergencia }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

        {{-- DOCUMENTOS RH --}}
    <div class="gtri-section mt-4">

        <div class="gtri-section-title">

            <span>07</span>

            Documentos RH

        </div>


        {{-- PROGRESO DEL EXPEDIENTE --}}
        <div
            class="rounded-3 p-4 mb-4"
            style="
                background: #111827;
                border: 1px solid rgba(255, 255, 255, .08);
            "
        >

            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-between
                    align-items-center
                    gap-2
                "
            >

                <div>

                    <h5 class="text-light fw-bold mb-1">

                        <i class="bi bi-folder-check me-2 text-warning"></i>

                        Progreso del expediente

                    </h5>

                    <small class="text-secondary">

                        Documentos entregados por el empleado

                    </small>

                </div>


                <div class="text-end">

                    <span class="text-warning fw-bold fs-5">

                        {{ $documentos->count() }}

                        /

                        {{ count($documentosRH) }}

                    </span>

                    <small class="text-secondary d-block">

                        documentos

                    </small>

                </div>

            </div>


            <div
                class="progress mt-3"
                style="
                    height: 16px;
                    background: #1F2937;
                "
            >

                <div
                    class="progress-bar bg-success fw-semibold"
                    role="progressbar"
                    style="width: {{ $porcentajeDocumentos }}%;"
                    aria-valuenow="{{ $porcentajeDocumentos }}"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >

                    {{ $porcentajeDocumentos }}%

                </div>

            </div>

        </div>


        {{-- LISTADO DE DOCUMENTOS --}}
        <div class="row g-3">

            @foreach ($documentosRH as $documentoRH)

                @php

                    $documentoSubido = $documentos
                        ->where(
                            'nombre',
                            $documentoRH
                        )
                        ->first();

                @endphp


                <div class="col-xl-4 col-md-6">

                    <div
                        class="rounded-3 p-3 h-100"
                        style="
                            background: #111827;
                            border: 1px solid rgba(255, 255, 255, .08);
                        "
                    >

                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-start
                                gap-3
                                mb-3
                            "
                        >

                            <div>

                                <small class="text-secondary d-block mb-1">

                                    Documento

                                </small>

                                <h6 class="text-light fw-bold mb-0">

                                    {{ $documentoRH }}

                                </h6>

                            </div>


                            @if ($documentoSubido)

                                <span class="gtri-badge-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Entregado

                                </span>

                            @else

                                <span class="gtri-badge-warning">

                                    <i class="bi bi-clock me-1"></i>

                                    Pendiente

                                </span>

                            @endif

                        </div>


                        @if ($documentoSubido)

                            <form
                                method="POST"
                                action="{{ route(
                                    'rh.documentos.pendiente',
                                    $empleado->id
                                ) }}"
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
                                    class="btn gtri-btn-secondary btn-sm w-100"
                                    onclick="return confirm(
                                        '¿Deseas marcar este documento como pendiente?'
                                    )"
                                >

                                    <i class="bi bi-arrow-counterclockwise me-1"></i>

                                    Marcar pendiente

                                </button>

                            </form>

                        @else

                            <form
                                method="POST"
                                action="{{ route(
                                    'rh.documentos.store',
                                    $empleado->id
                                ) }}"
                            >

                                @csrf


                                <input
                                    type="hidden"
                                    name="nombre"
                                    value="{{ $documentoRH }}"
                                >


                                <button
                                    type="submit"
                                    class="btn gtri-btn-primary btn-sm w-100"
                                >

                                    <i class="bi bi-check2-circle me-1"></i>

                                    Marcar como entregado

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- HISTORIAL DE VACACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>08</span>

            Historial de vacaciones

        </div>


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

                                    <span class="text-light fw-semibold">

                                        {{ $vacacion->dias }}

                                    </span>

                                </td>


                                <td>

                                    @if ($vacacion->estado == 'aprobada')

                                        <span class="gtri-badge-success">

                                            Aprobada

                                        </span>

                                    @elseif ($vacacion->estado == 'rechazada')

                                        <span class="gtri-badge-danger">

                                            Rechazada

                                        </span>

                                    @else

                                        <span class="gtri-badge-warning">

                                            {{ ucfirst($vacacion->estado) }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-calendar-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-2
                                        "
                                    ></i>

                                    <span class="text-secondary">

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


    {{-- HISTORIAL DE INCIDENCIAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>09</span>

            Historial de incidencias

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Tipo</th>

                            <th>Fecha</th>

                            <th>Descripción</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($incidencias as $incidencia)

                            <tr>

                                <td>

                                    <span class="gtri-badge-warning">

                                        {{ ucfirst($incidencia->tipo) }}

                                    </span>

                                </td>


                                <td>

                                    <i class="bi bi-calendar3 me-2 text-warning"></i>

                                    {{ $incidencia->fecha }}

                                </td>


                                <td>

                                    {{ $incidencia->descripcion }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-shield-check
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-2
                                        "
                                    ></i>

                                    <span class="text-secondary">

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


    {{-- UNIFORMES ENTREGADOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>10</span>

            Uniformes entregados

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Artículo</th>

                            <th>Tipo</th>

                            <th>Fecha de entrega</th>

                            <th>Observaciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($uniformes as $uniforme)

                            <tr>

                                <td>

                                    <i class="bi bi-box-seam me-2 text-warning"></i>

                                    <span class="text-light fw-semibold">

                                        {{ $uniforme->articulo }}

                                    </span>

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

                                    {{ $uniforme->fecha_entrega }}

                                </td>


                                <td>

                                    {{ $uniforme->observaciones }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-box
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-2
                                        "
                                    ></i>

                                    <span class="text-secondary">

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


    {{-- SEMÁFORO DE VIGENCIAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>11</span>

            Semáforo de vigencias

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Documento</th>

                            <th>Fecha de vencimiento</th>

                            <th>Estado</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($vigencias as $vigencia)

                            @php

                                $dias = now()->diffInDays(
                                    $vigencia->fecha_vencimiento,
                                    false
                                );

                            @endphp


                            <tr>

                                <td>

                                    <i class="bi bi-file-earmark-text me-2 text-warning"></i>

                                    <span class="text-light fw-semibold">

                                        {{ $vigencia->documento }}

                                    </span>

                                </td>


                                <td>

                                    {{ $vigencia->fecha_vencimiento }}

                                </td>


                                <td>

                                    @if ($dias < 0)

                                        <span class="gtri-badge-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Vencido

                                        </span>

                                    @elseif ($dias <= 30)

                                        <span class="gtri-badge-warning">

                                            <i class="bi bi-exclamation-triangle me-1"></i>

                                            Próximo a vencer

                                        </span>

                                    @else

                                        <span class="gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Vigente

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-calendar2-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-2
                                        "
                                    ></i>

                                    <span class="text-secondary">

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
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>12</span>

            Capacitaciones

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Curso</th>

                            <th>Calificación</th>

                            <th>Vigencia</th>

                            <th>Estado</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($capacitaciones as $capacitacion)

                            @php

                                $dias = $capacitacion->vigencia_hasta
                                    ? now()->diffInDays(
                                        $capacitacion->vigencia_hasta,
                                        false
                                    )
                                    : null;

                            @endphp


                            <tr>

                                <td>

                                    <i class="bi bi-mortarboard me-2 text-warning"></i>

                                    <span class="text-light fw-semibold">

                                        {{ $capacitacion->curso }}

                                    </span>

                                </td>


                                <td>

                                    {{ $capacitacion->calificacion }}

                                </td>


                                <td>

                                    {{ $capacitacion->vigencia_hasta }}

                                </td>


                                <td>

                                    @if (!$capacitacion->vigencia_hasta)

                                        <span
                                            class="
                                                badge
                                                rounded-pill
                                                bg-secondary
                                            "
                                        >

                                            Sin vigencia

                                        </span>

                                    @elseif ($dias < 0)

                                        <span class="gtri-badge-danger">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Vencida

                                        </span>

                                    @elseif ($dias <= 30)

                                        <span class="gtri-badge-warning">

                                            <i class="bi bi-exclamation-triangle me-1"></i>

                                            Próxima a vencer

                                        </span>

                                    @else

                                        <span class="gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Vigente

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-mortarboard
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-2
                                        "
                                    ></i>

                                    <span class="text-secondary">

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


    {{-- ACCIONES DEL EXPEDIENTE --}}
    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>13</span>

            Acciones del expediente

        </div>


        <div class="d-flex flex-wrap gap-3">

            <a
                href="{{ route(
                    'rh.empleados.ficha',
                    $empleado->id
                ) }}"
                class="btn gtri-btn-secondary"
                target="_blank"
            >

                <i class="bi bi-file-earmark-pdf me-1"></i>

                Ficha técnica

            </a>


            <a
                href="{{ route(
                    'rh.empleados.credencial',
                    $empleado->id
                ) }}"
                class="btn gtri-btn-primary"
                target="_blank"
            >

                <i class="bi bi-person-badge me-1"></i>

                Credencial

            </a>


            <a
                href="{{ route(
                    'rh.uniformes.create',
                    $empleado->id
                ) }}"
                class="btn btn-success"
            >

                <i class="bi bi-box-seam me-1"></i>

                Registrar uniforme

            </a>


            <a
                href="{{ route(
                    'rh.vigencias.create',
                    $empleado->id
                ) }}"
                class="btn btn-warning"
            >

                <i class="bi bi-calendar-check me-1"></i>

                Registrar vigencia

            </a>


            <a
                href="{{ route(
                    'rh.capacitaciones.create',
                    $empleado->id
                ) }}"
                class="btn btn-info"
            >

                <i class="bi bi-mortarboard me-1"></i>

                Registrar capacitación

            </a>

        </div>

    </div>

</div>

@endsection