@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pencil-square me-2"></i>

                    Editar Prenómina

                </h2>

                <p class="gtri-page-subtitle">

                    Actualice la información del periodo y los cálculos
                    de la prenómina seleccionada.

                </p>

            </div>

            <a
                href="{{ route('administracion.prenominas.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- RESUMEN --}}
    <div class="gtri-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="fs-2 text-warning">

                <i class="bi bi-calculator"></i>

            </div>

            <div>

                <small class="text-secondary">

                    Prenómina seleccionada

                </small>

                <div class="fw-bold text-light">

                    {{ $prenomina->periodo_inicio->format('d/m/Y') }}
                    -
                    {{ $prenomina->periodo_fin->format('d/m/Y') }}

                </div>

                <small class="text-warning">

                    {{ ucfirst($prenomina->estatus) }}

                </small>

            </div>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route(
                'administracion.prenominas.update',
                $prenomina
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include(
                'administracion.prenominas._form'
            )

        </form>

    </div>

</div>

@endsection


@push('scripts')

    @vite(
        'resources/js/prenominas.js'
    )

@endpush