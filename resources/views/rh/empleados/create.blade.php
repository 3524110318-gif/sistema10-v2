@extends('rh.layouts.app')

@section('contenido')

<h2>NUEVO EMPLEADO</h2>

<x-rh.alert-errors />

<div class="card shadow rounded-4">

    <div class="card-body">

        <form

            method="POST"

            action="{{ route('rh.empleados.store') }}"

            enctype="multipart/form-data"

        >

            @csrf


            <!-- DATOS PERSONALES -->

            <x-rh.card-rh titulo="Datos personales">

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <label class="form-label">

                            Fotografía

                        </label>


                        <img

                            id="preview-imagen"

                            src="https://placehold.co/220x220?text=Sin+foto"

                            class="img-fluid rounded-circle shadow mb-3"

                            style="

                                width: 220px;

                                height: 220px;

                                object-fit: cover;

                            "

                        >


                        <input

                            type="file"

                            name="foto"

                            id="foto"

                            class="form-control"

                        >

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="Nombre"
                            name="nombre"
                            type="text"
                        />

                    </div>


                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="Apellido paterno"
                            name="apellido_paterno"
                            type="text"
                        />

                    </div>


                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="Apellido materno"
                            name="apellido_materno"
                            type="text"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- DOCUMENTOS -->

            <x-rh.card-rh titulo="Documentos">

                <div class="row">

                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="CURP"
                            name="curp"
                            type="text"
                        />

                    </div>


                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="RFC"
                            name="rfc"
                            type="text"
                        />

                    </div>


                    <div class="col-md-4">

                        <x-rh.input-rh
                            label="NSS"
                            name="nss"
                            type="text"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- CONTACTO -->

            <x-rh.card-rh titulo="Contacto">

                <div class="row">

                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Teléfono"
                            name="telefono"
                            type="text"
                        />

                    </div>


                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Correo"
                            name="correo"
                            type="email"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- INFORMACION RH -->

            <x-rh.card-rh titulo="Información RH">

                <div class="row">

                    <div class="col-md-3">

                        <x-rh.input-rh
                            label="Tipo sangre"
                            name="tipo_sangre"
                            type="text"
                        />

                    </div>


                    <div class="col-md-3">

                        <x-rh.input-rh
                            label="Puesto"
                            name="puesto"
                            type="text"
                        />

                    </div>


                    <div class="col-md-3">

                        <x-rh.input-rh
                            label="Rango"
                            name="rango"
                            type="text"
                        />

                    </div>


                    <div class="col-md-3">

                        <x-rh.input-rh
                            label="Salario base"
                            name="salario_base"
                            type="number"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- FECHAS -->

            <x-rh.card-rh titulo="Fechas">

                <div class="row">

                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Fecha nacimiento"
                            name="fecha_nacimiento"
                            type="date"
                        />

                    </div>


                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Fecha ingreso"
                            name="fecha_ingreso"
                            type="date"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- DIRECCION -->

            <x-rh.card-rh titulo="Dirección">

                <x-rh.textarea-rh
                    label="Dirección"
                    name="direccion"
                />

            </x-rh.card-rh>


            <!-- CONTACTO EMERGENCIA -->

            <x-rh.card-rh titulo="Contacto emergencia">

                <div class="row">

                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Contacto emergencia"
                            name="contacto_emergencia"
                            type="text"
                        />

                    </div>


                    <div class="col-md-6">

                        <x-rh.input-rh
                            label="Teléfono emergencia"
                            name="telefono_emergencia"
                            type="text"
                        />

                    </div>

                </div>

            </x-rh.card-rh>


            <!-- BOTON -->

            <div class="mt-4 text-end">

                <button

                    type="submit"

                    class="btn btn-primary btn-lg px-5 rounded-3 shadow-sm"

                >

                    Guardar empleado

                </button>

            </div>

        </form>

    </div>

</div>

<script src="{{ asset('js/rh/preview-imagen.js') }}"></script>

@endsection