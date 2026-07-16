@extends('operaciones.layouts.app')

@section('contenido')

<h2>

    {{ $servicio->nombre }}

</h2>

<div class="card mb-4">

    <div class="card-body">

        <p>

            <strong>Cliente:</strong>

            {{ $servicio
                ->contrato
                ->cliente
                ->razon_social }}

        </p>

        <p>

            <strong>Contrato:</strong>

            {{ $servicio
                ->contrato
                ->numero_contrato }}

        </p>

        <p>

            <strong>Municipio:</strong>

            {{ $servicio->municipio }}

        </p>

        <p>

            <strong>Estado:</strong>

            {{ ucfirst(
                $servicio->estado
            ) }}

        </p>

    </div>

</div>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="card">

            <div class="card-body">

                <h5>

                    Plazas Totales

                </h5>

                <h2>

                    {{ $totalPlazas }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card">

            <div class="card-body">

                <h5>

                    Cubiertas

                </h5>

                <h2>

                    {{ $cubiertas }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card">

            <div class="card-body">

                <h5>

                    Vacantes

                </h5>

                <h2>

                    {{ $vacantes }}

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card">

            <div class="card-body">

                <h5>

                    Cobertura

                </h5>

                <h2>

                    {{ $cobertura }}%

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card">

        <div class="card-body">

            <h5>

                ISS

            </h5>

            <h2>

                {{ $servicio->calcularISS() }}

            </h2>

        </div>

    </div>

</div>

</div>

<h4>

    Cobertura Operativa

</h4>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Plaza</th>

            <th>Turno</th>

            <th>Estado</th>

            <th>Empleado</th>

        </tr>

    </thead>

    <tbody>

        @foreach(
            $servicio->plazas as $plaza
        )

            <tr>

                <td>

                    {{ $plaza->nombre_plaza }}

                </td>

                <td>

                    {{ $plaza->turno }}

                </td>

                <td>

                    {{ ucfirst(
                        $plaza->estado
                    ) }}

                </td>

                <td>

                    @if(
                        $plaza
                        ->asignaciones
                        ->count()
                    )

                        {{ $plaza
                            ->asignaciones
                            ->first()
                            ->empleado
                            ->nombre }}

                        {{ $plaza
                            ->asignaciones
                            ->first()
                            ->empleado
                            ->apellido_paterno }}

                    @else

                        Sin asignar

                    @endif

                </td>

            </tr>

        @endforeach

    </tbody>

</table>
<hr>

<h4>

    Supervisiones

</h4>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Fecha</th>

            <th>Resultado</th>

            <th>Observaciones</th>

        </tr>

    </thead>

    <tbody>

        @forelse(
            $supervisiones as $supervision
        )

            <tr>

                <td>

                    {{ $supervision->fecha_supervision }}

                </td>

                <td>

                    {{ ucfirst(
                        $supervision->resultado
                    ) }}

                </td>

                <td>

                    {{ $supervision->observaciones }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3">

                    Sin supervisiones

                </td>

            </tr>

        @endforelse

    </tbody>

</table>
<hr>

<h4>

    Incidencias Operativas

</h4>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Tipo</th>

            <th>Estado</th>

            <th>Descripción</th>

        </tr>

    </thead>

    <tbody>

        @forelse(
            $servicio->incidencias as $incidencia
        )

            <tr>

                <td>

                    {{ ucfirst(
                        $incidencia->tipo
                    ) }}

                </td>

                <td>

                    {{ ucfirst(
                        $incidencia->estado
                    ) }}

                </td>

                <td>

                    {{ $incidencia->descripcion }}

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3">

                    Sin incidencias

                </td>

            </tr>

        @endforelse

    </tbody>

</table>
<hr>

<h4>

    Evidencias Fotográficas

</h4>

<div class="row">

    @forelse(
        $evidencias as $evidencia
    )

        <div class="col-md-3 mb-3">

            <div class="card">

                <img
                    src="{{ asset(
                        'storage/' .
                        $evidencia->foto
                    ) }}"
                    class="card-img-top"
                >

                <div class="card-body">

                    <h6>

                        {{ $evidencia->titulo }}

                    </h6>

                    <p>

                        {{ $evidencia->descripcion }}

                    </p>

                </div>

            </div>

        </div>

    @empty

        <p>

            Sin evidencias

        </p>

    @endforelse

</div>

@endsection
