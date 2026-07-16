@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-2">

        ADMINISTRACIÓN DE PROVEEDORES

    </h1>

    <p class="text-muted">

        Total de proveedores registrados:

        <strong>{{ $totalProveedores }}</strong>

    </p>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.proveedores.create') }}"
            class="btn btn-primary"
        >

            Nuevo proveedor

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar proveedor">

        <form method="GET">

            <div class="row align-items-end">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Razón social"
                        name="buscar"
                        type="text"
                        :value="request('buscar')"
                    />

                </div>

                <div class="col-auto">

                    <button class="btn btn-primary">

                        Buscar

                    </button>

                </div>

            </div>

        </form>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Listado de proveedores">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Razón Social</th>

                        <th>RFC</th>

                        <th>Contacto</th>

                        <th>Teléfono</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($proveedores as $proveedor)

                        <tr>

                            <td>{{ $proveedor->razon_social }}</td>

                            <td>{{ $proveedor->rfc }}</td>

                            <td>{{ $proveedor->nombre_contacto }}</td>

                            <td>{{ $proveedor->telefono }}</td>

                            <td>

                                @if($proveedor->estado == 'activo')

                                    <span class="badge bg-success">

                                        Activo

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Inactivo

                                    </span>

                                @endif

                            </td>

                            <td class="d-flex gap-2">

                                <a
                                    href="{{ route('administracion.proveedores.edit',$proveedor) }}"
                                    class="btn btn-warning btn-sm"
                                >

                                    Editar

                                </a>

                                <form
                                    action="{{ route('administracion.proveedores.destroy',$proveedor) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-secondary btn-sm">

                                        {{ $proveedor->estado == 'activo' ? 'Desactivar' : 'Activar' }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                No hay proveedores registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $proveedores->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
