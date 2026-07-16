@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.productos.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Nuevo producto">

        <form
            action="{{ route('administracion.productos.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.productos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
