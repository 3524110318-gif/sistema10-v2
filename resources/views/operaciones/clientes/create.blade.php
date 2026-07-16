@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Nuevo Cliente

        </h1>

        <a
            href="{{ route(
                'operaciones.clientes.index'
            ) }}"
            class="btn btn-secondary"
        >

            Regresar

        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>

                Se encontraron los siguientes errores:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                method="POST"
                action="{{ route(
                    'operaciones.clientes.store'
                ) }}"
            >

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>

                            Razón Social

                        </label>

                        <input
                            type="text"
                            name="razon_social"
                            class="form-control"
                            value="{{ old('razon_social') }}"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            RFC

                        </label>

                        <input
                            type="text"
                            name="rfc"
                            class="form-control"
                            value="{{ old('rfc') }}"
                            style="text-transform:uppercase"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Representante

                        </label>

                        <input
                            type="text"
                            name="representante"
                            class="form-control"
                            value="{{ old('representante') }}"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Teléfono

                        </label>

                        <input
                            type="text"
                            name="telefono"
                            class="form-control"
                            value="{{ old('telefono') }}"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Correo

                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            value="{{ old('correo') }}"
                        >

                    </div>

                    <div class="col-12 mb-3">

                        <label>

                            Dirección

                        </label>

                        <textarea
                            name="direccion"
                            class="form-control"
                            rows="4"
                        >{{ old('direccion') }}</textarea>

                    </div>

                </div>

                <button
                    class="btn btn-success"
                >

                    Guardar Cliente

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
