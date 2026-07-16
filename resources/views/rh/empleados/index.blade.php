@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        EMPLEADOS RH

    </h1>


    <!-- BOTONES -->

    <div class="d-flex gap-2 mb-4">

        <a

            href="{{ route('rh.empleados.create') }}"

            class="btn btn-primary"

        >

            Nuevo empleado

        </a>


        <a

            href="{{ route('rh.empleados.inactivos') }}"

            class="btn btn-danger"

        >

            Empleados inactivos

        </a>

    </div>


    <!-- BUSCADOR -->

    <x-rh.card-rh titulo="Buscar empleado">

        <form method="GET">

            <div class="row align-items-end">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Buscar No.Control"
                        name="buscar"
                        type="text"
                        :value="request('buscar')"
                    />

                </div>


                <div class="col-auto">

                    <button class="btn btn-primary">

                        Buscar

                    </button>

                </div>

            </div>

        </form>

    </x-rh.card-rh>


    <!-- TABLA -->

    <x-rh.card-rh titulo="Lista de empleados">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark sticky-top">

                    <tr>

                        <th>No.Control</th>

                        <th>Nombre</th>

                        <th>Puesto</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($empleados as $empleado)

                        <tr>

                            <!-- NUMERO CONTROL -->

                            <td>

                                {{ $empleado->numero_control }}

                            </td>


                            <!-- NOMBRE -->

                            <td>

                                {{ $empleado->nombre }}

                                {{ $empleado->apellido_paterno }}

                                {{ $empleado->apellido_materno }}

                            </td>


                            <!-- PUESTO -->

                            <td>

                                {{ $empleado->puesto }}

                            </td>


                            <!-- ESTADO -->

                            <td>

                                @if ($empleado->estado == 'activo')

                                    <span class="badge bg-success">

                                        Activo

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Inactivo

                                    </span>

                                @endif

                            </td>


                            <!-- ACCIONES -->

                            <td class="d-flex gap-2">

                                <a

                                    href="{{ route(

                                        'rh.empleados.show',

                                        $empleado->id

                                    ) }}"

                                    class="btn btn-info btn-sm"

                                >

                                    Ver Expediente

                                </a>


                                <a

                                    href="{{ route(

                                        'rh.empleados.edit',

                                        $empleado->id

                                    ) }}"

                                    class="btn btn-warning btn-sm"

                                >

                                    Editar Expediente

                                </a>

                                <a
                                    href="{{ route(
                                        'rh.bajas.create',
                                        $empleado->id
                                    ) }}"
                                    class="btn btn-danger btn-sm"
                                >

                                    Baja

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                No hay empleados registrados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="d-flex justify-content-center mt-4">

            {{ $empleados->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
