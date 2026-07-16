@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <x-rh.card-rh titulo="Productos">

                <h2 class="text-center">

                    {{ $totalProductos }}

                </h2>

            </x-rh.card-rh>

        </div>

        <div class="col-md-4">

            <x-rh.card-rh titulo="Compras">

                <h2 class="text-center">

                    {{ $totalCompras }}

                </h2>

            </x-rh.card-rh>

        </div>

        <div class="col-md-4">

            <x-rh.card-rh titulo="Facturas">

                <h2 class="text-center">

                    {{ $totalFacturas }}

                </h2>

            </x-rh.card-rh>

        </div>

        <div class="col-md-4">

            <x-rh.card-rh titulo="Cobranzas">

                <h2 class="text-center">

                    {{ $totalCobranzas }}

                </h2>

            </x-rh.card-rh>

        </div>

        <div class="col-md-4">

            <x-rh.card-rh titulo="Activos">

                <h2 class="text-center">

                    {{ $totalActivos }}

                </h2>

            </x-rh.card-rh>

        </div>

        <div class="col-md-4">

            <x-rh.card-rh titulo="Prenóminas">

                <h2 class="text-center">

                    {{ $totalPrenominas }}

                </h2>

            </x-rh.card-rh>

        </div>

    </div>

    <x-rh.card-rh titulo="Alertas Operativas">

        <table class="table table-bordered align-middle mb-0">

            <tbody>

                <tr>

                    <th width="60%">

                        Productos con stock crítico

                    </th>

                    <td class="text-center">

                        @if($stockCritico > 0)

                            <span class="badge bg-danger">

                                {{ $stockCritico }}

                            </span>

                        @else

                            <span class="badge bg-success">

                                Sin alertas

                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>

                        Cobranzas vencidas

                    </th>

                    <td class="text-center">

                        @if($cobranzasVencidas > 0)

                            <span class="badge bg-danger">

                                {{ $cobranzasVencidas }}

                            </span>

                        @else

                            <span class="badge bg-success">

                                Sin alertas

                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>

                        Prenóminas abiertas

                    </th>

                    <td class="text-center">

                        @if($prenominasAbiertas > 0)

                            <span class="badge bg-warning text-dark">

                                {{ $prenominasAbiertas }}

                            </span>

                        @else

                            <span class="badge bg-success">

                                Sin alertas

                            </span>

                        @endif

                    </td>

                </tr>

            </tbody>

        </table>

    </x-rh.card-rh>

</div>

@endsection