@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />

    <x-rh.alert-errors />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header gtri-expediente-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-text me-2"></i>

                Detalle del contrato

            </h2>

            <p class="gtri-page-subtitle">

                Consulta la información, firma y vigencia del contrato laboral.

            </p>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('rh.contratos.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    @php

        $diasRestantes = $contrato->fecha_fin
            ? now()
                ->startOfDay()
                ->diffInDays(
                    $contrato->fecha_fin->copy()->startOfDay(),
                    false
                )
            : null;

    @endphp


    {{-- ESTADO GENERAL --}}
    <div class="gtri-section">

        <div
            class="
                d-flex
                flex-column
                flex-lg-row
                justify-content-between
                align-items-lg-center
                gap-4
            "
        >

            <div>

                <small
                    class="
                        text-secondary
                        text-uppercase
                        fw-semibold
                        d-block
                        mb-2
                    "
                >

                    Número de contrato

                </small>

                <h2 class="text-warning fw-bold mb-1">

                    {{ $contrato->numero_contrato }}

                </h2>

                <p class="text-secondary mb-0">

                    Contrato laboral de Recursos Humanos

                </p>

            </div>

            <div class="d-flex flex-wrap gap-2">

                @if ($contrato->estado === 'vigente')

                    <span class="gtri-badge-success">

                        <i class="bi bi-check-circle-fill me-1"></i>

                        Contrato vigente

                    </span>

                @elseif ($contrato->estado === 'vencido')

                    <span class="gtri-badge-danger">

                        <i class="bi bi-calendar-x-fill me-1"></i>

                        Contrato vencido

                    </span>

                @else

                    <span class="gtri-badge-danger">

                        <i class="bi bi-ban me-1"></i>

                        Contrato cancelado

                    </span>

                @endif


                @if (
                    $contrato->estado === 'cancelado'
                    &&
                    $contrato->firmado
                )

                    <span class="badge bg-secondary">

                        <i class="bi bi-file-earmark-check-fill me-1"></i>

                        Documento firmado

                    </span>

                @elseif ($contrato->firmado)

                    <span class="gtri-badge-success">

                        <i class="bi bi-pen-fill me-1"></i>

                        Contrato firmado

                    </span>

                @else

                    <span class="gtri-badge-warning">

                        <i class="bi bi-exclamation-circle me-1"></i>

                        Pendiente de firma

                    </span>

                @endif

            </div>

        </div>

    </div>


    <div class="gtri-expediente-main-grid">

        {{-- INFORMACIÓN DEL EMPLEADO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del empleado

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            No. de control

                        </small>

                        <span class="gtri-expediente-field-value text-warning">

                            {{ $contrato->empleado->numero_control }}

                        </span>

                    </div>

                </div>


                <div class="col-md-8">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Nombre completo

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->empleado->nombre }}

                            {{ $contrato->empleado->apellido_paterno }}

                            {{ $contrato->empleado->apellido_materno }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Puesto

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->empleado->puesto }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Estado del empleado

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ ucfirst(
                                $contrato->empleado->estado
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- INFORMACIÓN DEL CONTRATO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Información del contrato

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Tipo de contrato

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ ucfirst(
                                str_replace(
                                    '_',
                                    ' ',
                                    $contrato->tipo_contrato
                                )
                            ) }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Estado

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ ucfirst($contrato->estado) }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Fecha de inicio

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->fecha_inicio?->format('d/m/Y') }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Fecha de término

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->fecha_fin
                                ? $contrato->fecha_fin->format('d/m/Y')
                                : 'Tiempo indeterminado'
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- FIRMA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Firma del contrato

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Contrato firmado

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->firmado
                                ? 'Sí'
                                : 'No'
                            }}

                        </span>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-expediente-field">

                        <small class="gtri-expediente-field-label">

                            Fecha de firma

                        </small>

                        <span class="gtri-expediente-field-value">

                            {{ $contrato->fecha_firma
                                ? $contrato->fecha_firma->format('d/m/Y')
                                : 'Pendiente'
                            }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- VIGENCIA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Vigencia

            </div>


            <div class="gtri-expediente-field h-auto">

                <small class="gtri-expediente-field-label ">

                    Situación de la vigencia

                </small>

                <span class="gtri-expediente-field-value ">

                    @if ($contrato->estado === 'cancelado')

                        Contrato cancelado

                    @elseif (is_null($diasRestantes))

                        Contrato por tiempo indeterminado

                    @elseif ($diasRestantes < 0)

                        Venció hace

                        {{ abs($diasRestantes) }}

                        {{ abs($diasRestantes) === 1
                            ? 'día'
                            : 'días'
                        }}

                    @elseif ($diasRestantes === 0)

                        El contrato vence hoy

                    @else

                        Restan

                        {{ $diasRestantes }}

                        {{ $diasRestantes === 1
                            ? 'día'
                            : 'días'
                        }}

                    @endif

                </span>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section gtri-section-wide">

            <div class="gtri-section-title">

                <span>05</span>

                Observaciones

            </div>


            <div class="gtri-expediente-field h-auto">

                <span class="gtri-expediente-field-value ">

                    {{ $contrato->observaciones
                        ?: 'Sin observaciones registradas.'
                    }}

                </span>

            </div>

        </div>

    </div>


    {{-- ACCIONES --}}
    @if ($contrato->estado !== 'cancelado')

        <div class="gtri-section mb-0">

            <div class="gtri-section-title">

                <span>06</span>

                Acciones del contrato

            </div>


            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route(
                        'rh.contratos.renovar',
                        $contrato->id
                    ) }}"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-arrow-repeat me-1"></i>

                    Renovar contrato

                </a>


                <form
                    method="POST"
                    action="{{ route(
                        'rh.contratos.cancelar',
                        $contrato->id
                    ) }}"
                    onsubmit="
                        return confirm(
                            '¿Deseas cancelar este contrato?'
                        );
                    "
                >

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >

                        <i class="bi bi-ban me-1"></i>

                        Cancelar contrato

                    </button>

                </form>

            </div>

        </div>

    @endif

</div>

@endsection