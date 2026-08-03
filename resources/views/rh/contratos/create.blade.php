@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-errors />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header ">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-plus me-2"></i>

                Nuevo contrato laboral

            </h2>

            <p class="gtri-page-subtitle">

                Registra el contrato laboral de un empleado.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('rh.contratos.store') }}"
    >

        @csrf

        @include('rh.contratos._form')

    </form>

</div>

@endsection