@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <h2 class="mb-4">

        Dashboard Comercial

    </h2>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Prospectos

                    </h6>

                    <h2 class="fw-bold text-primary">

                        {{ $prospectos }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Clientes

                    </h6>

                    <h2 class="fw-bold text-success">

                        {{ $clientes }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Cotizaciones

                    </h6>

                    <h2 class="fw-bold text-warning">

                        {{ $cotizaciones }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6 class="text-muted">

                        Contratos Activos

                    </h6>

                    <h2 class="fw-bold text-info">

                        {{ $contratosActivos }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header bg-danger text-white">

            <strong>

                Contratos próximos a vencer (60 días)

            </strong>

        </div>

        <div class="card-body">

            @if($contratosPorVencer->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">

                            <tr>

                                <th>Folio</th>

                                <th>Cliente</th>

                                <th>Fecha de vencimiento</th>

                                <th>Días restantes</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($contratosPorVencer as $contrato)

                                <tr>

                                    <td>

                                        {{ $contrato->folio }}

                                    </td>

                                    <td>

                                        {{ $contrato->cliente->razon_social }}

                                    </td>

                                    <td>

                                        {{ $contrato->fecha_fin->format('d/m/Y') }}

                                    </td>

                                    <td>

                                        {{ (int) now()->diffInDays($contrato->fecha_fin, false) }}

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-success mb-0">

                    No existen contratos próximos a vencer.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection