@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-2">

        ADMINISTRACIÓN DE PRODUCTOS

    </h1>

    <p class="text-muted">

        Total de productos registrados:

        <strong>{{ $totalProductos }}</strong>

    </p>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.productos.create') }}"
            class="btn btn-primary"
        >

            Nuevo producto

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar producto">

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

    <x-rh.card-rh titulo="Listado de productos">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Código</th>

                        <th>Producto</th>

                        <th>Categoría</th>

                        <th class="text-center">

                            Stock

                        </th>

                        <th class="text-center">

                            Estado

                        </th>

                        <th class="text-center">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($productos as $producto)

                        <tr>

                            <td>

                                {{ $producto->codigo }}

                            </td>

                            <td>

                                {{ $producto->nombre }}

                            </td>

                            <td>

                                {{ $producto->categoria->nombre }}

                            </td>

                            <td class="text-center">

                                {{ $producto->stock_actual }}

                            </td>

                            <td class="text-center">

                                @if($producto->estado == 'activo')

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
                                        href="{{ route('administracion.productos.edit', $producto) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route('administracion.productos.destroy', $producto) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm {{ $producto->estado == 'activo' ? 'btn-danger' : 'btn-success' }}"
                                            onclick="return confirm('¿Desea {{ $producto->estado == 'activo' ? 'desactivar' : 'activar' }} este producto?')"
                                        >

                                            {{ $producto->estado == 'activo' ? 'Desactivar' : 'Activar' }}

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center"
                            >

                                No hay productos registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $productos->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
