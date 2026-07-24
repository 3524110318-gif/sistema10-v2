@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-calculator me-2"></i>

                    Prenóminas

                </h2>

                <p class="gtri-page-subtitle">

                    Gestión de periodos, empleados, ajustes y cálculo
                    de prenómina.

                </p>

            </div>

            <a
                href="{{ route('administracion.prenominas.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva Prenómina

            </a>

        </div>

    </div>


    {{-- FILTROS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Filtros de búsqueda

        </div>

        <form method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label class="gtri-label mb-2">

                        Estatus

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por estatus..."
                        value="{{ request('buscar') }}"
                    >

                </div>

                <div class="col-auto">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                </div>

                @if(request('buscar'))

                    <div class="col-auto">

                        <a
                            href="{{ route('administracion.prenominas.index') }}"
                            class="btn gtri-btn-secondary"
                        >

                            <i class="bi bi-arrow-clockwise me-1"></i>

                            Limpiar

                        </a>

                    </div>

                @endif

            </div>

        </form>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Listado de Prenóminas

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Periodo</th>

                            <th class="text-center">
                                Empleados
                            </th>

                            <th>Total Nómina</th>

                            <th class="text-center">
                                Estatus
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($prenominas as $prenomina)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $prenomina->periodo_inicio->format('d/m/Y') }}

                                        -

                                        {{ $prenomina->periodo_fin->format('d/m/Y') }}

                                    </div>

                                </td>


                                <td class="text-center">

                                    <span class="text-secondary">

                                        {{ $prenomina->total_empleados }}

                                    </span>

                                </td>


                                <td>

                                    <span class="text-warning fw-bold">

                                        ${{ number_format(
                                            $prenomina->total_nomina,
                                            2
                                        ) }}

                                    </span>

                                </td>


                                <td class="text-center">

                                    @switch($prenomina->estatus)

                                        @case('abierta')

                                            <span class="badge bg-primary">

                                                <i class="bi bi-folder2-open me-1"></i>

                                                Abierta

                                            </span>

                                            @break


                                        @case('cerrada')

                                            <span class="badge gtri-badge-warning">

                                                <i class="bi bi-lock me-1"></i>

                                                Cerrada

                                            </span>

                                            @break


                                        @case('autorizada')

                                            <span class="badge gtri-badge-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Autorizada

                                            </span>

                                            @break

                                    @endswitch

                                </td>


                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.prenominas.show',
                                                $prenomina
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a
                                            href="{{ route(
                                                'administracion.prenominas.edit',
                                                $prenomina
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar Prenómina"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'administracion.prenominas.destroy',
                                                $prenomina
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm(
                                                    '¿Eliminar esta prenómina?'
                                                )"
                                                title="Eliminar Prenómina"
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
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-calculator fs-1 d-block mb-3"
                                        ></i>

                                        No existen prenóminas registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($prenominas->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $prenominas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection