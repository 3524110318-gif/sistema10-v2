@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div>

        <h1 class="gtri-page-title">

            Carpeta de Inspección Flash

        </h1>

        <p class="gtri-page-subtitle">

            Descarga inmediata de la documentación
            normativa disponible del personal activo.

        </p>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success gtri-alert">

        {{ session('success') }}

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger gtri-alert">

        {{ session('error') }}

    </div>

@endif

@if($totalArchivos === 0)

    <div class="alert alert-warning gtri-alert">

        <i class="bi bi-exclamation-triangle me-2"></i>

        No existen documentos físicos disponibles
        del personal activo para generar la Carpeta Flash.

    </div>

@endif

<div class="gtri-card mb-4">

    <form
        method="GET"
        action="{{ route('gerencia.carpeta-flash.index') }}"
    >

        <div class="row g-3">

            <div class="col-md-5">

                <label class="gtri-label">

                    Cliente

                </label>

                <select
                    name="cliente_id"
                    class="form-select gtri-select"
                >

                    <option value="">

                        Todos

                    </option>

                    @foreach($clientes as $cliente)

                        <option
                            value="{{ $cliente->id }}"
                            @selected(
                                request('cliente_id') == $cliente->id
                            )
                        >

                            {{ $cliente->razon_social }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-5">

                <label class="gtri-label">

                    Periodo

                </label>

                <select
                    name="periodo"
                    class="form-select gtri-select"
                >

                    <option value="">

                        Todos

                    </option>

                    @foreach($periodos as $periodo)

                        <option
                            value="{{ $periodo }}"
                            @selected(
                                request('periodo') == $periodo
                            )
                        >

                            {{ $periodo }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-2 d-flex align-items-end">

                <button
                    class="btn gtri-btn-primary w-100"
                >

                    <i class="bi bi-funnel me-2"></i>

                    Filtrar

                </button>

            </div>

        </div>

    </form>

</div>


<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-files"></i>

                </div>

                <div>

                    <span class="gtri-page-subtitle">

                        Documentos disponibles

                    </span>

                    <h2 class="gtri-page-title mb-0">

                        {{ $totalArchivos }}

                    </h2>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <span class="gtri-page-subtitle">

                        Empleados

                    </span>

                    <h2 class="gtri-page-title mb-0">

                        {{ $totalEmpleados }}

                    </h2>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-building"></i>

                </div>

                <div>

                    <span class="gtri-page-subtitle">

                        Clientes

                    </span>

                    <h2 class="gtri-page-title mb-0">

                        {{ $totalClientes }}

                    </h2>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="gtri-card h-100">

            <div class="d-flex align-items-center gap-3">

                <div class="gtri-stat-icon">

                    <i class="bi bi-calendar3"></i>

                </div>

                <div>

                    <span class="gtri-page-subtitle">

                        Periodos

                    </span>

                    <h2 class="gtri-page-title mb-0">

                        {{ $totalPeriodos }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="gtri-section">

    <h5 class="gtri-section-title">

        <span>

            <i class="bi bi-folder-check"></i>

        </span>

        Contenido de la descarga

    </h5>

    <p class="gtri-page-subtitle mb-3">

        El archivo ZIP se organizará automáticamente
        por cliente, periodo y empleado.

    </p>

    <p class="gtri-page-subtitle mb-3">

        La descarga se genera en tiempo real con la
        documentación disponible al:

        <strong>

            {{ now()->format('d/m/Y H:i') }}

        </strong>

    </p>

    <div class="row g-3">

        <div class="col-md-6">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle text-success"></i>

                <span>Altas del IMSS</span>

            </div>

        </div>

        <div class="col-md-6">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle text-success"></i>

                <span>Nóminas en formato PDF</span>

            </div>

        </div>

        <div class="col-md-6">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle text-success"></i>

                <span>Nóminas en formato XML</span>

            </div>

        </div>

        <div class="col-md-6">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle text-success"></i>

                <span>Constancias del SAT</span>

            </div>

        </div>

        <div class="col-md-6">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle text-success"></i>

                <span>Comprobantes de pago SUA</span>

            </div>

        </div>

    </div>

</div>

<div class="gtri-section mt-4">

    <h5 class="gtri-section-title">

        <span>

            <i class="bi bi-table"></i>

        </span>

        Vista previa de documentos

    </h5>

    <div class="table-responsive">

        <table class="table gtri-table align-middle">

            <thead>

                <tr>

                    <th>Documento</th>

                    <th>Cliente</th>

                    <th>Empleado</th>

                    <th>Periodo</th>

                    <th>Estado</th>

                </tr>

            </thead>

            <tbody>

                @forelse($documentos as $documento)

                    <tr>

                        <td>

                            {{ $documento->tipo_nombre }}    

                        </td>

                        <td>

                            {{ $documento->cliente->razon_social }}

                        </td>

                        <td>

                            {{ $documento->empleado?->nombre_completo ?? 'General' }}
                            
                        </td>

                        <td>

                            {{ $documento->periodo }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                Disponible

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center"
                        >

                            No existen documentos.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

 @if($totalArchivos > 0)

        <a
            href="{{ route('gerencia.carpeta-flash.descargar') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-file-earmark-zip me-2"></i>

            Descargar Carpeta Flash

        </a>

    @else

        <button
            type="button"
            class="btn gtri-btn-primary"
            disabled
        >

            <i class="bi bi-file-earmark-x me-2"></i>

            Sin documentos disponibles

        </button>

    @endif

@endsection