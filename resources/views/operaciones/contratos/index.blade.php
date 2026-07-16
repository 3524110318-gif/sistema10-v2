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

            Contratos

        </h1>

        <a
            href="{{ route(
                'operaciones.contratos.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Contrato

        </a>

    </div>

    <form
        method="GET"
        action="{{ route(
            'operaciones.contratos.index'
        ) }}"
        class="row mb-4"
    >

        <div class="col-md-6">

            <input
                type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar por cliente o número de contrato..."
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
                    'operaciones.contratos.index'
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

                                Cliente

                            </th>

                            <th>

                                Contrato

                            </th>

                            <th>

                                Inicio

                            </th>

                            <th>

                                Fin

                            </th>

                            <th>

                                Estado

                            </th>

                            <th width="220">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $contratos
                            as $contrato
                        )

                            <tr>

                                <td>

                                    {{ $contrato->cliente->razon_social }}

                                </td>

                                <td>

                                    {{ $contrato->numero_contrato }}

                                </td>

                                <td>

                                    {{ $contrato->fecha_inicio }}

                                </td>

                                <td>

                                    {{ $contrato->fecha_fin ?: 'Sin definir' }}

                                </td>

                                <td>

                                    @switch($contrato->estado)

                                        @case('activo')

                                            <span class="badge bg-success">

                                                Activo

                                            </span>

                                            @break

                                        @case('vencido')

                                            <span class="badge bg-warning text-dark">

                                                Vencido

                                            </span>

                                            @break

                                        @case('cancelado')

                                            <span class="badge bg-danger">

                                                Cancelado

                                            </span>

                                            @break

                                        @default

                                            <span class="badge bg-secondary">

                                                Borrador

                                            </span>

                                    @endswitch

                                </td>

                                <td>

                                    <a
                                        href="{{ route(
                                            'operaciones.contratos.show',
                                            $contrato
                                        ) }}"
                                        class="btn btn-primary btn-sm"
                                    >

                                        Ver

                                    </a>

                                    <a
                                        href="{{ route(
                                            'operaciones.contratos.edit',
                                            $contrato
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route(
                                            'operaciones.contratos.destroy',
                                            $contrato
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            '¿Desea eliminar este contrato?'
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

                                    No existen contratos registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div
                class="mt-3"
            >

                {{ $contratos->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
