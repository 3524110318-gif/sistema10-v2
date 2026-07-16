@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Cobranza

        </h2>

        <a
            href="{{ route('administracion.cobranzas.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nueva cobranza

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
                placeholder="Buscar por folio..."
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

    <x-rh.card-rh titulo="Listado de cobranzas">

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover align-middle"
            >

                <thead class="table-dark">

                    <tr>

                        <th>

                            Factura

                        </th>

                        <th>

                            Cliente

                        </th>

                        <th>

                            Vencimiento

                        </th>

                        <th>

                            Monto

                        </th>

                        <th>

                            Estado

                        </th>

                        <th>

                            Semáforo

                        </th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($cobranzas as $cobranza)

                        <tr>

                            <td>

                                {{ $cobranza->factura->folio }}

                            </td>

                            <td>

                                {{ $cobranza->factura->cliente->razon_social }}

                            </td>

                            <td>

                                {{ $cobranza->fecha_vencimiento->format('d/m/Y') }}

                            </td>

                            <td>

                                $ {{ number_format($cobranza->monto,2) }}

                            </td>

                            <td>

                                {{ ucfirst($cobranza->estado) }}

                            </td>

                            <td>

                                @switch($cobranza->semaforo)

                                    @case('azul')

                                        <span class="badge bg-primary">

                                            Azul

                                        </span>

                                    @break

                                    @case('amarillo')

                                        <span class="badge bg-warning text-dark">

                                            Amarillo

                                        </span>

                                    @break

                                    @case('rojo')

                                        <span class="badge bg-danger">

                                            Rojo

                                        </span>

                                    @break

                                    @case('verde')

                                        <span class="badge bg-success">

                                            Verde

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('administracion.cobranzas.show',$cobranza) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('administracion.cobranzas.edit',$cobranza) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('administracion.cobranzas.destroy',$cobranza) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar esta cobranza?')"
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

                                No existen registros.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $cobranzas->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
