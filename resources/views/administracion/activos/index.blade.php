@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-pc-display me-2"></i>

                    Activos

                </h2>

                <p class="gtri-page-subtitle">

                    Control y seguimiento de los activos registrados en GTRI.

                </p>

            </div>

            <a
                href="{{ route('administracion.activos.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nuevo activo

            </a>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Filtros de búsqueda

        </div>

        <form method="GET">

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label class="gtri-label mb-2">

                        Código del activo

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar por código..."
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
                            href="{{ route('administracion.activos.index') }}"
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

            Listado de activos

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Código</th>

                            <th>Producto</th>

                            <th>Marca</th>

                            <th>Modelo</th>

                            <th class="text-center">
                                Estado
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($activos as $activo)

                            <tr>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $activo->codigo_activo }}

                                    </span>

                                </td>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $activo->producto->nombre }}

                                    </div>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $activo->marca ?? '-' }}

                                    </span>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $activo->modelo ?? '-' }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    @switch($activo->estado)

                                        @case('disponible')

                                            <span class="badge gtri-badge-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Disponible

                                            </span>

                                            @break


                                        @case('asignado')

                                            <span class="badge bg-primary">

                                                <i class="bi bi-person-check me-1"></i>

                                                Asignado

                                            </span>

                                            @break


                                        @case('mantenimiento')

                                            <span class="badge gtri-badge-warning">

                                                <i class="bi bi-tools me-1"></i>

                                                Mantenimiento

                                            </span>

                                            @break


                                        @default

                                            <span class="badge gtri-badge-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Baja

                                            </span>

                                    @endswitch

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.activos.show',
                                                $activo
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a
                                            href="{{ route(
                                                'administracion.activos.edit',
                                                $activo
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar activo"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'administracion.activos.destroy',
                                                $activo
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm
                                                {{ $activo->estado == 'baja'
                                                    ? 'btn-outline-success'
                                                    : 'btn-outline-danger'
                                                }}"
                                                onclick="return confirm(
                                                    '¿Desea cambiar el estado del activo?'
                                                )"
                                                title="{{ $activo->estado == 'baja'
                                                    ? 'Activar'
                                                    : 'Dar de baja'
                                                }}"
                                            >

                                                @if($activo->estado == 'baja')

                                                    <i class="bi bi-check-lg"></i>

                                                @else

                                                    <i class="bi bi-power"></i>

                                                @endif

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-pc-display fs-1 d-block mb-3"
                                        ></i>

                                        No hay activos registrados.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($activos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $activos->links() }}

            </div>

        @endif

    </div>

</div>

@endsection