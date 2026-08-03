@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />

    <x-rh.alert-errors />


    {{-- ENCABEZADO --}}
    <div class="gtri-page-header gtri-expediente-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-text me-2"></i>

                Contratos laborales

            </h2>

            <p class="gtri-page-subtitle">

                Consulta, registra y controla la vigencia de los contratos del personal.

            </p>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('rh.contratos.create') }}"
                class="btn gtri-btn-primary"
            >

                <i class="bi bi-file-earmark-plus me-1"></i>

                Nuevo contrato

            </a>

        </div>

    </div>


    {{-- BUSCADOR --}}
    <form
        method="GET"
        action="{{ route('rh.contratos.index') }}"
        class="mb-4"
    >

        <div class="row g-3 align-items-end">

            <div class="col-lg-5 col-md-7">

                <label
                    for="buscar"
                    class="form-label text-light fw-semibold"
                >

                    Buscar contrato

                </label>

                <input
                    type="text"
                    name="buscar"
                    id="buscar"
                    class="form-control gtri-input"
                    value="{{ request('buscar') }}"
                    placeholder="Número de contrato, empleado o No. de control"
                >

            </div>


            <div class="col-lg-4">

                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>


                    @if (request('buscar'))

                        <a
                            href="{{ route('rh.contratos.index') }}"
                            class="btn gtri-btn-secondary"
                        >

                            <i class="bi bi-x-circle me-1"></i>

                            Limpiar

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </form>


    {{-- LISTADO --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de contratos

            </div>


            <div>

                <span class="text-secondary">

                    Registros mostrados:

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

                            <th>No. de contrato</th>

                            <th>Empleado</th>

                            <th class="text-center">Estado</th>

                            <th class="text-center">Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($contratos as $contrato)

                            <tr>

                                {{-- NÚMERO DE CONTRATO --}}
                                <td>

                                    <span class="text-warning fw-bold">

                                        {{ $contrato->numero_contrato }}

                                    </span>

                                </td>


                                {{-- EMPLEADO --}}
                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $contrato->empleado->nombre }}

                                            {{ $contrato->empleado->apellido_paterno }}

                                            {{ $contrato->empleado->apellido_materno }}

                                        </span>

                                        <small class="text-secondary">

                                            {{ $contrato->empleado->numero_control }}

                                        </small>

                                    </div>

                                </td>

                                {{-- ESTADO --}}
                                <td class="text-center">

                                    @if ($contrato->estado === 'vigente')

                                        <span class="gtri-badge-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Vigente

                                        </span>

                                    @elseif ($contrato->estado === 'vencido')

                                        <span class="gtri-badge-danger">

                                            <i class="bi bi-calendar-x me-1"></i>

                                            Vencido

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            <i class="bi bi-ban me-1"></i>

                                            Cancelado

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td>

                                    <div
                                        class="
                                            d-flex
                                            flex-wrap
                                            align-items-center
                                            justify-content-center
                                            gap-2
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'rh.contratos.show',
                                                $contrato->id
                                            ) }}"
                                            class="btn gtri-btn-secondary btn-sm"
                                        >

                                            <i class="bi bi-folder2-open me-1"></i>

                                            Ver

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-file-earmark-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay contratos registrados

                                    </h5>

                                    <p class="text-secondary mb-3">

                                        No se encontraron contratos laborales con los criterios indicados.

                                    </p>


                                    <a
                                        href="{{ route(
                                            'rh.contratos.create'
                                        ) }}"
                                        class="btn gtri-btn-primary"
                                    >

                                        <i class="bi bi-file-earmark-plus me-1"></i>

                                        Registrar contrato

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if ($contratos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $contratos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection