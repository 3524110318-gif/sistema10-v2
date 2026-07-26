@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-plus me-2"></i>

                Nuevo Contrato

            </h2>

            <p class="gtri-page-subtitle">

                Registra un nuevo contrato comercial con sus condiciones, vigencia y documentación.

            </p>

        </div>

        <a
            href="{{ route('comercial.contratos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <div class="d-flex align-items-center mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <strong>

                    Revisa la información ingresada

                </strong>

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        enctype="multipart/form-data"
        action="{{ route('comercial.contratos.store') }}"
        method="POST"
    >

        @csrf

        @include('comercial.contratos._form')

    </form>

</div>

@endsection