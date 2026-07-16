@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <h1>

            Nuevo Servicio

        </h1>

        <a
            href="{{ route(
                'operaciones.servicios.index'
            ) }}"
            class="btn btn-secondary"
        >

            Regresar

        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>

                Se encontraron errores.

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
                    'operaciones.servicios.store'
                ) }}"
            >

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>

                            Contrato

                        </label>

                        <select
                            name="contrato_id"
                            class="form-control"
                            required
                        >

                            <option value="">

                                Seleccione...

                            </option>

                            @foreach($contratos as $contrato)

                                <option
                                    value="{{ $contrato->id }}"
                                    {{
                                        old('contrato_id')
                                        ==
                                        $contrato->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $contrato->numero_contrato }}

                                    -

                                    {{ $contrato->cliente->razon_social }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Nombre

                        </label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="{{ old('nombre') }}"
                            required
                        >

                    </div>

                    <div class="col-12 mb-3">

                        <label>

                            Dirección

                        </label>

                        <textarea
                            name="direccion"
                            rows="3"
                            class="form-control"
                            required
                        >{{ old('direccion') }}</textarea>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Municipio

                        </label>

                        <input
                            type="text"
                            name="municipio"
                            class="form-control"
                            value="{{ old('municipio') }}"
                        >

                    </div>

                </div>

                <button
                    class="btn btn-success"
                >

                    Guardar Servicio

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
