@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h2 class="mb-4">

        Editar Contrato

    </h2>

    <x-rh.card-rh titulo="Datos del Contrato">

        <form
            enctype="multipart/form-data"
            action="{{ route('comercial.contratos.update',$contrato) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            @include('comercial.contratos._form')

        </form>

    </x-rh.card-rh>

</div>

@endsection