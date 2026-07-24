@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-cash-stack me-2"></i>

                    Nueva cobranza

                </h2>

                <p class="gtri-page-subtitle">

                    Registre y dé seguimiento al cobro de una factura.

                </p>

            </div>

            <a
                href="{{ route('administracion.cobranzas.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    <div class="gtri-card">

        <form
            action="{{ route('administracion.cobranzas.store') }}"
            method="POST"
        >

            @csrf

            @include(
                'administracion.cobranzas._form'
            )

        </form>

    </div>

</div>

@endsection