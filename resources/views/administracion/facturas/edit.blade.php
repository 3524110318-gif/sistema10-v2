@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.facturas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Editar factura">

        <form
            action="{{ route('administracion.facturas.update', $factura) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            @include('administracion.facturas._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection
