@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-calculator me-2"></i>

                    Nueva Prenómina

                </h2>

                <p class="gtri-page-subtitle">

                    Registre el periodo, empleados, percepciones,
                    deducciones y ajustes de la prenómina.

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

    {{-- ERRORES DE VALIDACIÓN --}}
@if ($errors->any())

    <div class="alert alert-danger gtri-alert mb-4">

        <div class="d-flex align-items-center gap-2 mb-2">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <strong>

                No fue posible guardar la prenómina

            </strong>

        </div>

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>

                    {{ $error }}

                </li>

            @endforeach

        </ul>

    </div>

@endif


    <div class="gtri-card">

        <form
            action="{{ route('administracion.prenominas.store') }}"
            method="POST"
        >

            @csrf

            @include(
                'administracion.prenominas._form'
            )

        </form>

    </div>

</div>

@endsection


@push('scripts')

    <script>

        window.entregasDeducibles = @json(
            $entregasDeducibles ?? []
        );

    </script>

    @vite(
        'resources/js/prenominas.js'
    )

@endpush