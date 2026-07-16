@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between align-items-center mb-4"
    >

        <h1>

            Detalle del Contrato

        </h1>

        <div>

            <a
                href="{{ route(
                    'operaciones.contratos.edit',
                    $contrato
                ) }}"
                class="btn btn-warning"
            >

                Editar

            </a>

            <a
                href="{{ route(
                    'operaciones.contratos.index'
                ) }}"
                class="btn btn-secondary"
            >

                Regresar

            </a>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>

                        Cliente

                    </strong>

                    <br>

                    {{ $contrato->cliente->razon_social }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Número de Contrato

                    </strong>

                    <br>

                    {{ $contrato->numero_contrato }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Fecha de Inicio

                    </strong>

                    <br>

                    {{ $contrato->fecha_inicio }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Fecha de Fin

                    </strong>

                    <br>

                    {{ $contrato->fecha_fin ?: 'Sin definir' }}

                </div>

                <div class="col-md-6 mb-3">

                    <strong>

                        Estado

                    </strong>

                    <br>

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

                </div>

                <div class="col-12">

                    <strong>

                        Observaciones

                    </strong>

                    <div
                        class="border rounded p-3 mt-2"
                    >

                        {{ $contrato->observaciones ?: 'Sin observaciones.' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm mt-4">

        <div class="card-header">

            <strong>

                Servicios del Contrato

            </strong>

        </div>

        <div class="card-body">

            @if($contrato->servicios->count())

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>

                                Servicio

                            </th>

                            <th>

                                Estado

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($contrato->servicios as $servicio)

                            <tr>

                                <td>

                                    {{ $servicio->nombre }}

                                </td>

                                <td>

                                    {{ ucfirst($servicio->estado) }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="alert alert-secondary mb-0">

                    Este contrato todavía no tiene servicios registrados.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
