@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        EDITAR EMPLEADO

    </h1>


    <div class="card shadow rounded-4">

        <div class="card-body">

            <form

                method="POST"

                action="{{ route('rh.empleados.update', $empleado->id) }}"

                enctype="multipart/form-data"

            >

                @csrf
                @method('PUT')


                <!-- DATOS PERSONALES -->

                <x-rh.card-rh titulo="Datos personales">

                    <div class="row">

                        <div class="col-md-4 mb-4">

                            @if ($empleado->foto)

                                <img

                                    id="preview-imagen"

                                    src="{{ asset('fotos_empleados/' . $empleado->foto) }}"

                                    class="img-fluid rounded-circle shadow mb-3"

                                    style="

                                        width: 220px;

                                        height: 220px;

                                        object-fit: cover;

                                    "

                                >

                            @endif


                            <label class="form-label">

                                Cambiar fotografía

                            </label>

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
                                :value="$empleado->nombre"
                            />

                        </div>


                        <div class="col-md-4">

                            <x-rh.input-rh
                                label="Apellido paterno"
                                name="apellido_paterno"
                                type="text"
                                :value="$empleado->apellido_paterno"
                            />

                        </div>


                        <div class="col-md-4">

                            <x-rh.input-rh
                                label="Apellido materno"
                                name="apellido_materno"
                                type="text"
                                :value="$empleado->apellido_materno"
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
                                :value="$empleado->curp"
                            />

                        </div>


                        <div class="col-md-4">

                            <x-rh.input-rh
                                label="RFC"
                                name="rfc"
                                type="text"
                                :value="$empleado->rfc"
                            />

                        </div>


                        <div class="col-md-4">

                            <x-rh.input-rh
                                label="NSS"
                                name="nss"
                                type="text"
                                :value="$empleado->nss"
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
                                :value="$empleado->telefono"
                            />

                        </div>


                        <div class="col-md-6">

                            <x-rh.input-rh
                                label="Correo"
                                name="correo"
                                type="email"
                                :value="$empleado->correo"
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
                                :value="$empleado->tipo_sangre"
                            />

                        </div>


                        <div class="col-md-3">

                            <x-rh.input-rh
                                label="Puesto"
                                name="puesto"
                                type="text"
                                :value="$empleado->puesto"
                            />

                        </div>


                        <div class="col-md-3">

                            <x-rh.input-rh
                                label="Rango"
                                name="rango"
                                type="text"
                                :value="$empleado->rango"
                            />

                        </div>


                        <div class="col-md-3">

                            <x-rh.input-rh
                                label="Salario base"
                                name="salario_base"
                                type="number"
                                :value="$empleado->salario_base"
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
                                :value="$empleado->fecha_nacimiento"
                            />

                        </div>


                        <div class="col-md-6">

                            <x-rh.input-rh
                                label="Fecha ingreso"
                                name="fecha_ingreso"
                                type="date"
                                :value="$empleado->fecha_ingreso"
                            />

                        </div>

                    </div>

                </x-rh.card-rh>


                <!-- DIRECCION -->

                <x-rh.card-rh titulo="Dirección">

                    <x-rh.textarea-rh
                        label="Dirección"
                        name="direccion"
                    >

                        {{ $empleado->direccion }}

                    </x-rh.textarea-rh>

                </x-rh.card-rh>


                <!-- CONTACTO EMERGENCIA -->

                <x-rh.card-rh titulo="Contacto emergencia">

                    <div class="row">

                        <div class="col-md-6">

                            <x-rh.input-rh
                                label="Contacto emergencia"
                                name="contacto_emergencia"
                                type="text"
                                :value="$empleado->contacto_emergencia"
                            />

                        </div>


                        <div class="col-md-6">

                            <x-rh.input-rh
                                label="Teléfono emergencia"
                                name="telefono_emergencia"
                                type="text"
                                :value="$empleado->telefono_emergencia"
                            />

                        </div>

                    </div>

                </x-rh.card-rh>


                <!-- BOTON -->

                <div class="text-end mt-4">

                    <button

                        class="btn btn-warning btn-lg px-5 rounded-3 shadow-sm"

                    >

                        Actualizar empleado

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>

    document

        .getElementById('foto')

        .addEventListener('change', function(event) {

            const imagen = document

                .getElementById('preview-imagen');


            const archivo = event.target.files[0];


            if (archivo) {

                imagen.src = URL.createObjectURL(archivo);

            }

        });

</script>

@endsection