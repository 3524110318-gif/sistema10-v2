@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Nueva incidencia

    </h1>


    <x-rh.card-rh titulo="Registrar incidencia">

        <form

            method="POST"

            action="{{ route('rh.incidencias.store') }}"

        >

            @csrf


            <!-- EMPLEADO -->

            <div class="mb-4">

                <label class="form-label">

                    Empleado

                </label>


                <select

                    name="empleado_id"

                    class="form-select"

                >

                    @foreach ($empleados as $empleado)

                        <option value="{{ $empleado->id }}">

                            {{ $empleado->nombre }}

                            {{ $empleado->apellido_paterno }}

                        </option>

                    @endforeach

                </select>

            </div>


            <!-- TIPO -->

            <div class="mb-4">

                <label class="form-label">

                    Tipo incidencia

                </label>


                <select

                    name="tipo"

                    class="form-select"

                >

                    <option value="falta">

                        Falta

                    </option>


                    <option value="retardo">

                        Retardo

                    </option>


                    <option value="permiso">

                        Permiso

                    </option>


                    <option value="incapacidad">

                        Incapacidad

                    </option>

                </select>

            </div>


            <!-- FECHA -->

            <x-rh.input-rh
                label="Fecha"
                name="fecha"
                type="date"
            />


            <!-- DESCRIPCION -->

            <x-rh.textarea-rh
                label="Descripción"
                name="descripcion"
            />


            <!-- BOTON -->

            <button

                class="btn btn-primary rounded-3 px-4"

            >

                Guardar incidencia

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection