@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.proveedores.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Nuevo proveedor">

        <form
            action="{{ route('administracion.proveedores.store') }}"
            method="POST"
        >

            @csrf

            @include('administracion.proveedores._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
