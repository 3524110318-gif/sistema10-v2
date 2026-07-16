@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Nuevo día calendario

    </h1>


    <x-rh.card-rh titulo="Registrar día">

        <form

            method="POST"

            action="{{ route('rh.calendario.store') }}"

        >

            @csrf


            <x-rh.input-rh
                label="Fecha"
                name="fecha"
                type="date"
            />


            <div class="mb-4">

                <label class="form-label">

                    Tipo día

                </label>


                <select

                    name="tipo"

                    class="form-select"

                >

                    <option value="laboral">

                        Laboral

                    </option>


                    <option value="descanso">

                        Descanso

                    </option>


                    <option value="festivo">

                        Festivo

                    </option>


                    <option value="vacaciones">

                        Vacaciones

                    </option>

                </select>

            </div>


            <x-rh.input-rh
                label="Descripción"
                name="descripcion"
                type="text"
            />


            <button

                class="btn btn-primary rounded-3 px-4"

            >

                Guardar día

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection