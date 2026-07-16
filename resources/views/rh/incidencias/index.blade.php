@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Incidencias RH

        </h1>


        <a

            href="{{ route('rh.incidencias.create') }}"

            class="btn btn-primary rounded-3"

        >

            Nueva incidencia

        </a>

    </div>


    <!-- TABLA -->

    <x-rh.card-rh titulo="Lista de incidencias">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Empleado</th>

                        <th>Tipo</th>

                        <th>Fecha</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($incidencias as $incidencia)

                        <tr>

                            <!-- EMPLEADO -->

                            <td>

                                {{ $incidencia->empleado->nombre }}

                            </td>


                            <!-- TIPO -->

                            <td>

                                {{ ucfirst($incidencia->tipo) }}

                            </td>


                            <!-- FECHA -->

                            <td>

                                {{ $incidencia->fecha }}

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <x-rh.incidencias.badge-estado
                                    :estado="$incidencia->estado"
                                />

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                @if ($incidencia->estado == 'pendiente')

                                    <!-- JUSTIFICAR -->

                                    <form

                                        method="POST"

                                        action="{{ route(

                                            'rh.incidencias.justificar',

                                            $incidencia->id

                                        ) }}"

                                        class="d-inline"

                                    >

                                        @csrf
                                        @method('PATCH')


                                        <button

                                            class="btn btn-success btn-sm"

                                        >

                                            Justificar

                                        </button>

                                    </form>


                                    <!-- INJUSTIFICAR -->

                                    <form

                                        method="POST"

                                        action="{{ route(

                                            'rh.incidencias.injustificar',

                                            $incidencia->id

                                        ) }}"

                                        class="d-inline"

                                    >

                                        @csrf
                                        @method('PATCH')


                                        <button

                                            class="btn btn-danger btn-sm"

                                        >

                                            Injustificar

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

                            <td colspan="5">

                                No hay incidencias

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

</div>

@endsection