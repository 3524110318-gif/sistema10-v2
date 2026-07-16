@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        EMPLEADOS INACTIVOS

    </h1>


    <x-rh.card-rh titulo="Lista de empleados">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

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

                                <span class="badge bg-danger">

                                    Inactivo

                                </span>

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                <form

                                    action="{{ route(

                                        'rh.empleados.reactivar',

                                        $empleado->id

                                    ) }}"

                                    method="POST"

                                    class="d-inline"

                                >

                                    @csrf
                                    @method('PUT')


                                    <button

                                        class="btn btn-success btn-sm"

                                        onclick="return confirm(

                                            '¿Seguro que deseas reactivar este empleado?'

                                        )"

                                    >

                                        Reactivar

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                No hay empleados inactivos

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

</div>

@endsection