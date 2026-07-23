@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- CARD PRINCIPAL --}}
    <x-rh.card-rh titulo="Resultado del expediente mensual REPSE">

        {{-- INFORMACIÓN DEL CLIENTE --}}
        <div class="mb-4">

            <h5 class="fw-bold">

                <i class="bi bi-building me-2"></i>

                Información del periodo

            </h5>

            <hr>

        </div>


        <div class="row g-3 mb-4">

            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted d-block">
                        Cliente
                    </small>

                    <strong class="fs-5">

                        {{ $cliente->razon_social }}

                    </strong>

                </div>

            </div>


            <div class="col-md-6">

                <div class="border rounded p-3 h-100">

                    <small class="text-muted d-block">
                        Periodo
                    </small>

                    <strong class="fs-5">

                        {{ $inicioMes->format('d/m/Y') }}

                        -

                        {{ $finMes->format('d/m/Y') }}

                    </strong>

                </div>

            </div>

        </div>


        {{-- GUARDIAS ENCONTRADOS --}}
        <div class="mb-4">

            <h5 class="fw-bold">

                <i class="bi bi-people me-2"></i>

                Guardias encontrados

            </h5>

            <p class="text-muted mb-2">

                Personal relacionado con plazas del cliente
                durante el periodo seleccionado.

            </p>

            <hr>

        </div>


        @if($empleados->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

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

                                    {{ $empleado->numero_control }}

                                </td>

                                <td>

                                    <div class="fw-semibold">

                                        {{ $empleado->nombre }}

                                        {{ $empleado->apellido_paterno }}

                                        {{ $empleado->apellido_materno }}

                                    </div>

                                </td>


                                {{-- ESTADO REPSE --}}
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


                                {{-- IMSS --}}
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


                                {{-- CONTRATO --}}
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


                                {{-- SSP --}}
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


                                {{-- SAT --}}
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

                                {{-- PRENÓMINA --}}
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

                                    {{-- PAQUETE REPSE --}}
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

                                                    <small
                                                        class="d-block text-danger"
                                                    >

                                                        <i class="bi bi-x-circle me-1"></i>

                                                        {{ $faltante }}

                                                    </small>

                                                @endforeach

                                            </div>

                                        @endif
                                    </td>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="alert alert-light border mt-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <strong>
                            Total de guardias encontrados:
                        </strong>

                    </div>

                    <span class="badge bg-primary fs-6">

                        {{ $empleados->count() }}

                    </span>

                </div>

            </div>

        @else

            <div class="alert alert-warning">

                <i class="bi bi-exclamation-triangle me-1"></i>

                No se encontraron guardias asignados a este cliente
                durante el periodo seleccionado.

            </div>

        @endif

        {{-- ESTADO GENERAL DEL EXPEDIENTE --}}

        <div class="mb-4">

            <div
                class="alert
                {{ $paqueteGeneralListo ? 'alert-success' : 'alert-warning' }}"
            >

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <strong>

                            Estado del expediente mensual:

                        </strong>

                        @if($paqueteGeneralListo)

                            <span class="badge bg-success ms-2">

                                <i class="bi bi-check-circle me-1"></i>

                                Completo

                            </span>

                        @else

                            <span class="badge bg-warning text-dark ms-2">

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

        </div>

        {{-- DOCUMENTACIÓN YA CARGADA --}}

        <div class="mb-4 mt-5">

            <h5 class="fw-bold">

                <i class="bi bi-folder2-open me-2"></i>

                Documentación cargada

            </h5>

            <p class="text-muted mb-2">

                Archivos registrados para este cliente y periodo.

            </p>

            <hr>

        </div>


        @if($archivosRepse->count() > 0)

            <div class="table-responsive mb-4">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

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

                                {{-- EMPLEADO --}}
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


                                {{-- TIPO --}}
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


                                {{-- ARCHIVO --}}
                                <td>

                                    <i class="bi bi-file-earmark me-1"></i>

                                    {{ basename($archivoRepse->archivo) }}

                                </td>

                                {{-- ACCIONES --}}
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

        @else

            <div class="alert alert-info">

                <i class="bi bi-info-circle me-1"></i>

                Todavía no hay archivos cargados para este cliente y periodo.

            </div>

        @endif

        {{-- CARGA DE DOCUMENTACIÓN MENSUAL REPSE --}}

        <div class="mb-4 mt-5">

            <h5 class="fw-bold">

                <i class="bi bi-cloud-arrow-up me-2"></i>

                Documentación mensual REPSE

            </h5>

            <p class="text-muted mb-2">

                Cargue los documentos que serán incluidos en el ZIP mensual.

            </p>

            <hr>

        </div>


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


            <div class="row">

                {{-- EMPLEADO --}}
                <div class="col-md-4 mb-3">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                    >

                        Empleado

                    </label>

                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select"
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

                        Para Pago SUA deje seleccionado
                        "Documento general del periodo".

                    </div>

                </div>


                {{-- TIPO DE DOCUMENTO --}}
                <div class="col-md-4 mb-3">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                    >

                        Tipo de documento

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select"
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


                {{-- ARCHIVO --}}
                <div class="col-md-4 mb-3">

                    <label
                        for="archivo"
                        class="form-label fw-semibold"
                    >

                        Archivo

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <input
                        type="file"
                        name="archivo"
                        id="archivo"
                        class="form-control"
                        required
                    >

                    <div class="form-text">

                        Tamaño máximo: 10 MB.

                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-end mb-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-upload me-1"></i>

                    Guardar archivo

                </button>

            </div>

        </form>


        {{-- BOTONES --}}
        <div class="d-flex justify-content-end gap-2 mt-4">

            <a
                href="{{ route('repse.generador.index') }}"
                class="btn btn-secondary"
            >

                <i class="bi bi-arrow-left"></i>

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
                        class="btn btn-success"
                    >

                        <i class="bi bi-file-earmark-zip me-1"></i>

                        Descargar ZIP REPSE

                    </button>

                </form>

            @endif

        </div>

    </x-rh.card-rh>

</div>

@endsection