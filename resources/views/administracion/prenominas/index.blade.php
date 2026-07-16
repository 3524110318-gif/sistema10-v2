@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Prenóminas

        </h2>

        <a
            href="{{ route('administracion.prenominas.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nueva Prenómina

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
                placeholder="Buscar por estatus..."
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

    <x-rh.card-rh titulo="Listado de Prenóminas">

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover align-middle"
            >

                <thead class="table-dark">

                    <tr>

                        <th>

                            Periodo

                        </th>

                        <th>

                            Empleados

                        </th>

                        <th>

                            Total Nómina

                        </th>

                        <th>

                            Estatus

                        </th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($prenominas as $prenomina)

                        <tr>

                            <td>

                                {{ $prenomina->periodo_inicio->format('d/m/Y') }}

                                -

                                {{ $prenomina->periodo_fin->format('d/m/Y') }}

                            </td>

                            <td>

                                {{ $prenomina->total_empleados }}

                            </td>

                            <td>

                                $

                                {{ number_format($prenomina->total_nomina,2) }}

                            </td>

                            <td>

                                @switch($prenomina->estatus)

                                    @case('abierta')

                                        <span class="badge bg-primary">

                                            Abierta

                                        </span>

                                    @break

                                    @case('cerrada')

                                        <span class="badge bg-warning text-dark">

                                            Cerrada

                                        </span>

                                    @break

                                    @case('autorizada')

                                        <span class="badge bg-success">

                                            Autorizada

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('administracion.prenominas.show',$prenomina) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('administracion.prenominas.edit',$prenomina) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('administracion.prenominas.destroy',$prenomina) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar esta prenómina?')"
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
                                colspan="5"
                                class="text-center"
                            >

                                No existen prenóminas registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $prenominas->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
