@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Nuevo Prospecto

    </h1>

    <x-rh.card-rh titulo="Registro de candidato">

        <form
            method="POST"
            action="{{ route('rh.prospectos.store') }}"
        >

            @csrf

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        required
                    >

                </div>

                <div class="col-md-4 mb-3">

                    <label>Apellido paterno</label>

                    <input
                        type="text"
                        name="apellido_paterno"
                        class="form-control"
                        required
                    >

                </div>

                <div class="col-md-4 mb-3">

                    <label>Apellido materno</label>

                    <input
                        type="text"
                        name="apellido_materno"
                        class="form-control"
                    >

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Teléfono</label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                    >

                </div>

                <div class="col-md-4 mb-3">

                    <label>Correo</label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                    >

                </div>

                <div class="col-md-4 mb-3">

                    <label>Puesto solicitado</label>

                    <input
                        type="text"
                        name="puesto_solicitado"
                        class="form-control"
                    >

                </div>

            </div>

            <div class="mb-3">

                <label>Fecha entrevista</label>

                <input
                    type="date"
                    name="fecha_entrevista"
                    class="form-control"
                >

            </div>

            <div class="mb-4">

                <label>Observaciones</label>

                <textarea
                    name="observaciones"
                    class="form-control"
                    rows="3"
                ></textarea>

            </div>

            <button
                class="btn btn-primary"
            >

                Registrar Prospecto

            </button>

        </form>

    </x-rh.card-rh>

</div>

@endsection
