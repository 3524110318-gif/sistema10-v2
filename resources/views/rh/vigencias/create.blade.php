@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar2-check me-2"></i>

                Registrar vigencia

            </h2>

            <p class="gtri-page-subtitle">

                Registra la vigencia de un documento del empleado y su evidencia correspondiente.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.vigencias.store',
            $empleado->id
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf

        @include(
            'rh.vigencias._form'
        )

    </form>

</div>

@endsection