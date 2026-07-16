@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Baja de Empleado

    </h1>

    <x-rh.card-rh titulo="Checklist de Baja">

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
                'rh.bajas.store',
                $empleado->id
            ) }}"
        >

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Fecha de baja

                </label>

                <input
                    type="date"
                    name="fecha_baja"
                    class="form-control"
                    required
                >

            </div>

            <div class="form-check mb-2">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="uniforme_devuelto"
                >

                <label class="form-check-label">

                    Uniforme devuelto

                </label>

            </div>

            <div class="form-check mb-2">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="botas_devueltas"
                >

                <label class="form-check-label">

                    Botas devueltas

                </label>

            </div>

            <div class="form-check mb-2">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="credencial_devuelta"
                >

                <label class="form-check-label">

                    Credencial devuelta

                </label>

            </div>

            <div class="form-check mb-2">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="radio_devuelto"
                >

                <label class="form-check-label">

                    Radio devuelto

                </label>

            </div>

            <div class="form-check mb-2">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="carta_renuncia"
                >

                <label class="form-check-label">

                    Carta renuncia recibida

                </label>

            </div>

            <div class="form-check mb-4">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="finiquito_entregado"
                >

                <label class="form-check-label">

                    Finiquito entregado

                </label>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    class="form-control"
                    rows="4"
                ></textarea>

            </div>

            <button
                class="btn btn-danger"
            >

                Dar de baja

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection
