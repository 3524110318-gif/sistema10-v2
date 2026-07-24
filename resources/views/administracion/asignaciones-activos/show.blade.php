@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-person-check me-2"></i>

                    Detalle de la asignación

                </h2>

                <p class="gtri-page-subtitle">

                    Información del activo asignado y responsable actual.

                </p>

            </div>

            <a
                href="{{ route('administracion.asignaciones-activos.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- ASIGNACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de asignación

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Activo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $asignacion->activo->codigo_activo }} - {{ $asignacion->activo->producto->nombre }}"
                    readonly
                >

            </div>


            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Empleado

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $asignacion->empleado->numero_control }} - {{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellido_paterno }} {{ $asignacion->empleado->apellido_materno }}"
                    readonly
                >

            </div>


            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Servicio

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $asignacion->servicio->nombre ?? 'Sin servicio' }}"
                    readonly
                >

            </div>


            <div class="col-md-3">

                <label class="gtri-label mb-2">

                    Fecha de entrega

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $asignacion->fecha_entrega->format('d/m/Y') }}"
                    readonly
                >

            </div>


            <div class="col-md-3">

                <label class="gtri-label mb-2">

                    Fecha de devolución

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $asignacion->fecha_devolucion
                        ? $asignacion->fecha_devolucion->format('d/m/Y')
                        : 'Pendiente'
                    }}"
                    readonly
                >

            </div>

        </div>

    </div>


    {{-- ESTADO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Estado actual

        </div>

        @if($asignacion->estado == 'activa')

            <span class="badge gtri-badge-success">

                <i class="bi bi-check-circle me-1"></i>

                Asignación activa

            </span>

        @else

            <span class="badge gtri-badge-warning">

                <i class="bi bi-arrow-return-left me-1"></i>

                Activo devuelto

            </span>

        @endif

    </div>


    {{-- OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Observaciones

        </div>

        <textarea
            class="form-control gtri-textarea"
            rows="4"
            readonly
        >{{ $asignacion->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

    </div>


    <div class="d-flex justify-content-end">

        <a
            href="{{ route('administracion.asignaciones-activos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>

</div>

@endsection