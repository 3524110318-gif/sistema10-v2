@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h2 class="mb-4">

        Nuevo Prospecto Comercial

    </h2>

    <x-rh.card-rh titulo="Datos del Prospecto">

        <form
            action="{{ route('comercial.prospectos.store') }}"
            method="POST"
        >

            @csrf

            @include(
                'comercial.prospectos._form'
            )

        </form>

    </x-rh.card-rh>

</div>

@endsection
