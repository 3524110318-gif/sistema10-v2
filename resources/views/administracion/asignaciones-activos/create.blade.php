@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-person-check me-2"></i>

                    Nueva asignación de activo

                </h2>

                <p class="gtri-page-subtitle">

                    Asigne un activo a un empleado y servicio.

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


    <div class="gtri-card">

        <form
            action="{{ route('administracion.asignaciones-activos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.asignaciones-activos._form')

        </form>

    </div>

</div>

@endsection