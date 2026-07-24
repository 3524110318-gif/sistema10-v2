@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pc-display me-2"></i>

                    Detalle del activo

                </h2>

                <p class="gtri-page-subtitle">

                    Información general y estado actual del activo.

                </p>

            </div>

            <a
                href="{{ route('administracion.activos.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- 01 IDENTIFICACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Identificación del activo

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Código del activo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->codigo_activo }}"
                    readonly
                >

            </div>

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Producto

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->producto->nombre }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Número de serie

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->numero_serie ?: 'Sin número de serie' }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Marca

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->marca ?: 'Sin marca' }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Modelo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->modelo ?: 'Sin modelo' }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- 02 INFORMACIÓN PATRIMONIAL --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Información patrimonial

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Fecha de adquisición

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $activo->fecha_adquisicion
                        ? $activo->fecha_adquisicion->format('d/m/Y')
                        : 'Sin fecha'
                    }}"
                    readonly
                >

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Valor

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="text"
                        class="form-control gtri-input"
                        value="{{ number_format($activo->valor, 2) }}"
                        readonly
                    >

                </div>

            </div>

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Estado

                </label>

                <div class="pt-2">

                    @switch($activo->estado)

                        @case('disponible')

                            <span class="badge gtri-badge-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Disponible

                            </span>

                            @break

                        @case('asignado')

                            <span class="badge bg-primary">

                                <i class="bi bi-person-check me-1"></i>

                                Asignado

                            </span>

                            @break

                        @case('mantenimiento')

                            <span class="badge gtri-badge-warning">

                                <i class="bi bi-tools me-1"></i>

                                Mantenimiento

                            </span>

                            @break

                        @default

                            <span class="badge gtri-badge-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Baja

                            </span>

                    @endswitch

                </div>

            </div>

        </div>

    </div>


    {{-- 03 OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Observaciones

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $activo->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>


    <div class="d-flex justify-content-end">

        <a
            href="{{ route('administracion.activos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>

</div>

@endsection