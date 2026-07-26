@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div>

        <h1 class="gtri-page-title">

            Generar Código de Acceso

        </h1>

        <p class="gtri-page-subtitle">

            Crear un código dinámico para un módulo del sistema.

        </p>

    </div>

</div>


<div class="gtri-card">

    <form
        action="{{ route('gerencia.codigos.store') }}"
        method="POST"
    >

        @csrf

        <div class="row g-4">

            <div class="col-md-6">

                <label class="gtri-label">

                    Módulo

                </label>

                <select
                    name="modulo"
                    class="form-select gtri-select"
                    required
                >

                    <option value="">

                        Selecciona un módulo

                    </option>

                    <option value="rh">

                        Recursos Humanos

                    </option>

                    <option value="operaciones">

                        Operaciones

                    </option>

                    <option value="administracion">

                        Administración

                    </option>

                    <option value="comercial">

                        Comercial

                    </option>

                    <option value="repse">

                        REPSE

                    </option>

                    <option value="gerencia">

                        Gerencia

                    </option>

                </select>

                @error('modulo')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            <div class="col-md-6">

                <label class="gtri-label">

                    Código

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="Se generará automáticamente"
                    disabled
                >

                <small class="gtri-help">

                    El sistema generará un PIN aleatorio de 6 dígitos.

                </small>

            </div>

        </div>


        <div class="mt-4 d-flex gap-3">

            <button
                type="submit"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-shield-lock me-2"></i>

                Generar Código

            </button>

            <a
                href="{{ route('gerencia.codigos.index') }}"
                class="btn gtri-btn-secondary"
            >

                Cancelar

            </a>

        </div>

    </form>

</div>

@endsection