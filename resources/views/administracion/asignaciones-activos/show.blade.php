@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.asignaciones-activos.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle de la asignación">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Activo

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $asignacion->activo->codigo_activo }} - {{ $asignacion->activo->producto->nombre }}"
                    readonly
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Empleado

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $asignacion->empleado->numero_control }} - {{ $asignacion->empleado->nombre }} {{ $asignacion->empleado->apellido_paterno }} {{ $asignacion->empleado->apellido_materno }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-bold">

                    Servicio

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $asignacion->servicio->nombre ?? 'Sin servicio' }}"
                    readonly
                >

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Fecha de entrega

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $asignacion->fecha_entrega->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label fw-bold">

                    Fecha de devolución

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $asignacion->fecha_devolucion ? $asignacion->fecha_devolucion->format('d/m/Y') : 'Pendiente' }}"
                    readonly
                >

            </div>

        </div>

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Estado

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ ucfirst($asignacion->estado) }}"
                    readonly
                >

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">

                Observaciones

            </label>

            <textarea
                class="form-control"
                rows="4"
                readonly
            >{{ $asignacion->observaciones }}</textarea>

        </div>

        <div class="text-end">

            <a
                href="{{ route('administracion.asignaciones-activos.index') }}"
                class="btn btn-secondary"
            >

                Regresar

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection
