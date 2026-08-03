@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar vigencia

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información de la vigencia y reemplaza la evidencia cuando sea necesario.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.vigencias.update',
            $vigencia->id
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')

        @include(
            'rh.vigencias._form'
        )

    </form>

</div>

@endsection