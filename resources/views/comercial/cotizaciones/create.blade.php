@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h2 class="mb-4">

        Nueva Cotización

    </h2>

    <x-rh.card-rh titulo="Datos de la Cotización">

        <form
            action="{{ route('comercial.cotizaciones.store') }}"
            method="POST"
        >

            @csrf

            @include('comercial.cotizaciones._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection