@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-cash-stack me-2"></i>

                    Cobranza

                </h2>

                <p class="gtri-page-subtitle">

                    Seguimiento de pagos, vencimientos y estado de cobranzas.

                </p>

            </div>

            <a
                href="{{ route('administracion.cobranzas.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-plus-circle me-1"></i>

                Nueva cobranza

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

                        Folio de factura

                    </label>

                    <input
                        type="text"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por folio..."
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
                            href="{{ route('administracion.cobranzas.index') }}"
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

            Listado de cobranzas

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Factura</th>

                            <th>Cliente</th>

                            <th>Vencimiento</th>

                            <th>Monto</th>

                            <th class="text-center">
                                Estado
                            </th>

                            <th class="text-center">
                                Semáforo
                            </th>

                            <th class="text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($cobranzas as $cobranza)

                            <tr>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $cobranza->factura->folio }}

                                    </span>

                                </td>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $cobranza->factura->cliente->razon_social }}

                                    </div>

                                </td>

                                <td>

                                    <span class="text-secondary">

                                        {{ $cobranza->fecha_vencimiento->format('d/m/Y') }}

                                    </span>

                                </td>

                                <td>

                                    <span class="fw-semibold text-light">

                                        ${{ number_format(
                                            $cobranza->monto,
                                            2
                                        ) }}

                                    </span>

                                </td>

                                {{-- ESTADO --}}
                                <td class="text-center">

                                    @switch($cobranza->estado)

                                        @case('pendiente')

                                            <span class="badge gtri-badge-warning">

                                                <i class="bi bi-clock me-1"></i>

                                                Pendiente

                                            </span>

                                            @break


                                        @case('revision')

                                            <span class="badge bg-primary">

                                                <i class="bi bi-search me-1"></i>

                                                En revisión

                                            </span>

                                            @break


                                        @case('pagada')

                                            <span class="badge gtri-badge-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Pagada

                                            </span>

                                            @break


                                        @case('vencida')

                                            <span class="badge gtri-badge-danger">

                                                <i class="bi bi-exclamation-circle me-1"></i>

                                                Vencida

                                            </span>

                                            @break

                                    @endswitch

                                </td>


                                {{-- SEMÁFORO --}}
                                <td class="text-center">

                                    @switch($cobranza->semaforo)

                                        @case('azul')

                                            <span class="badge bg-primary">

                                                <i class="bi bi-circle-fill me-1"></i>

                                                Azul

                                            </span>

                                            @break


                                        @case('amarillo')

                                            <span class="badge gtri-badge-warning">

                                                <i class="bi bi-circle-fill me-1"></i>

                                                Amarillo

                                            </span>

                                            @break


                                        @case('rojo')

                                            <span class="badge gtri-badge-danger">

                                                <i class="bi bi-circle-fill me-1"></i>

                                                Rojo

                                            </span>

                                            @break


                                        @case('verde')

                                            <span class="badge gtri-badge-success">

                                                <i class="bi bi-circle-fill me-1"></i>

                                                Verde

                                            </span>

                                            @break

                                    @endswitch

                                </td>


                                {{-- ACCIONES --}}
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a
                                            href="{{ route(
                                                'administracion.cobranzas.show',
                                                $cobranza
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Ver detalle"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a
                                            href="{{ route(
                                                'administracion.cobranzas.edit',
                                                $cobranza
                                            ) }}"
                                            class="btn btn-sm gtri-btn-secondary"
                                            title="Editar cobranza"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        <form
                                            action="{{ route(
                                                'administracion.cobranzas.destroy',
                                                $cobranza
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm(
                                                    '¿Eliminar esta cobranza?'
                                                )"
                                                title="Eliminar"
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

                                    <div class="text-secondary">

                                        <i
                                            class="bi bi-cash-stack fs-1 d-block mb-3"
                                        ></i>

                                        No existen cobranzas registradas.

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($cobranzas->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $cobranzas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection