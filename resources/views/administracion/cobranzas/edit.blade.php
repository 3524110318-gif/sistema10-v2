@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.cobranzas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Editar cobranza">

        <form
            action="{{ route('administracion.cobranzas.update', $cobranza) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            @include(
                'administracion.cobranzas._form'
            )

        </form>

    </x-rh.card-rh>

</div>

@endsection
