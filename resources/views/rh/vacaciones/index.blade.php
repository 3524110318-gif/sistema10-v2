@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Vacaciones RH

        </h1>


        <a

            href="{{ route('rh.vacaciones.create') }}"

            class="btn btn-primary rounded-3"

        >

            Nueva solicitud

        </a>

    </div>


    <!-- TABLA -->

    <x-rh.card-rh titulo="Solicitudes vacaciones">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Empleado</th>

                        <th>Inicio</th>

                        <th>Fin</th>

                        <th>Días</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($vacaciones as $vacacion)

                        <tr>

                            <!-- EMPLEADO -->

                            <td>

                                {{ $vacacion->empleado->nombre }}

                            </td>


                            <!-- FECHA INICIO -->

                            <td>

                                {{ $vacacion->fecha_inicio }}

                            </td>


                            <!-- FECHA FIN -->

                            <td>

                                {{ $vacacion->fecha_fin }}

                            </td>


                            <!-- DIAS -->

                            <td>

                                {{ $vacacion->dias }}

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <x-rh.vacaciones.badge-estado
                                    :estado="$vacacion->estado"
                                />

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                @if ($vacacion->estado == 'pendiente')

                                    <!-- APROBAR -->

                                    <form

                                        method="POST"

                                        action="{{ route(

                                            'rh.vacaciones.aprobar',

                                            $vacacion->id

                                        ) }}"

                                        class="d-inline"

                                    >

                                        @csrf
                                        @method('PATCH')


                                        <button

                                            class="btn btn-success btn-sm"

                                        >

                                            Aprobar

                                        </button>

                                    </form>


                                    <!-- RECHAZAR -->

                                    <form

                                        method="POST"

                                        action="{{ route(

                                            'rh.vacaciones.rechazar',

                                            $vacacion->id

                                        ) }}"

                                        class="d-inline"

                                    >

                                        @csrf
                                        @method('PATCH')


                                        <button

                                            class="btn btn-danger btn-sm"

                                        >

                                            Rechazar

                                        </button>

                                    </form>

                                @else

                                    <span class="text-muted">

                                        Sin acciones

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                No hay solicitudes

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

</div>

@endsection