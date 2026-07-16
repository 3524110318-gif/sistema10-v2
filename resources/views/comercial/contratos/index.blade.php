@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Contratos Comerciales

        </h2>

        <a
            href="{{ route('comercial.contratos.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nuevo Contrato

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

    <x-rh.card-rh titulo="Listado de Contratos">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Folio</th>

                        <th>Cliente</th>

                        <th>Inicio</th>

                        <th>Fin</th>

                        <th>Tarifa</th>

                        <th>Plazas</th>

                        <th>Estado</th>

                        <th>Alerta</th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($contratos as $contrato)

                        <tr>

                            <td>

                                {{ $contrato->folio }}

                            </td>

                            <td>

                                {{ $contrato->cliente->razon_social }}

                            </td>

                            <td>

                                {{ $contrato->fecha_inicio->format('d/m/Y') }}

                            </td>

                            <td>

                                {{ $contrato->fecha_fin->format('d/m/Y') }}

                            </td>

                            <td>

                                $ {{ number_format($contrato->tarifa,2) }}

                            </td>

                            <td class="text-center">

                                {{ $contrato->numero_plazas }}

                            </td>

                            <td class="text-center">

                                @switch($contrato->estado)

                                    @case('borrador')

                                        <span class="badge bg-secondary">

                                            Borrador

                                        </span>

                                    @break

                                    @case('pendiente')

                                        <span class="badge bg-warning text-dark">

                                            Pendiente

                                        </span>

                                    @break

                                    @case('activo')

                                        <span class="badge bg-success">

                                            Activo

                                        </span>

                                    @break

                                    @case('finalizado')

                                        <span class="badge bg-primary">

                                            Finalizado

                                        </span>

                                    @break

                                    @case('cancelado')

                                        <span class="badge bg-danger">

                                            Cancelado

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td class="text-center">

                            @if($contrato->renovacion_proxima)

                                <span class="badge bg-danger">

                                    Renovar

                                </span>

                            @else

                                <span class="badge bg-success">

                                    Vigente

                                </span>

                            @endif

                        </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('comercial.contratos.edit',$contrato) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('comercial.contratos.destroy',$contrato) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este contrato?')"
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
                                colspan="9"
                                class="text-center"
                            >

                                No existen contratos registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $contratos->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection