@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <h1>

            Clientes

        </h1>

        <a
            href="{{ route(
                'operaciones.clientes.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Cliente

        </a>

    </div>

    <form
        method="GET"
        action="{{ route(
            'operaciones.clientes.index'
        ) }}"
        class="row mb-4"
    >

        <div class="col-md-6">

            <input
                type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar por razón social, RFC o representante..."
                value="{{ $buscar }}"
            >

        </div>

        <div class="col-md-2">

            <button
                class="btn btn-dark w-100"
            >

                Buscar

            </button>

        </div>

        <div class="col-md-2">

            <a
                href="{{ route(
                    'operaciones.clientes.index'
                ) }}"
                class="btn btn-secondary w-100"
            >

                Limpiar

            </a>

        </div>

    </form>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle"
                >

                    <thead>

                        <tr>

                            <th>

                                Razón Social

                            </th>

                            <th>

                                RFC

                            </th>

                            <th>

                                Representante

                            </th>

                            <th>

                                Estado

                            </th>

                            <th width="180">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $clientes
                            as $cliente
                        )

                            <tr>

                                <td>

                                    {{ $cliente->razon_social }}

                                </td>

                                <td>

                                    {{ $cliente->rfc }}

                                </td>

                                <td>

                                    {{ $cliente->representante }}

                                </td>

                                <td>

                                    @if(
                                        $cliente->estado
                                        ==
                                        'activo'
                                    )

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

                                </td>

                                <td>

                                    <a
                                        href="{{ route(
                                            'operaciones.clientes.show',
                                            $cliente
                                        ) }}"
                                        class="btn btn-primary btn-sm"
                                    >

                                        Ver

                                    </a>

                                    <a
                                        href="{{ route(
                                            'operaciones.clientes.edit',
                                            $cliente
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route(
                                            'operaciones.clientes.destroy',
                                            $cliente
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            '¿Desea eliminar este cliente?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                        >

                                            Eliminar

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center"
                                >

                                    No existen clientes registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div
                class="mt-3"
            >

                {{ $clientes->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
