@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Entrega de Uniforme

    </h1>

    <x-rh.card-rh titulo="Registrar entrega">

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
                'rh.uniformes.store',
                $empleado->id
            ) }}"

        >

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Artículo

                </label>

                <select
                    name="articulo"
                    class="form-select"
                >

                    <option value="Botas">
                        Botas
                    </option>

                    <option value="Camisa">
                        Camisa
                    </option>

                    <option value="Pantalón">
                        Pantalón
                    </option>

                    <option value="Chaleco">
                        Chaleco
                    </option>

                    <option value="Radio">
                        Radio
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Tipo

                </label>

                <select
                    name="tipo"
                    class="form-select"
                >

                    <option value="nuevo">

                        Nuevo

                    </option>

                    <option value="segunda_mano">

                        Segunda Mano

                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Fecha entrega

                </label>

                <input

                    type="date"

                    name="fecha_entrega"

                    class="form-control"

                    required

                >

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Observaciones

                </label>

                <textarea

                    name="observaciones"

                    class="form-control"

                    rows="3"

                ></textarea>

            </div>

            <button

                class="btn btn-primary"

            >

                Registrar entrega

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection
