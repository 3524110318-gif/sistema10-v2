@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.activos.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Nuevo activo">

        <form
            action="{{ route('administracion.activos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.activos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
