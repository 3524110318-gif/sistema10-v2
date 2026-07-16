@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.categorias.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Editar categoría">

        <form
            action="{{ route('administracion.categorias.update', $categoria) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.categorias._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
