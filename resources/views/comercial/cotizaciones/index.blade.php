@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Cotizaciones

        </h2>

        <a
            href="{{ route('comercial.cotizaciones.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nueva Cotización

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

    <x-rh.card-rh titulo="Listado de Cotizaciones">

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover align-middle"
            >

                <thead class="table-dark">

                    <tr>

                        <th>Folio</th>

                        <th>Prospecto</th>

                        <th>Fecha</th>

                        <th>Monto</th>

                        <th>Plazas</th>

                        <th>Estatus</th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($cotizaciones as $cotizacion)

                        <tr>

                            <td>

                                {{ $cotizacion->folio }}

                            </td>

                            <td>

                                {{ $cotizacion->prospecto->razon_social }}

                            </td>

                            <td>

                                {{ $cotizacion->fecha->format('d/m/Y') }}

                            </td>

                            <td>

                                $ {{ number_format($cotizacion->monto,2) }}

                            </td>

                            <td class="text-center">

                                {{ $cotizacion->numero_plazas }}

                            </td>

                            <td class="text-center">

                                @switch($cotizacion->estatus)

                                    @case('pendiente')

                                        <span class="badge bg-warning text-dark">

                                            Pendiente

                                        </span>

                                    @break

                                    @case('aceptada')

                                        <span class="badge bg-success">

                                            Aceptada

                                        </span>

                                    @break

                                    @case('rechazada')

                                        <span class="badge bg-danger">

                                            Rechazada

                                        </span>

                                    @break

                                    @case('cancelada')

                                        <span class="badge bg-secondary">

                                            Cancelada

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('comercial.cotizaciones.edit',$cotizacion) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('comercial.cotizaciones.destroy',$cotizacion) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar esta cotización?')"
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

                                No existen cotizaciones registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $cotizaciones->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection