@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-person-check me-2"></i>

                    Asignación de activos

                </h2>

                <p class="gtri-page-subtitle">

                    Control de activos entregados a empleados y servicios.

                </p>

            </div>

            <a
                href="{{ route('administracion.asignaciones-activos.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva asignación

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
                            href="{{ route('administracion.asignaciones-activos.index') }}"
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

            Listado de asignaciones

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Activo</th>

                            <th>Empleado</th>

                            <th>Servicio</th>

                            <th>Fecha entrega</th>

                            <th class="text-center">
                                Estado
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($asignaciones as $asignacion)

                            <tr>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $asignacion->activo->codigo_activo }}

                                    </span>

                                </td>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $asignacion->empleado->nombre }}
                                        {{ $asignacion->empleado->apellido_paterno }}

                                    </div>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $asignacion->servicio->nombre ?? 'Sin servicio' }}

                                    </span>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $asignacion->fecha_entrega->format('d/m/Y') }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    @if($asignacion->estado == 'activa')

                                        <span class="badge gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Activa

                                        </span>

                                    @else

                                        <span class="badge gtri-badge-warning">

                                            <i class="bi bi-arrow-return-left me-1"></i>

                                            Devuelta

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.asignaciones-activos.show',
                                                $asignacion
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <a
                                            href="{{ route(
                                                'administracion.asignaciones-activos.edit',
                                                $asignacion
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar asignación"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        @if($asignacion->estado == 'activa')

                                            <form
                                                action="{{ route(
                                                    'administracion.asignaciones-activos.destroy',
                                                    $asignacion
                                                ) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm(
                                                        '¿Registrar devolución del activo?'
                                                    )"
                                                    title="Registrar devolución"
                                                >

                                                    <i class="bi bi-arrow-return-left"></i>

                                                </button>

                                            </form>

                                        @endif

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
                                            class="bi bi-person-check fs-1 d-block mb-3"
                                        ></i>

                                        No hay asignaciones registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($asignaciones->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $asignaciones->links() }}

            </div>

        @endif

    </div>

</div>

@endsection