@extends('comercial.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Prospectos Comerciales

        </h2>

        <a
            href="{{ route('comercial.prospectos.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nuevo Prospecto

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

    <x-rh.card-rh titulo="Listado de Prospectos">

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover align-middle"
            >

                <thead class="table-dark">

                    <tr>

                        <th>Razón Social</th>

                        <th>Contacto</th>

                        <th>Teléfono</th>

                        <th>Correo</th>

                        <th>Tarifa</th>

                        <th>Plazas</th>

                        <th>Estatus</th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($prospectos as $prospecto)

                        <tr>

                            <td>

                                {{ $prospecto->razon_social }}

                            </td>

                            <td>

                                {{ $prospecto->contacto }}

                            </td>

                            <td>

                                {{ $prospecto->telefono }}

                            </td>

                            <td>

                                {{ $prospecto->correo }}

                            </td>

                            <td>

                                $ {{ number_format($prospecto->tarifa,2) }}

                            </td>

                            <td class="text-center">

                                {{ $prospecto->numero_plazas }}

                            </td>

                            <td class="text-center">

                                @switch($prospecto->estatus)

                                    @case('nuevo')

                                        <span class="badge bg-primary">

                                            Nuevo

                                        </span>

                                    @break

                                    @case('seguimiento')

                                        <span class="badge bg-warning text-dark">

                                            Seguimiento

                                        </span>

                                    @break

                                    @case('cotizacion')

                                        <span class="badge bg-info text-dark">

                                            Cotización

                                        </span>

                                    @break

                                    @case('ganado')

                                        <span class="badge bg-success">

                                            Ganado

                                        </span>

                                    @break

                                    @case('perdido')

                                        <span class="badge bg-danger">

                                            Perdido

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('comercial.prospectos.edit',$prospecto) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('comercial.prospectos.destroy',$prospecto) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este prospecto?')"
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
                                colspan="8"
                                class="text-center"
                            >

                                No existen prospectos comerciales.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $prospectos->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection