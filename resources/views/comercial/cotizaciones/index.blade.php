@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-text me-2"></i>

                Cotizaciones

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra las propuestas comerciales generadas para los prospectos.

            </p>

        </div>

        <a
            href="{{ route('comercial.cotizaciones.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva Cotización

        </a>

    </div>


    <!-- 01 · BUSCADOR -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar cotizaciones

        </div>

        <form
            method="GET"
            class="row g-3 align-items-end"
        >

            <div class="col-lg-8 col-md-7">

                <label
                    for="buscar"
                    class="form-label"
                >

                    Buscar

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-dark border-secondary text-warning">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        id="buscar"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por folio..."
                        value="{{ request('buscar') }}"
                    >

                </div>

            </div>

            <div class="col-lg-4 col-md-5">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary flex-grow-1"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                    @if(request('buscar'))

                        <a
                            href="{{ route('comercial.cotizaciones.index') }}"
                            class="btn gtri-btn-secondary"
                            title="Limpiar búsqueda"
                        >

                            <i class="bi bi-x-lg"></i>

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    <!-- 02 · LISTADO -->

    <div class="gtri-section mb-0">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div class="gtri-section-title mb-0">

                <span>02</span>

                Listado de cotizaciones

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $cotizaciones->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Folio</th>

                            <th>Prospecto</th>

                            <th>Fecha</th>

                            <th>Monto</th>

                            <th class="text-center">Plazas</th>

                            <th class="text-center">Estatus</th>

                            <th width="140">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($cotizaciones as $cotizacion)

                            <tr>

                                <td>

                                    <span class="fw-semibold text-light">

                                        {{ $cotizacion->folio }}

                                    </span>

                                </td>

                                <td>

                                    <i class="bi bi-building me-1 text-secondary"></i>

                                    {{ $cotizacion->prospecto->razon_social }}

                                </td>

                                <td>

                                    <i class="bi bi-calendar-event me-1 text-secondary"></i>

                                    {{ $cotizacion->fecha->format('d/m/Y') }}

                                </td>

                                <td>

                                    <span class="fw-semibold">

                                        $ {{ number_format($cotizacion->monto, 2) }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-secondary">

                                        {{ $cotizacion->numero_plazas }}

                                    </span>

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

                                    <div class="d-flex gap-2 flex-nowrap">

                                        <a
                                            href="{{ route('comercial.cotizaciones.edit', $cotizacion) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Editar cotización"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form
                                            action="{{ route('comercial.cotizaciones.destroy', $cotizacion) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar cotización"
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
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-file-earmark-x fs-1 text-secondary d-block mb-3"></i>

                                    <h5 class="text-light mb-2">

                                        No existen cotizaciones registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Genera una nueva cotización para comenzar a gestionar propuestas comerciales.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- PAGINACIÓN -->

        @if(method_exists($cotizaciones, 'hasPages') && $cotizaciones->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $cotizaciones->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection