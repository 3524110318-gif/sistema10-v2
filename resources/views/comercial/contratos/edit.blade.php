@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar Contrato

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza las condiciones, vigencia, documentación y estado del contrato comercial.

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
        action="{{ route('comercial.contratos.update', $contrato) }}"
        method="POST"
    >

        @csrf

        @method('PUT')

        @include('comercial.contratos._form')

    </form>

</div>

@endsection