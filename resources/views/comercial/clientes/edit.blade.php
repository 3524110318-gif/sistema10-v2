@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h2 class="mb-4">

        Editar Cliente Comercial

    </h2>

    <x-rh.card-rh titulo="Datos del Cliente">

        <form
            action="{{ route('comercial.clientes.update',$cliente) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            @include(
                'comercial.clientes._form'
            )

        </form>

    </x-rh.card-rh>

</div>

@endsection