@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Registrar Vigencia

    </h1>

    <x-rh.card-rh titulo="Nueva vigencia">

        <div class="mb-4">

            <strong>Empleado:</strong>

            {{ $empleado->numero_control }}

            -

            {{ $empleado->nombre }}

            {{ $empleado->apellido_paterno }}

        </div>

        <form

            method="POST"

            action="{{ route(
                'rh.vigencias.store',
                $empleado->id
            ) }}"

        >

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Documento

                </label>

                <select
                    name="documento"
                    class="form-select"
                >

                    <option>
                        Carta de antecedentes
                    </option>

                    <option>
                        Examen médico
                    </option>

                    <option>
                        Cédula SSP
                    </option>

                    <option>
                        Licencia
                    </option>

                    <option>
                        Otro
                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Fecha de vencimiento

                </label>

                <input

                    type="date"

                    name="fecha_vencimiento"

                    class="form-control"

                    required

                >

            </div>

            <button

                class="btn btn-primary"

            >

                Registrar vigencia

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection
