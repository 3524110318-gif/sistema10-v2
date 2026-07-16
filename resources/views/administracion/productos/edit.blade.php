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

    <x-rh.card-rh titulo="Editar producto">

        <form
            action="{{ route('administracion.productos.update', $producto) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.productos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
