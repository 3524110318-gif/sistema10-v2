@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-circle me-1"></i>

            {{ session('error') }}

        </div>

    @endif


    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-text me-2"></i>

                Contratos

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra los contratos de los clientes.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.contratos.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-file-earmark-plus me-1"></i>

            Nuevo contrato

        </a>

    </div>


    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar contratos

        </div>


        <form
            method="GET"
            action="{{ route(
                'operaciones.contratos.index'
            ) }}"
        >

            <div class="row g-3 align-items-end">

                <div class="col-lg-7">

                    <label
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Buscar

                    </label>


                    <input
                        type="text"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por cliente o número de contrato..."
                        value="{{ $buscar }}"
                    >

                </div>


                <div class="col-lg-2 col-md-6">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary w-100"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                </div>


                <div class="col-lg-2 col-md-6">

                    <a
                        href="{{ route(
                            'operaciones.contratos.index'
                        ) }}"
                        class="btn gtri-btn-secondary w-100"
                    >

                        <i class="bi bi-arrow-counterclockwise me-1"></i>

                        Limpiar

                    </a>

                </div>

            </div>

        </form>

    </div>


    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>02</span>

                Lista de contratos

            </div>


            <div>

                <span class="text-secondary">

                    Registros en esta página:

                </span>

                <span class="text-warning fw-bold">

                    {{ $contratos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:24%">

                        <col style="width:18%">

                        <col style="width:13%">

                        <col style="width:13%">

                        <col style="width:12%">

                        <col style="width:20%">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>Cliente</th>

                            <th>Contrato</th>

                            <th>Inicio</th>

                            <th>Fin</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($contratos as $contrato)

                            <tr>

                                <td>

                                    <span class="text-light fw-semibold">

                                        {{ $contrato->cliente->razon_social }}

                                    </span>

                                </td>


                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $contrato->numero_contrato }}

                                    </span>

                                </td>


                                <td class="text-secondary">

                                    {{ $contrato->fecha_inicio }}

                                </td>


                                <td class="text-secondary">

                                    {{ $contrato->fecha_fin ?: 'Sin definir' }}

                                </td>


                                <td>

                                    @switch($contrato->estado)

                                        @case('activo')

                                            <span class="badge bg-success">

                                                Activo

                                            </span>

                                            @break


                                        @case('vencido')

                                            <span class="badge bg-warning text-dark">

                                                Vencido

                                            </span>

                                            @break


                                        @case('cancelado')

                                            <span class="badge bg-danger">

                                                Cancelado

                                            </span>

                                            @break


                                        @default

                                            <span class="badge bg-secondary">

                                                Borrador

                                            </span>

                                    @endswitch

                                </td>


                                <td class="text-center">

                                    <div
                                        class="
                                            d-flex
                                            justify-content-center
                                            gap-2
                                            flex-nowrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'operaciones.contratos.show',
                                                $contrato
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver contrato"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>
                                        
                                        <form
                                            action="{{ route(
                                                'operaciones.contratos.destroy',
                                                $contrato
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                '¿Desea eliminar este contrato?'
                                            )"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar contrato"
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
                                    colspan="6"
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

                                        No existen contratos registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo contrato para comenzar.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($contratos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $contratos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection