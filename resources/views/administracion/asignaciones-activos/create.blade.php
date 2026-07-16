@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.asignaciones-activos.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Nueva asignación de activo">

        <form
            action="{{ route('administracion.asignaciones-activos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.asignaciones-activos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
