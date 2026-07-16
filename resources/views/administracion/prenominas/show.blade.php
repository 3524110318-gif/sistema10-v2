@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="mb-3">

        <a
            href="{{ route('administracion.prenominas.index') }}"
            class="btn btn-secondary"
        >

            <i class="bi bi-arrow-left"></i>

            Volver

        </a>

    </div>

    <x-rh.card-rh titulo="Detalle de la Prenómina">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Periodo Inicio

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $prenomina->periodo_inicio->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Periodo Fin

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $prenomina->periodo_fin->format('d/m/Y') }}"
                    readonly
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-bold">

                    Estatus

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ ucfirst($prenomina->estatus) }}"
                    readonly
                >

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">

                Observaciones

            </label>

            <textarea
                class="form-control"
                rows="3"
                readonly
            >{{ $prenomina->observaciones }}</textarea>

        </div>

        <hr>

        <h5>

            Empleados incluidos

        </h5>

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover"
            >

                <thead class="table-dark">

                    <tr>

                        <th>

                            Empleado

                        </th>

                        <th>

                            Salario

                        </th>

                        <th>

                            Percepciones

                        </th>

                        <th>

                            Deducciones

                        </th>

                        <th>

                            Ajustes

                        </th>

                        <th>

                            Horas Extra

                        </th>

                        <th>

                            Total Neto

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($prenomina->detalles as $detalle)

                        <tr>

                            <td>

                                {{ $detalle->empleado->numero_control }}

                                -

                                {{ $detalle->empleado->nombre }}

                                {{ $detalle->empleado->apellido_paterno }}

                            </td>

                            <td>

                                $

                                {{ number_format($detalle->salario_base,2) }}

                            </td>

                            <td>

                                $

                                {{ number_format($detalle->percepciones,2) }}

                            </td>

                            <td>

                                $

                                {{ number_format($detalle->deducciones,2) }}

                            </td>

                            <td>

                                $

                                {{ number_format($detalle->ajustes,2) }}

                            </td>

                            <td>

                                $

                                {{ number_format($detalle->horas_extra,2) }}

                            </td>

                            <td class="fw-bold">

                                $

                                {{ number_format($detalle->total_neto,2) }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

                <tfoot>

                    <tr class="table-secondary">

                        <th colspan="6" class="text-end">

                            Total General

                        </th>

                        <th>

                            $

                            {{ number_format($prenomina->total_nomina,2) }}

                        </th>

                    </tr>

                </tfoot>

            </table>

        </div>

        <div class="text-end mt-3">

            <a
                href="{{ route('administracion.prenominas.edit', $prenomina) }}"
                class="btn btn-warning"
            >

                <i class="bi bi-pencil"></i>

                Editar

            </a>

        </div>

    </x-rh.card-rh>

</div>

@endsection
