@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-folder2-open me-2"></i>

                Expedientes REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Administración y seguimiento del cumplimiento documental de los empleados.

            </p>

        </div>

        <a
            href="{{ route('expedientes.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo Expediente

        </a>

    </div>


    <!-- MENSAJE DE ÉXITO -->

    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    <!-- 01 · BUSCADOR -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar expedientes

        </div>

        <form
            method="GET"
            action="{{ route('expedientes.index') }}"
            class="row g-3 align-items-end"
        >

            <div class="col-lg-8 col-md-7">

                <label
                    for="buscar"
                    class="form-label"
                >

                    Empleado

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-dark border-secondary text-warning">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        id="buscar"
                        name="buscar"
                        value="{{ request('buscar') }}"
                        class="form-control gtri-input"
                        placeholder="Buscar empleado..."
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
                            href="{{ route('expedientes.index') }}"
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

                Listado de expedientes

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $repses->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th class="text-center">IMSS</th>

                            <th class="text-center">Contrato</th>

                            <th class="text-center">SSP</th>

                            <th class="text-center">SAT</th>

                            <th class="text-center">Estado</th>

                            <th class="text-center">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($repses as $repse)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        <i class="bi bi-person-badge me-2 text-secondary"></i>

                                        {{ $repse->empleado->nombre }}

                                    </div>

                                </td>


                                <!-- IMSS -->

                                <td class="text-center">

                                    @if($repse->alta_imss)

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-lg"></i>

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-lg"></i>

                                        </span>

                                    @endif

                                </td>


                                <!-- CONTRATO -->

                                <td class="text-center">

                                    @if($repse->contrato_firmado)

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-lg"></i>

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-lg"></i>

                                        </span>

                                    @endif

                                </td>


                                <!-- SSP -->

                                <td class="text-center">

                                    @if($repse->cedula_ssp)

                                        @php

                                            $estadoVigencia = $repse->estadoVigenciaCedula();

                                            $diasRestantes = $repse->diasParaVencerCedula();

                                        @endphp

                                        @if($estadoVigencia === 'vigente')

                                            <div>

                                                <span class="badge bg-success">

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Vigente

                                                </span>

                                                <small class="d-block text-secondary mt-1">

                                                    {{ $diasRestantes }} días restantes

                                                </small>

                                            </div>

                                        @elseif($estadoVigencia === 'por_vencer')

                                            <div>

                                                <span class="badge bg-warning text-dark">

                                                    <i class="bi bi-exclamation-triangle me-1"></i>

                                                    Por vencer

                                                </span>

                                                <small class="d-block text-warning mt-1">

                                                    {{ $diasRestantes }} días restantes

                                                </small>

                                            </div>

                                        @elseif($estadoVigencia === 'vencida')

                                            <div>

                                                <span class="badge bg-danger">

                                                    <i class="bi bi-x-circle me-1"></i>

                                                    Vencida

                                                </span>

                                                <small class="d-block text-danger mt-1">

                                                    Venció hace {{ abs($diasRestantes) }} días

                                                </small>

                                            </div>

                                        @else

                                            <span class="badge bg-secondary">

                                                Sin vigencia

                                            </span>

                                        @endif

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-lg me-1"></i>

                                            No entregado

                                        </span>

                                    @endif

                                </td>


                                <!-- SAT -->

                                <td class="text-center">

                                    @if($repse->constancia_fiscal)

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-lg"></i>

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-x-lg"></i>

                                        </span>

                                    @endif

                                </td>


                                <!-- ESTADO -->

                                <td class="text-center">

                                    @if($repse->estatus === 'cumple')

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Cumple

                                        </span>

                                    @elseif($repse->estatus === 'pendiente')

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-exclamation-circle me-1"></i>

                                            Pendiente

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-lock me-1"></i>

                                            Bloqueado

                                        </span>

                                    @endif

                                </td>


                                <!-- ACCIONES -->

                                <td>

                                    <div class="d-flex justify-content-center gap-2 flex-nowrap">

                                        <a
                                            href="{{ route('expedientes.show', $repse) }}"
                                            class="btn btn-info btn-sm text-white"
                                            title="Ver expediente"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                        <form
                                            action="{{ route('expedientes.destroy', $repse) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Está seguro de eliminar este expediente?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar expediente"
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

                                    <i class="bi bi-folder-x fs-1 text-secondary d-block mb-3"></i>

                                    <h5 class="text-light mb-2">

                                        No existen expedientes registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo expediente para comenzar el seguimiento REPSE.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($repses->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $repses->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection