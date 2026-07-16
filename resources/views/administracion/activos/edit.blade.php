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

    <x-rh.card-rh titulo="Editar activo">

        <form
            action="{{ route('administracion.activos.update', $activo) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.activos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
