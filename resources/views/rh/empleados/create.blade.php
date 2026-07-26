@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-errors />


    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-plus me-2"></i>

                Nuevo empleado

            </h2>

            <p class="gtri-page-subtitle">

                Registra la información personal y laboral del empleado.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('rh.empleados.store') }}"
        enctype="multipart/form-data"
    >

        @csrf

        @include('rh.empleados._form')

    </form>

</div>

@endsection