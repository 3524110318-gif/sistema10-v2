@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Registrar Capacitación

    </h1>

    <x-rh.card-rh titulo="Nueva capacitación">

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
                'rh.capacitaciones.store',
                $empleado->id
            ) }}"
        >

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Curso

                </label>

                <select
                    name="curso"
                    class="form-select"
                >

                    <option>
                        Primeros Auxilios
                    </option>

                    <option>
                        Uso de Extintores
                    </option>

                    <option>
                        Seguridad Privada
                    </option>

                    <option>
                        Manejo Defensivo
                    </option>

                    <option>
                        Protección Civil
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Fecha capacitación

                </label>

                <input
                    type="date"
                    name="fecha_capacitacion"
                    class="form-control"
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Calificación

                </label>

                <input
                    type="number"
                    name="calificacion"
                    class="form-control"
                    min="0"
                    max="100"
                >

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Vigencia hasta

                </label>

                <input
                    type="date"
                    name="vigencia_hasta"
                    class="form-control"
                >

            </div>

            <button
                class="btn btn-primary"
            >

                Registrar capacitación

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection
