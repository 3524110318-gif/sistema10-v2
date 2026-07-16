@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        FACTURACIÓN

    </h1>

    <div class="d-flex justify-content-between mb-4">

        <a
            href="{{ route('administracion.facturas.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva factura

        </a>

        <form
            method="GET"
            class="d-flex"
        >

            <input
                type="text"
                name="buscar"
                class="form-control me-2"
                placeholder="Buscar por folio o cliente..."
                value="{{ request('buscar') }}"
            >

            <button
                class="btn btn-outline-primary"
            >

                Buscar

            </button>

        </form>

    </div>

    <x-rh.card-rh titulo="Listado de facturas">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Folio</th>

                        <th>Cliente</th>

                        <th>Contrato</th>

                        <th>Fecha</th>

                        <th>Total</th>

                        <th>Estado</th>

                        <th width="220">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($facturas as $factura)

                        <tr>

                            <td>

                                {{ $factura->folio }}

                            </td>

                            <td>

                                {{ $factura->cliente->razon_social }}

                            </td>

                            <td>

                                {{ $factura->contrato->numero_contrato }}

                            </td>

                            <td>

                                {{ $factura->fecha_factura->format('d/m/Y') }}

                            </td>

                            <td>

                                $ {{ number_format($factura->total,2) }}

                            </td>

                            <td>

                                @switch($factura->estado)

                                    @case('borrador')

                                        <span class="badge bg-warning">

                                            Borrador

                                        </span>

                                    @break

                                    @case('emitida')

                                        <span class="badge bg-success">

                                            Emitida

                                        </span>

                                    @break

                                    @case('cancelada')

                                        <span class="badge bg-danger">

                                            Cancelada

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('administracion.facturas.show',$factura) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('administracion.facturas.edit',$factura) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    @if($factura->estado!='cancelada')

                                        <form
                                            action="{{ route('administracion.facturas.destroy',$factura) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Cancelar esta factura?')"
                                            >

                                                <i class="bi bi-x-circle"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center"
                            >

                                No existen facturas registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $facturas->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
