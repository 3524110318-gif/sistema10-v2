@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        COMPRAS

    </h1>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.compras.create') }}"
            class="btn btn-primary"
        >

            Nueva compra

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar compra">

        <form method="GET">

            <div class="row align-items-end">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Folio"
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

    <x-rh.card-rh titulo="Listado de compras">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Folio</th>

                        <th>Proveedor</th>

                        <th>Fecha</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($compras as $compra)

                        <tr>

                            <td>

                                {{ $compra->folio }}

                            </td>

                            <td>

                                {{ $compra->proveedor->razon_social }}

                            </td>

                            <td>

                                {{ $compra->fecha_compra->format('d/m/Y') }}

                            </td>

                            <td>

                                @if($compra->estado == 'pendiente')

                                    <span class="badge bg-warning text-dark">

                                        Pendiente

                                    </span>

                                @elseif($compra->estado == 'recibida')

                                    <span class="badge bg-success">

                                        Recibida

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Cancelada

                                    </span>

                                @endif

                            </td>

                            <td class="d-flex gap-2">

                                <a
                                    href="{{ route('administracion.compras.show',$compra) }}"
                                    class="btn btn-info btn-sm"
                                >

                                    Ver

                                </a>

                                <a
                                    href="{{ route('administracion.compras.edit',$compra) }}"
                                    class="btn btn-warning btn-sm"
                                >

                                    Editar

                                </a>

                                @if($compra->estado != 'cancelada')

                                    <form
                                        action="{{ route('administracion.compras.destroy',$compra) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Desea cancelar esta compra?')"
                                        >

                                            Cancelar

                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center"
                            >

                                No hay compras registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $compras->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
