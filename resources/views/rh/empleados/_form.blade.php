@php

    $editando = isset($empleado);

@endphp


{{-- DATOS PERSONALES --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>01</span>

        Datos personales

    </div>


    <div class="row g-4">

        {{-- FOTOGRAFÍA --}}
        <div class="col-xl-3 col-lg-4">

            <div
                class="rounded-3 p-4 text-center"
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                <label
                    for="foto"
                    class="form-label text-light fw-semibold d-block"
                >

                    {{ $editando ? 'Cambiar fotografía' : 'Fotografía del empleado' }}

                </label>


                <img
                    id="preview-imagen"
                    src="{{
                        $editando && $empleado->foto
                            ? asset(
                                'fotos_empleados/' .
                                $empleado->foto
                            )
                            : 'https://placehold.co/220x220?text=Sin+foto'
                    }}"
                    alt="Vista previa"
                    class="img-fluid rounded-circle shadow mb-3"
                    style="
                        width:190px;
                        height:190px;
                        object-fit:cover;
                        border:4px solid #D4AF37;
                    "
                >


                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="form-control gtri-input"
                    accept="image/*"
                >


                <small class="text-secondary d-block mt-2">

                    Formatos recomendados: JPG, JPEG o PNG.

                </small>

            </div>

        </div>


        {{-- NOMBRE --}}
        <div class="col-xl-9 col-lg-8">

            <div class="row g-3">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Nombre"
                        name="nombre"
                        type="text"
                        :value="$editando ? $empleado->nombre : ''"
                    />

                </div>


                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Apellido paterno"
                        name="apellido_paterno"
                        type="text"
                        :value="$editando ? $empleado->apellido_paterno : ''"
                    />

                </div>


                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Apellido materno"
                        name="apellido_materno"
                        type="text"
                        :value="$editando ? $empleado->apellido_materno : ''"
                    />

                </div>

            </div>

        </div>

    </div>

</div>


{{-- DOCUMENTOS --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Documentos de identidad

    </div>


    <div class="row g-3">

        <div class="col-md-4">

            <x-rh.input-rh
                label="CURP"
                name="curp"
                type="text"
                :value="$editando ? $empleado->curp : ''"
            />

        </div>


        <div class="col-md-4">

            <x-rh.input-rh
                label="RFC"
                name="rfc"
                type="text"
                :value="$editando ? $empleado->rfc : ''"
            />

        </div>


        <div class="col-md-4">

            <x-rh.input-rh
                label="NSS"
                name="nss"
                type="text"
                :value="$editando ? $empleado->nss : ''"
            />

        </div>

    </div>

</div>


{{-- CONTACTO --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Información de contacto

    </div>


    <div class="row g-3">

        <div class="col-md-6">

            <x-rh.input-rh
                label="Teléfono"
                name="telefono"
                type="text"
                :value="$editando ? $empleado->telefono : ''"
            />

        </div>


        <div class="col-md-6">

            <x-rh.input-rh
                label="Correo electrónico"
                name="correo"
                type="email"
                :value="$editando ? $empleado->correo : ''"
            />

        </div>

    </div>

</div>


{{-- INFORMACIÓN RH --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>04</span>

        Información de Recursos Humanos

    </div>


    <div class="row g-3">

        <div class="col-xl-3 col-md-6">

            <x-rh.input-rh
                label="Tipo de sangre"
                name="tipo_sangre"
                type="text"
                :value="$editando ? $empleado->tipo_sangre : ''"
            />

        </div>


        <div class="col-xl-3 col-md-6">

            <x-rh.input-rh
                label="Puesto"
                name="puesto"
                type="text"
                :value="$editando ? $empleado->puesto : ''"
            />

        </div>


        <div class="col-xl-3 col-md-6">

            <x-rh.input-rh
                label="Rango"
                name="rango"
                type="text"
                :value="$editando ? $empleado->rango : ''"
            />

        </div>


        <div class="col-xl-3 col-md-6">

            <x-rh.input-rh
                label="Salario base"
                name="salario_base"
                type="number"
                :value="$editando ? $empleado->salario_base : ''"
            />

        </div>

    </div>

</div>


{{-- FECHAS --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>05</span>

        Fechas importantes

    </div>


    <div class="row g-3">

        <div class="col-md-6">

            <x-rh.input-rh
                label="Fecha de nacimiento"
                name="fecha_nacimiento"
                type="date"
                :value="$editando ? $empleado->fecha_nacimiento : ''"
            />

        </div>


        <div class="col-md-6">

            <x-rh.input-rh
                label="Fecha de ingreso"
                name="fecha_ingreso"
                type="date"
                :value="$editando ? $empleado->fecha_ingreso : ''"
            />

        </div>

    </div>

</div>


{{-- DIRECCIÓN --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>06</span>

        Dirección

    </div>


    <x-rh.textarea-rh
        label="Dirección completa"
        name="direccion"
    >{{ old(
        'direccion',
        $editando ? $empleado->direccion : ''
    ) }}</x-rh.textarea-rh>

</div>


{{-- CONTACTO DE EMERGENCIA --}}
<div class="gtri-section">

    <div class="gtri-section-title">

        <span>07</span>

        Contacto de emergencia

    </div>


    <div class="row g-3">

        <div class="col-md-6">

            <x-rh.input-rh
                label="Nombre del contacto"
                name="contacto_emergencia"
                type="text"
                :value="$editando ? $empleado->contacto_emergencia : ''"
            />

        </div>


        <div class="col-md-6">

            <x-rh.input-rh
                label="Teléfono de emergencia"
                name="telefono_emergencia"
                type="text"
                :value="$editando ? $empleado->telefono_emergencia : ''"
            />

        </div>

    </div>

</div>


{{-- ACCIONES --}}
<div class="gtri-section mb-0">

    <div class="d-flex flex-wrap justify-content-end gap-2">

        <a
            href="{{
                $editando
                    ? route(
                        'rh.empleados.show',
                        $empleado->id
                    )
                    : route('rh.empleados')
            }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-circle me-1"></i>

            Cancelar

        </a>


        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-floppy me-1"></i>

            {{ $editando ? 'Actualizar empleado' : 'Guardar empleado' }}

        </button>

    </div>

</div>


<script>

    const inputFoto = document.getElementById('foto');
    const previewImagen = document.getElementById('preview-imagen');

    if (inputFoto && previewImagen) {

        inputFoto.addEventListener('change', function (event) {

            const archivo = event.target.files[0];

            if (archivo) {

                previewImagen.src = URL.createObjectURL(archivo);

            }

        });

    }

</script>