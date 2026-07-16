@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.prenominas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Editar Prenómina">

        <form
            action="{{ route('administracion.prenominas.update', $prenomina) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            @include(
                'administracion.prenominas._form'
            )

        </form>

    </x-rh.card-rh>

</div>

@endsection

@push('scripts')

    @vite(
        'resources/js/prenominas.js'
    )

@endpush
