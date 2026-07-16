@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.compras.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Editar compra">

        <form
            action="{{ route('administracion.compras.update', $compra) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.compras._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
