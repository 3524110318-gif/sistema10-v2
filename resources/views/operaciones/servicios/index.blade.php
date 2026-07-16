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

            Servicios

        </h1>

        <a
            href="{{ route(
                'operaciones.servicios.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Servicio

        </a>

    </div>

    <form
        method="GET"
        action="{{ route(
            'operaciones.servicios.index'
        ) }}"
        class="row mb-4"
    >

        <div class="col-md-6">

            <input
                type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar servicio, cliente, contrato o municipio..."
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
                    'operaciones.servicios.index'
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

                                Servicio

                            </th>

                            <th>

                                Municipio

                            </th>

                            <th>

                                Estado

                            </th>

                            <th width="250">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($servicios as $servicio)

                            <tr>

                                <td>

                                    {{ $servicio->contrato->cliente->razon_social }}

                                </td>

                                <td>

                                    {{ $servicio->contrato->numero_contrato }}

                                </td>

                                <td>

                                    {{ $servicio->nombre }}

                                </td>

                                <td>

                                    {{ $servicio->municipio }}

                                </td>

                                <td>

                                    @if($servicio->estado=='activo')

                                        <span class="badge bg-success">

                                            Activo

                                        </span>

                                    @elseif($servicio->estado=='suspendido')

                                        <span class="badge bg-warning text-dark">

                                            Suspendido

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Finalizado

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route(
                                            'operaciones.servicios.show',
                                            $servicio
                                        ) }}"
                                        class="btn btn-primary btn-sm"
                                    >

                                        Ver

                                    </a>

                                    <a
                                        href="{{ route(
                                            'operaciones.servicios.edit',
                                            $servicio
                                        ) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route(
                                            'operaciones.servicios.destroy',
                                            $servicio
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            '¿Desea eliminar este servicio?'
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

                                    No existen servicios registrados.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div
                class="mt-3"
            >

                {{ $servicios->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
