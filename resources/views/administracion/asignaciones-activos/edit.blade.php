@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar asignación de activo

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice la información de la asignación seleccionada.

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


    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-person-check"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Asignación seleccionada

                </small>

                <div class="fw-bold text-light">

                    {{ $asignacion->activo->codigo_activo }}

                </div>

                <small class="text-warning">

                    {{ $asignacion->empleado->nombre }}
                    {{ $asignacion->empleado->apellido_paterno }}

                </small>

            </div>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.asignaciones-activos.update',
                $asignacion
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.asignaciones-activos._form')

        </form>

    </div>

</div>

@endsection