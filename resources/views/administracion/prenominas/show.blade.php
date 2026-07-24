@extends('administracion.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-calculator me-2"></i>

                    Detalle de la Prenómina

                </h2>

                <p class="gtri-page-subtitle">

                    Información del periodo, empleados y totales calculados.

                </p>

            </div>

            <a
                href="{{ route('administracion.prenominas.index') }}"
                class="btn gtri-btn-secondary"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Volver

            </a>

        </div>

    </div>


    {{-- 01 INFORMACIÓN GENERAL --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información del periodo

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Periodo Inicio

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $prenomina->periodo_inicio->format('d/m/Y') }}"
                    readonly
                >

            </div>


            <div class="col-md-4">

                <label class="gtri-label mb-2">

                    Periodo Fin

                </label>

                <input
                    type="text"
                    class="form-control gtri-input"
                    value="{{ $prenomina->periodo_fin->format('d/m/Y') }}"
                    readonly
                >

            </div>


            <div class="col-md-4">

                <label class="gtri-label d-block mb-3">

                    Estatus

                </label>

                @switch($prenomina->estatus)

                    @case('abierta')

                        <span class="badge bg-primary">

                            <i class="bi bi-folder2-open me-1"></i>

                            Abierta

                        </span>

                        @break


                    @case('cerrada')

                        <span class="badge gtri-badge-warning">

                            <i class="bi bi-lock me-1"></i>

                            Cerrada

                        </span>

                        @break


                    @case('autorizada')

                        <span class="badge gtri-badge-success">

                            <i class="bi bi-check-circle me-1"></i>

                            Autorizada

                        </span>

                        @break

                @endswitch

            </div>

        </div>


        <div class="mt-4">

            <label class="gtri-label mb-2">

                Observaciones

            </label>

            <textarea
                class="form-control gtri-textarea"
                rows="3"
                readonly
            >{{ $prenomina->observaciones ?: 'Sin observaciones registradas.' }}</textarea>

        </div>

    </div>


    {{-- 02 EMPLEADOS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Empleados incluidos

        </div>

        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Empleado</th>

                            <th>Salario</th>

                            <th>Percepciones</th>

                            <th>Deducciones</th>

                            <th>Ajustes</th>

                            <th>Horas Extra</th>

                            <th>Total Neto</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($prenomina->detalles as $detalle)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $detalle->empleado->numero_control }}

                                        -

                                        {{ $detalle->empleado->nombre }}

                                        {{ $detalle->empleado->apellido_paterno }}

                                    </div>

                                </td>


                                <td>

                                    ${{ number_format(
                                        $detalle->salario_base,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    ${{ number_format(
                                        $detalle->percepciones,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    ${{ number_format(
                                        $detalle->deducciones,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    ${{ number_format(
                                        $detalle->ajustes,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    ${{ number_format(
                                        $detalle->horas_extra,
                                        2
                                    ) }}

                                </td>


                                <td>

                                    <strong class="text-warning">

                                        ${{ number_format(
                                            $detalle->total_neto,
                                            2
                                        ) }}

                                    </strong>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr>

                            <th
                                colspan="6"
                                class="text-end text-secondary"
                            >

                                Total General

                            </th>

                            <th class="text-warning fs-5">

                                ${{ number_format(
                                    $prenomina->total_nomina,
                                    2
                                ) }}

                            </th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>


    <div class="d-flex justify-content-end gap-3">

        <a
            href="{{ route('administracion.prenominas.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

        <a
            href="{{ route(
                'administracion.prenominas.edit',
                $prenomina
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-pencil me-1"></i>

            Editar Prenómina

        </a>

    </div>

</div>

@endsection