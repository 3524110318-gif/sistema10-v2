@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-errors />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-arrow-repeat me-2"></i>

                Renovar contrato

            </h2>

            <p class="gtri-page-subtitle">

                Registra un nuevo contrato conservando el contrato anterior como historial.

            </p>

        </div>

    </div>


    {{-- CONTRATO ANTERIOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>00</span>

            Contrato anterior

        </div>


        <div class="row g-3">

            <div class="col-md-4">

                <div class="gtri-expediente-field">

                    <small class="gtri-expediente-field-label">

                        Número de contrato

                    </small>

                    <span class="gtri-expediente-field-value text-warning">

                        {{ $contrato->numero_contrato }}

                    </span>

                </div>

            </div>


            <div class="col-md-4">

                <div class="gtri-expediente-field">

                    <small class="gtri-expediente-field-label">

                        Fecha de inicio

                    </small>

                    <span class="gtri-expediente-field-value">

                        {{ $contrato->fecha_inicio?->format('d/m/Y') }}

                    </span>

                </div>

            </div>


            <div class="col-md-4">

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


    <form
        method="POST"
        action="{{ route(
            'rh.contratos.guardarRenovacion',
            $contrato->id
        ) }}"
    >

        @csrf

        @include(
            'rh.contratos._form',
            [
                'renovando' => true,
            ]
        )

    </form>

</div>

@endsection