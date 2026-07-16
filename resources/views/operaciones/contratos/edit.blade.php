@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <h1>

            Editar Contrato

        </h1>

        <a
            href="{{ route(
                'operaciones.contratos.show',
                $contrato
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
                    'operaciones.contratos.update',
                    $contrato
                ) }}"
            >

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>

                            Cliente

                        </label>

                        <select
                            name="cliente_id"
                            class="form-control"
                            required
                        >

                            @foreach($clientes as $cliente)

                                <option
                                    value="{{ $cliente->id }}"
                                    {{
                                        old('cliente_id',$contrato->cliente_id)==$cliente->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $cliente->razon_social }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Número de Contrato

                        </label>

                        <input
                            type="text"
                            name="numero_contrato"
                            class="form-control"
                            value="{{ old('numero_contrato',$contrato->numero_contrato) }}"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Fecha de Inicio

                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            class="form-control"
                            value="{{ old('fecha_inicio',$contrato->fecha_inicio) }}"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Fecha de Fin

                        </label>

                        <input
                            type="date"
                            name="fecha_fin"
                            class="form-control"
                            value="{{ old('fecha_fin',$contrato->fecha_fin) }}"
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>

                            Estado

                        </label>

                        <select
                            name="estado"
                            class="form-control"
                        >

                            <option
                                value="borrador"
                                {{ $contrato->estado=='borrador' ? 'selected' : '' }}
                            >

                                Borrador

                            </option>

                            <option
                                value="activo"
                                {{ $contrato->estado=='activo' ? 'selected' : '' }}
                            >

                                Activo

                            </option>

                            <option
                                value="vencido"
                                {{ $contrato->estado=='vencido' ? 'selected' : '' }}
                            >

                                Vencido

                            </option>

                            <option
                                value="cancelado"
                                {{ $contrato->estado=='cancelado' ? 'selected' : '' }}
                            >

                                Cancelado

                            </option>

                        </select>

                    </div>

                    <div class="col-12 mb-3">

                        <label>

                            Observaciones

                        </label>

                        <textarea
                            name="observaciones"
                            class="form-control"
                            rows="4"
                        >{{ old('observaciones',$contrato->observaciones) }}</textarea>

                    </div>

                </div>

                <button
                    class="btn btn-success"
                >

                    Actualizar Contrato

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
