@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        ADMINISTRACIÓN DE CATEGORÍAS

    </h1>

    <p class="text-muted">

        Total de categorías registradas:

        <strong>{{ $totalCategorias }}</strong>

    </p>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.categorias.create') }}"
            class="btn btn-primary"
        >

            Nueva categoría

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar categoría">

        <form method="GET">

            <div class="row align-items-end">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Nombre"
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

    <x-rh.card-rh titulo="Listado de categorías">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Nombre</th>

                        <th>Descripción</th>

                        <th class="text-center">Estado</th>

                        <th class="text-center">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categorias as $categoria)

                        <tr>

                            <td>{{ $categoria->nombre }}</td>

                            <td>{{ $categoria->descripcion }}</td>

                            <td class="text-center">

                                @if($categoria->estado == 'activo')

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

                                <div class="d-flex justify-content-center gap-2">

                                    <a
                                        href="{{ route('administracion.categorias.edit', $categoria) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route('administracion.categorias.destroy', $categoria) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm {{ $categoria->estado == 'activo' ? 'btn-danger' : 'btn-success' }}"
                                            onclick="return confirm('¿Desea {{ $categoria->estado == 'activo' ? 'desactivar' : 'activar' }} esta categoría?')"
                                        >

                                            {{ $categoria->estado == 'activo' ? 'Desactivar' : 'Activar' }}

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                No hay categorías registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $categorias->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
