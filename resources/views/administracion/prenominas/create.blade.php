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

    <x-rh.card-rh titulo="Nueva Prenómina">

        <form
            action="{{ route('administracion.prenominas.store') }}"
            method="POST"
        >

            @csrf

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
