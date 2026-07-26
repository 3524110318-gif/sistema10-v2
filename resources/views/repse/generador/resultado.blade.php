@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-zip me-2"></i>

                Resultado del Expediente Mensual REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Revisa el cumplimiento del personal, carga la documentación mensual y genera el paquete REPSE.

            </p>

        </div>

        <a
            href="{{ route('repse.generador.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Nueva búsqueda

        </a>

    </div>


    <!-- 01 · INFORMACIÓN DEL PERIODO -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información del periodo

        </div>

        <div class="row g-3">

            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Cliente

                    </div>

                    <div class="gtri-info-value fs-5 mt-2">

                        <i class="bi bi-building me-2"></i>

                        {{ $cliente->razon_social }}

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="gtri-info-card h-100">

                    <div class="gtri-info-label">

                        Periodo

                    </div>

                    <div class="gtri-info-value fs-5 mt-2">

                        <i class="bi bi-calendar-range me-2"></i>

                        {{ $inicioMes->format('d/m/Y') }}

                        -

                        {{ $finMes->format('d/m/Y') }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- 02 · GUARDIAS ENCONTRADOS -->

    <div class="gtri-section">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div>

                <div class="gtri-section-title mb-1">

                    <span>02</span>

                    Guardias encontrados

                </div>

                <p class="text-secondary mb-0">

                    Personal relacionado con plazas del cliente durante el periodo seleccionado.

                </p>

            </div>

            <div>

                <span class="text-secondary">

                    Total:

                </span>

                <span class="text-warning fw-bold">

                    {{ $empleados->count() }}

                </span>

            </div>

        </div>


        @if($empleados->count() > 0)

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>No. Control</th>

                                <th>Empleado</th>

                                <th class="text-center">REPSE</th>

                                <th class="text-center">IMSS</th>

                                <th class="text-center">Contrato</th>

                                <th class="text-center">SSP</th>

                                <th class="text-center">SAT</th>

                                <th class="text-center">Prenómina</th>

                                <th class="text-center">Paquete REPSE</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($empleados as $empleado)

                                <tr>

                                    <td>

                                        <span class="fw-semibold text-light">

                                            {{ $empleado->numero_control }}

                                        </span>

                                    </td>

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $empleado->nombre }}

                                            {{ $empleado->apellido_paterno }}

                                            {{ $empleado->apellido_materno }}

                                        </div>

                                    </td>


                                    <!-- ESTADO REPSE -->

                                    <td class="text-center">

                                        @if(
                                            $empleado->repse &&
                                            $empleado->repse->cumpleRequisitos()
                                        )

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Cumple

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                <i class="bi bi-lock me-1"></i>

                                                Bloqueado

                                            </span>

                                        @endif

                                    </td>


                                    <!-- IMSS -->

                                    <td class="text-center">

                                        @if(
                                            $empleado->repse &&
                                            $empleado->repse->alta_imss
                                        )

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

                                        @if(
                                            $empleado->repse &&
                                            $empleado->repse->contrato_firmado
                                        )

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

                                        @if(
                                            $empleado->repse &&
                                            $empleado->repse->cedula_ssp &&
                                            $empleado->repse->estadoVigenciaCedula() === 'vigente'
                                        )

                                            <span class="badge bg-success">

                                                Vigente

                                            </span>

                                        @elseif(
                                            $empleado->repse &&
                                            $empleado->repse->estadoVigenciaCedula() === 'por_vencer'
                                        )

                                            <span class="badge bg-warning text-dark">

                                                Por vencer

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                No válida

                                            </span>

                                        @endif

                                    </td>


                                    <!-- SAT -->

                                    <td class="text-center">

                                        @if(
                                            $empleado->repse &&
                                            $empleado->repse->constancia_fiscal &&
                                            $empleado->repse->rfc_constancia &&
                                            strtoupper(trim($empleado->repse->rfc_constancia)) ===
                                            strtoupper(trim($empleado->rfc))
                                        )

                                            <span class="badge bg-success">

                                                Validado

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                No válido

                                            </span>

                                        @endif

                                    </td>


                                    <!-- PRENÓMINA -->

                                    <td class="text-center">

                                        @if($empleado->tiene_prenomina)

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Disponible

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Sin prenómina

                                            </span>

                                        @endif

                                    </td>


                                    <!-- PAQUETE REPSE -->

                                    <td class="text-center">

                                        @if($empleado->paquete_repse_listo)

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Listo

                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-exclamation-triangle me-1"></i>

                                                Incompleto

                                            </span>

                                            <div class="mt-2">

                                                @foreach(
                                                    $empleado->faltantes_paquete_repse
                                                    as $faltante
                                                )

                                                    <small class="d-block text-danger">

                                                        <i class="bi bi-x-circle me-1"></i>

                                                        {{ $faltante }}

                                                    </small>

                                                @endforeach

                                            </div>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div class="gtri-card text-center py-5">

                <i class="bi bi-people fs-1 text-secondary d-block mb-3"></i>

                <h5 class="text-light">

                    No se encontraron guardias

                </h5>

                <p class="text-secondary mb-0">

                    No existen guardias asignados a este cliente durante el periodo seleccionado.

                </p>

            </div>

        @endif

    </div>


    <!-- 03 · ESTADO GENERAL DEL EXPEDIENTE -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Estado general del expediente

        </div>


        @if(!$hayGuardias)

            <div class="gtri-card">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <div class="gtri-info-label">

                            Estado del expediente mensual

                        </div>

                        <span class="badge bg-secondary mt-2">

                            <i class="bi bi-dash-circle me-1"></i>

                            No aplica

                        </span>

                    </div>

                    <span class="badge bg-secondary">

                        Sin personal asignado en el periodo

                    </span>

                </div>

            </div>

        @else

            <div class="gtri-card">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <div class="gtri-info-label">

                            Estado del expediente mensual

                        </div>

                        @if($paqueteGeneralListo)

                            <span class="badge bg-success mt-2">

                                <i class="bi bi-check-circle me-1"></i>

                                Completo

                            </span>

                        @else

                            <span class="badge bg-warning text-dark mt-2">

                                <i class="bi bi-exclamation-triangle me-1"></i>

                                Incompleto

                            </span>

                        @endif

                    </div>


                    <div>

                        @if($tienePagoSua)

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Pago SUA cargado

                            </span>

                        @else

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Falta Pago SUA

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @endif

    </div>


    <!-- 04 · DOCUMENTACIÓN CARGADA -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

            Documentación cargada

        </div>

        <p class="text-secondary mb-4">

            Archivos registrados para este cliente y periodo.

        </p>


        @if($archivosRepse->count() > 0)

            <div class="gtri-table-wrapper">

                <div class="table-responsive">

                    <table class="table gtri-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Empleado</th>

                                <th>Tipo</th>

                                <th>Archivo</th>

                                <th class="text-center">Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($archivosRepse as $archivoRepse)

                                <tr>

                                    <td>

                                        @if($archivoRepse->empleado)

                                            {{ $archivoRepse->empleado->numero_control }}

                                            -

                                            {{ $archivoRepse->empleado->nombre }}

                                            {{ $archivoRepse->empleado->apellido_paterno }}

                                        @else

                                            <span class="badge bg-secondary">

                                                Documento general

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @switch($archivoRepse->tipo)

                                            @case('alta_imss')

                                                <span class="badge bg-primary">

                                                    Alta IMSS

                                                </span>

                                            @break


                                            @case('nomina_pdf')

                                                <span class="badge bg-info text-dark">

                                                    Nómina PDF

                                                </span>

                                            @break


                                            @case('nomina_xml')

                                                <span class="badge bg-info text-dark">

                                                    Nómina XML

                                                </span>

                                            @break


                                            @case('constancia_sat')

                                                <span class="badge bg-success">

                                                    Constancia SAT

                                                </span>

                                            @break


                                            @case('pago_sua')

                                                <span class="badge bg-warning text-dark">

                                                    Pago SUA

                                                </span>

                                            @break

                                        @endswitch

                                    </td>


                                    <td>

                                        <i class="bi bi-file-earmark me-1 text-warning"></i>

                                        {{ basename($archivoRepse->archivo) }}

                                    </td>


                                    <td class="text-center">

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'repse.generador.archivos.eliminar',
                                                $archivoRepse
                                            ) }}"
                                            onsubmit="return confirm(
                                                '¿Está seguro de eliminar este archivo?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar archivo"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @else

            <div class="gtri-card text-center py-4">

                <i class="bi bi-folder2-open fs-2 text-secondary d-block mb-2"></i>

                <p class="text-secondary mb-0">

                    Todavía no hay archivos cargados para este cliente y periodo.

                </p>

            </div>

        @endif

    </div>


    <!-- 05 · CARGA DE DOCUMENTACIÓN -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>05</span>

            Documentación mensual REPSE

        </div>

        <p class="text-secondary mb-4">

            Cargue los documentos que serán incluidos en el ZIP mensual.

        </p>


        @if(session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-1"></i>

                {{ session('success') }}

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('repse.generador.archivos.guardar') }}"
            enctype="multipart/form-data"
        >

            @csrf

            <input
                type="hidden"
                name="cliente_id"
                value="{{ $cliente->id }}"
            >

            <input
                type="hidden"
                name="periodo"
                value="{{ $inicioMes->format('Y-m') }}"
            >


            <div class="row g-3">

                <!-- EMPLEADO -->

                <div class="col-md-4">

                    <label
                        for="empleado_id"
                        class="form-label"
                    >

                        Empleado

                    </label>

                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select gtri-input"
                    >

                        <option value="">

                            Documento general del periodo

                        </option>

                        @foreach($empleados as $empleado)

                            <option value="{{ $empleado->id }}">

                                {{ $empleado->numero_control }}

                                -

                                {{ $empleado->nombre }}

                                {{ $empleado->apellido_paterno }}

                            </option>

                        @endforeach

                    </select>

                    <div class="form-text">

                        Para Pago SUA deje seleccionado "Documento general del periodo".

                    </div>

                </div>


                <!-- TIPO -->

                <div class="col-md-4">

                    <label
                        for="tipo"
                        class="form-label"
                    >

                        Tipo de documento

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un tipo

                        </option>

                        <option value="alta_imss">

                            Alta IMSS

                        </option>

                        <option value="nomina_pdf">

                            Nómina PDF

                        </option>

                        <option value="nomina_xml">

                            Nómina XML

                        </option>

                        <option value="constancia_sat">

                            Constancia SAT

                        </option>

                        <option value="pago_sua">

                            Pago SUA

                        </option>

                    </select>

                </div>


                <!-- ARCHIVO -->

                <div class="col-md-4">

                    <label
                        for="archivo"
                        class="form-label"
                    >

                        Archivo

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="file"
                        name="archivo"
                        id="archivo"
                        class="form-control gtri-input"
                        required
                    >

                    <div class="form-text">

                        Tamaño máximo: 10 MB.

                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-end mt-4">

                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-upload me-1"></i>

                    Guardar archivo

                </button>

            </div>

        </form>

    </div>


    <!-- 06 · ACCIONES -->

    <div class="gtri-section mb-0">

        <div class="d-flex justify-content-end gap-2 flex-wrap">

            <a
                href="{{ route('repse.generador.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Nueva búsqueda

            </a>


            @if($empleados->count() > 0)

                <form
                    method="POST"
                    action="{{ route('repse.generador.descargar') }}"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="cliente_id"
                        value="{{ $cliente->id }}"
                    >

                    <input
                        type="hidden"
                        name="mes"
                        value="{{ $inicioMes->format('Y-m') }}"
                    >

                    <button
                        type="submit"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-file-earmark-zip me-1"></i>

                        Descargar ZIP REPSE

                    </button>

                </form>

            @endif

        </div>

    </div>

</div>

@endsection