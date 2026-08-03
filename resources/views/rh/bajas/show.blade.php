@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div
            class="
                d-flex
                flex-column
                flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
            "
        >

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-person-x me-2"></i>

                    Detalles de la baja

                </h2>

                <p class="gtri-page-subtitle mb-0">

                    Consulta la información y los documentos de la baja definitiva.

                </p>

            </div>

            <div>

                <a
                    href="{{ route('rh.empleados.inactivos') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Volver

                </a>

            </div>

        </div>

    </div>


    {{-- DATOS DEL EMPLEADO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Datos del empleado

        </div>

        <div class="row g-3">

            <div class="col-12 col-md-4">

                <small class="text-secondary d-block">

                    Número de control

                </small>

                <span class="text-warning fw-bold">

                    {{ $baja->empleado->numero_control }}

                </span>

            </div>

            <div class="col-12 col-md-8">

                <small class="text-secondary d-block">

                    Nombre completo

                </small>

                <span class="text-light fw-semibold">

                    {{ $baja->empleado->nombre }}

                    {{ $baja->empleado->apellido_paterno }}

                    {{ $baja->empleado->apellido_materno }}

                </span>

            </div>

            <div class="col-12 col-md-4">

                <small class="text-secondary d-block">

                    Puesto

                </small>

                <span class="text-light">

                    {{ $baja->empleado->puesto }}

                </span>

            </div>

            <div class="col-12 col-md-4">

                <small class="text-secondary d-block">

                    Fecha de baja

                </small>

                <span class="text-light">

                    {{ $baja->fecha_baja?->format('d/m/Y') }}

                </span>

            </div>

            <div class="col-12 col-md-4">

                <small class="text-secondary d-block">

                    Estado

                </small>

                <span class="gtri-badge-danger">

                    <i class="bi bi-x-circle me-1"></i>

                    Inactivo

                </span>

            </div>

        </div>

    </div>


    {{-- CHECKLIST --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Checklist de baja

        </div>

        <div class="row g-3">

            @php

                $checklist = [

                    'Uniforme devuelto' =>
                        $baja->uniforme_devuelto,

                    'Botas devueltas' =>
                        $baja->botas_devueltas,

                    'Credencial devuelta' =>
                        $baja->credencial_devuelta,

                    'Radio devuelto' =>
                        $baja->radio_devuelto,

                    'Carta de renuncia recibida' =>
                        $baja->carta_renuncia,

                    'Finiquito entregado' =>
                        $baja->finiquito_entregado,

                ];

            @endphp

            @foreach ($checklist as $nombre => $completado)

                <div class="col-12 col-md-6 col-xl-4">

                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-between
                            gap-3
                            p-3
                            rounded
                            border
                        "
                    >

                        <span class="text-light">

                            {{ $nombre }}

                        </span>

                        @if ($completado)

                            <span class="gtri-badge-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Sí

                            </span>

                        @else

                            <span class="gtri-badge-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                No

                            </span>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- DOCUMENTOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Evidencias documentales

        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">

                <div class="gtri-card h-100">

                    <h5 class="text-light">

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Carta de renuncia

                    </h5>

                    @if ($baja->archivo_carta_renuncia)

                        <a
                            href="{{ Storage::url(
                                $baja->archivo_carta_renuncia
                            ) }}"
                            target="_blank"
                            class="btn gtri-btn-secondary mt-3"
                        >

                            <i class="bi bi-eye me-1"></i>

                            Ver documento

                        </a>

                    @else

                        <p class="text-secondary mb-0 mt-3">

                            No hay documento registrado.

                        </p>

                    @endif

                </div>

            </div>

            <div class="col-12 col-md-6">

                <div class="gtri-card h-100">

                    <h5 class="text-light">

                        <i class="bi bi-file-earmark-check me-2"></i>

                        Finiquito firmado

                    </h5>

                    @if ($baja->archivo_finiquito)

                        <a
                            href="{{ Storage::url(
                                $baja->archivo_finiquito
                            ) }}"
                            target="_blank"
                            class="btn gtri-btn-secondary mt-3"
                        >

                            <i class="bi bi-eye me-1"></i>

                            Ver documento

                        </a>

                    @else

                        <p class="text-secondary mb-0 mt-3">

                            No hay documento registrado.

                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- INFORMACIÓN DE REGISTRO --}}
    <div class="gtri-section mb-0">

        <div class="gtri-section-title">

            <span>04</span>

            Información del registro

        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">

                <small class="text-secondary d-block">

                    Registrado por

                </small>

                <span class="text-light">

                    {{ $baja->usuario?->name ?? 'Usuario no disponible' }}

                </span>

            </div>

            <div class="col-12 col-md-6">

                <small class="text-secondary d-block">

                    Fecha de registro

                </small>

                <span class="text-light">

                    {{ $baja->created_at?->format('d/m/Y H:i') }}

                </span>

            </div>

            <div class="col-12">

                <small class="text-secondary d-block">

                    Observaciones

                </small>

                <p class="text-light mb-0">

                    {{ $baja->observaciones ?: 'Sin observaciones.' }}

                </p>

            </div>

        </div>

    </div>

</div>

@endsection