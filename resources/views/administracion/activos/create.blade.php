@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pc-display me-2"></i>

                    Nuevo activo

                </h2>

                <p class="gtri-page-subtitle">

                    Registre un nuevo activo para su control y seguimiento.

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


    <div class="gtri-card">

        <form
            action="{{ route('administracion.activos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.activos._form')

        </form>

    </div>

</div>

@endsection