@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div>

        <h1 class="gtri-page-title">

            Editar Código de Acceso

        </h1>

        <p class="gtri-page-subtitle">

            Administrar el estado y regenerar el PIN del módulo.

        </p>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success gtri-alert">

        {{ session('success') }}

    </div>

@endif


<div class="gtri-card mb-4">

    <form
        action="{{ route('gerencia.codigos.update', $codigo) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label">

                    Módulo

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ ucfirst($codigo->modulo) }}"
                    disabled
                >

                <input
                    type="hidden"
                    name="modulo"
                    value="{{ $codigo->modulo }}"
                >

            </div>


            <div class="col-md-6">

                <label class="gtri-label">

                    Estado

                </label>

                <select
                    name="estado"
                    class="form-select gtri-select"
                    required
                >

                    <option
                        value="activo"
                        @selected($codigo->estado === 'activo')
                    >

                        Activo

                    </option>

                    <option
                        value="inactivo"
                        @selected($codigo->estado === 'inactivo')
                    >

                        Inactivo

                    </option>

                </select>

                @error('estado')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            <div class="col-md-6">

                <label class="gtri-label">

                    Código actual

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $codigo->codigo }}"
                    disabled
                >

            </div>


            <div class="col-md-6">

                <label class="gtri-label">

                    Última generación

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ optional($codigo->fecha_generacion)->format('d/m/Y H:i') }}"
                    disabled
                >

            </div>

        </div>


        <div class="mt-4 d-flex gap-3 flex-wrap">

            <button
                type="submit"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-save me-2"></i>

                Guardar cambios

            </button>

            <a
                href="{{ route('gerencia.codigos.index') }}"
                class="btn gtri-btn-secondary"
            >

                Volver

            </a>

        </div>

    </form>

</div>


<div class="gtri-section">

    <h5 class="gtri-section-title">

        <span>

            <i class="bi bi-arrow-repeat"></i>

        </span>

        Regenerar código

    </h5>

    <p class="gtri-page-subtitle mb-3">

        Esta acción reemplazará el PIN actual por uno nuevo de seis dígitos.

    </p>

    <form
        action="{{ route('gerencia.codigos.regenerar', $codigo) }}"
        method="POST"
        onsubmit="return confirm('¿Deseas regenerar este código?')"
    >

        @csrf
        @method('PUT')

        <button
            type="submit"
            class="btn btn-outline-warning"
        >

            <i class="bi bi-arrow-clockwise me-2"></i>

            Regenerar PIN

        </button>

    </form>

</div>

@endsection