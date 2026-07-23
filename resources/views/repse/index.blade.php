@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h4 class="fw-bold mb-1">

                <i class="bi bi-folder2-open me-2"></i>

                Expedientes REPSE

            </h4>

            <p class="text-muted mb-0">

                Administración y seguimiento de expedientes REPSE.

            </p>

        </div>

        <a
            href="{{ route('expedientes.create') }}"
            class="btn btn-primary"
        >

            <i class="bi bi-plus-circle"></i>

            Nuevo expediente

        </a>

    </div>


    {{-- CARD PRINCIPAL --}}
    <x-rh.card-rh titulo="Listado de expedientes">

        {{-- BUSCADOR --}}
        <form
            method="GET"
            action="{{ route('expedientes.index') }}"
            class="mb-4"
        >

            <div class="row g-2">

                <div class="col-md-10">

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            class="form-control"
                            placeholder="Buscar empleado..."
                        >

                    </div>

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Buscar

                    </button>

                </div>

            </div>

        </form>


        {{-- MENSAJE DE ÉXITO --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-1"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- TABLA --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>
                            Empleado
                        </th>

                        <th class="text-center">
                            IMSS
                        </th>

                        <th class="text-center">
                            Contrato
                        </th>

                        <th class="text-center">
                            SSP
                        </th>

                        <th class="text-center">
                            SAT
                        </th>

                        <th class="text-center">
                            Estado
                        </th>

                        <th class="text-center">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($repses as $repse)

                        <tr>

                            {{-- EMPLEADO --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $repse->empleado->nombre }}

                                </div>

                            </td>


                            {{-- IMSS --}}
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


                            {{-- CONTRATO --}}
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


                            {{-- SSP --}}
                            <td class="text-center">

                                @if($repse->cedula_ssp)

                                    @php
                                        $estadoVigencia = $repse->estadoVigenciaCedula();
                                        $diasRestantes = $repse->diasParaVencerCedula();
                                    @endphp

                                    @if($estadoVigencia === 'vigente')

                                        <div>

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle"></i>

                                                Vigente

                                            </span>

                                            <small class="d-block text-muted mt-1">

                                                {{ $diasRestantes }} días restantes

                                            </small>

                                        </div>

                                    @elseif($estadoVigencia === 'por_vencer')

                                        <div>

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-exclamation-triangle"></i>

                                                Por vencer

                                            </span>

                                            <small class="d-block text-warning mt-1">

                                                {{ $diasRestantes }} días restantes

                                            </small>

                                        </div>

                                    @elseif($estadoVigencia === 'vencida')

                                        <div>

                                            <span class="badge bg-danger">

                                                <i class="bi bi-x-circle"></i>

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

                                        <i class="bi bi-x-lg"></i>

                                        No entregado

                                    </span>

                                @endif

                            </td>


                            {{-- SAT --}}
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


                            {{-- ESTADO --}}
                            <td class="text-center">

                                @if($repse->estatus === 'cumple')

                                    <span class="badge bg-success">

                                        Cumple

                                    </span>

                                @elseif($repse->estatus === 'pendiente')

                                    <span class="badge bg-warning text-dark">

                                        Pendiente

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Bloqueado

                                    </span>

                                @endif

                            </td>


                            {{-- ACCIONES --}}
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-1">

                                    {{-- VER --}}
                                    <a
                                        href="{{ route('expedientes.show', $repse) }}"
                                        class="btn btn-sm btn-info text-white"
                                        title="Ver expediente"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- EDITAR --}}
                                    <a
                                        href="{{ route('expedientes.edit', $repse) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Editar expediente"
                                    >

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- ELIMINAR --}}
                                    <form
                                        action="{{ route('expedientes.destroy', $repse) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Está seguro de eliminar este expediente?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
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
                                class="text-center py-4 text-muted"
                            >

                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                No existen expedientes registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINACIÓN --}}
        @if($repses->hasPages())

            <div class="mt-3">

                {{ $repses->links() }}

            </div>

        @endif

    </x-rh.card-rh>

</div>

@endsection