@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <h1>

            Detalle del Cliente

        </h1>

        <div>

            <a
                href="{{ route(
                    'operaciones.clientes.edit',
                    $cliente
                ) }}"
                class="btn btn-warning"
            >

                Editar

            </a>

            <a
                href="{{ route(
                    'operaciones.clientes.index'
                ) }}"
                class="btn btn-secondary"
            >

                Regresar

            </a>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>

                        Razón Social

                    </strong>

                    <br>

                    {{ $cliente->razon_social }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        RFC

                    </strong>

                    <br>

                    {{ $cliente->rfc }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Representante

                    </strong>

                    <br>

                    {{ $cliente->representante ?: 'No registrado' }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Teléfono

                    </strong>

                    <br>

                    {{ $cliente->telefono ?: 'No registrado' }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Correo

                    </strong>

                    <br>

                    {{ $cliente->correo ?: 'No registrado' }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Estado

                    </strong>

                    <br>

                    @if($cliente->estado=='activo')

                        <span
                            class="badge bg-success"
                        >

                            Activo

                        </span>

                    @else

                        <span
                            class="badge bg-danger"
                        >

                            Inactivo

                        </span>

                    @endif

                </div>

                <div class="col-12">

                    <strong>

                        Dirección

                    </strong>

                    <div
                        class="border rounded p-3 mt-2"
                    >

                        {{ $cliente->direccion ?: 'Sin dirección registrada.' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm mt-4">

        <div class="card-header">

            <strong>

                Contratos del Cliente

            </strong>

        </div>

        <div class="card-body">

            @if(
                $cliente->contratos->count()
            )

                <table
                    class="table table-hover"
                >

                    <thead>

                        <tr>

                            <th>

                                Contrato

                            </th>

                            <th>

                                Estado

                            </th>

                            <th>

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach(
                            $cliente->contratos
                            as $contrato
                        )

                            <tr>

                                <td>

                                    {{ $contrato->nombre ?? ('Contrato #'.$contrato->id) }}

                                </td>

                                <td>

                                    {{ ucfirst($contrato->estado) }}

                                </td>

                                <td>

                                   <button
                                        class="btn btn-secondary btn-sm"
                                        disabled
                                    >

                                        Próximamente

                                    </button>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div
                    class="alert alert-secondary mb-0"
                >

                    Este cliente aún no tiene contratos registrados.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
