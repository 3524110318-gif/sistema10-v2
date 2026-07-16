@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Nueva solicitud vacaciones

    </h1>


    <x-rh.card-rh titulo="Registrar vacaciones">

        <form

            method="POST"

            action="{{ route('rh.vacaciones.store') }}"

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


            <!-- FECHAS -->

            <div class="row">

                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha inicio"
                        name="fecha_inicio"
                        type="date"
                    />

                </div>


                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha fin"
                        name="fecha_fin"
                        type="date"
                    />

                </div>

            </div>


            <!-- DIAS -->

            <x-rh.input-rh
                label="Días"
                name="dias"
                type="number"
            />


            <!-- OBSERVACIONES -->

            <x-rh.textarea-rh
                label="Observaciones"
                name="observaciones"
            />


            <!-- BOTON -->

            <button

                class="btn btn-primary rounded-3 px-4"

            >

                Guardar solicitud

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection