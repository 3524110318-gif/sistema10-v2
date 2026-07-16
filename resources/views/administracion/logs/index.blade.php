@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <!-- TITULO -->

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Logs del sistema

        </h1>

    </div>


    <!-- TABLA -->

    <x-rh.card-rh titulo="Actividad reciente">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Usuario</th>

                        <th>Acción</th>

                        <th>Fecha</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($logs as $log)

                        <tr>

                            <!-- USUARIO -->

                            <td>

                                <span class="fw-semibold">

                                    {{ $log->usuario }}

                                </span>

                            </td>


                            <!-- ACCION -->

                            <td>

                                {{ $log->accion }}

                            </td>


                            <!-- FECHA -->

                            <td>

                                {{ $log->created_at->format('d/m/Y H:i') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3">

                                No hay actividad registrada

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINACION -->

        <div class="mt-4 d-flex justify-content-center">

            {{ $logs->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
