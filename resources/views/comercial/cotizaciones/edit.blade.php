@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h2 class="mb-4">

        Editar Cotización

    </h2>

    <x-rh.card-rh titulo="Datos de la Cotización">

        <form
            action="{{ route('comercial.cotizaciones.update',$cotizacion) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            @include('comercial.cotizaciones._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection