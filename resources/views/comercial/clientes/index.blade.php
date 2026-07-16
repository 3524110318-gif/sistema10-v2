@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Clientes Comerciales

        </h2>

        <a
            href="{{ route('comercial.clientes.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nuevo Cliente

        </a>

    </div>

    <form
        method="GET"
        class="row g-2 mb-4"
    >

        <div class="col-md-4">

            <input
                type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar..."
                value="{{ request('buscar') }}"
            >

        </div>

        <div class="col-auto">

            <button
                class="btn btn-outline-primary"
            >

                Buscar

            </button>

        </div>

    </form>

    <x-rh.card-rh titulo="Listado de Clientes">

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover align-middle"
            >

                <thead class="table-dark">

                    <tr>

                        <th>Razón Social</th>

                        <th>RFC</th>

                        <th>Representante</th>

                        <th>Teléfono</th>

                        <th>Correo</th>

                        <th>Estado</th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($clientes as $cliente)

                        <tr>

                            <td>

                                {{ $cliente->razon_social }}

                            </td>

                            <td>

                                {{ $cliente->rfc }}

                            </td>

                            <td>

                                {{ $cliente->representante_legal }}

                            </td>

                            <td>

                                {{ $cliente->telefono }}

                            </td>

                            <td>

                                {{ $cliente->correo }}

                            </td>

                            <td class="text-center">

                                @if($cliente->estatus=='activo')

                                    <span class="badge bg-success">

                                        Activo

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Inactivo

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('comercial.clientes.edit',$cliente) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('comercial.clientes.destroy',$cliente) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este cliente?')"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center"
                            >

                                No existen clientes registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $clientes->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection