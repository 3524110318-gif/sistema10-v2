@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-check me-2"></i>

                Contratos Comerciales

            </h2>

            <p class="gtri-page-subtitle">

                Consulta, administra y da seguimiento a los contratos comerciales registrados.

            </p>

        </div>

        <a
            href="{{ route('comercial.contratos.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo Contrato

        </a>

    </div>


    <!-- 01 · BUSCADOR -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar contratos

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
                            href="{{ route('comercial.contratos.index') }}"
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

                Listado de contratos

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $contratos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Folio</th>

                            <th>Cliente</th>

                            <th>Inicio</th>

                            <th>Fin</th>

                            <th>Tarifa</th>

                            <th class="text-center">Plazas</th>

                            <th class="text-center">Estado</th>

                            <th class="text-center">Alerta</th>

                            <th width="140">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($contratos as $contrato)

                            <tr>

                                <td>

                                    <span class="fw-semibold text-light">

                                        {{ $contrato->folio }}

                                    </span>

                                </td>

                                <td>

                                    <i class="bi bi-building me-1 text-secondary"></i>

                                    {{ $contrato->cliente->razon_social }}

                                </td>

                                <td>

                                    <i class="bi bi-calendar-event me-1 text-secondary"></i>

                                    {{ $contrato->fecha_inicio->format('d/m/Y') }}

                                </td>

                                <td>

                                    <i class="bi bi-calendar-check me-1 text-secondary"></i>

                                    {{ $contrato->fecha_fin->format('d/m/Y') }}

                                </td>

                                <td>

                                    <span class="fw-semibold">

                                        $ {{ number_format($contrato->tarifa, 2) }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-secondary">

                                        {{ $contrato->numero_plazas }}

                                    </span>

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

                                            <i class="bi bi-exclamation-triangle me-1"></i>

                                            Renovar

                                        </span>

                                    @else

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Vigente

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-2 flex-nowrap">

                                        <a
                                            href="{{ route('comercial.contratos.edit', $contrato) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Editar contrato"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form
                                            action="{{ route('comercial.contratos.destroy', $contrato) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar contrato"
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
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-file-earmark-x fs-1 text-secondary d-block mb-3"></i>

                                    <h5 class="text-light mb-2">

                                        No existen contratos registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo contrato para comenzar su gestión comercial.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if(method_exists($contratos, 'hasPages') && $contratos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $contratos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection