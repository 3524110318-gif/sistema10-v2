@php

    $editando = isset($empleado);

@endphp

{{-- FOTOGRAFÍA Y DATOS PERSONALES --}}
<div class="row g-4 align-items-start">

    {{-- FOTOGRAFÍA --}}
    <div class="col-xl-3 col-lg-4 col-md-5">

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Fotografía

            </div>


            <div class="text-center">

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
                    class="img-fluid rounded-circle shadow"
                    style="
                        width:190px;
                        height:190px;
                        object-fit:cover;
                        border:4px solid var(--gtri-gold);
                    "
                >


                <div
                    class="mx-auto my-3"
                    style="
                        width:80%;
                        height:1px;
                        background:linear-gradient(
                            to right,
                            transparent,
                            rgba(212,169,53,.8),
                            transparent
                        );
                    "
                ></div>


                <label
                    for="foto"
                    class="btn gtri-btn-secondary px-3 py-2"
                >

                    <i class="bi bi-camera me-2"></i>

                    {{ $editando
                        ? 'Cambiar fotografía'
                        : 'Seleccionar fotografía'
                    }}

                </label>


                <input
                    type="file"
                    name="foto"
                    id="foto"
                    class="d-none"
                    accept="image/*"
                >


                <small
                    id="nombre-archivo"
                    class="text-secondary d-block mt-3"
                >

                    Ningún archivo seleccionado

                </small>


                <small class="text-secondary d-block mt-3">

                    Formatos permitidos

                </small>

                <small class="text-warning fw-semibold d-block">

                    JPG · JPEG · PNG

                </small>

            </div>

        </div>

    </div>


    {{-- DATOS PERSONALES --}}
    <div class="col-xl-9 col-lg-8 col-md-7">

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos personales

            </div>


            <div class="row g-3">

                <div class="col-12">

                    <x-rh.input-rh
                        label="Nombre"
                        name="nombre"
                        type="text"
                        placeholder="Ej. Juan Carlos"
                        :value="$editando
                            ? $empleado->nombre
                            : ''
                        "
                    />

                </div>


                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Apellido paterno"
                        name="apellido_paterno"
                        type="text"
                        placeholder="Ej. Hernández"
                        :value="$editando
                            ? $empleado->apellido_paterno
                            : ''
                        "
                    />

                </div>


                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Apellido materno"
                        name="apellido_materno"
                        type="text"
                        placeholder="Ej. Ramírez"
                        :value="$editando
                            ? $empleado->apellido_materno
                            : ''
                        "
                    />

                </div>


                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de nacimiento"
                        name="fecha_nacimiento"
                        type="date"
                        :value="$editando
                            ? $empleado->fecha_nacimiento
                            : ''
                        "
                    />

                </div>


                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de ingreso"
                        name="fecha_ingreso"
                        type="date"
                        :value="$editando
                            ? $empleado->fecha_ingreso
                            : ''
                        "
                    />

                </div>

            </div>

        </div>

    </div>

</div>

{{-- INFORMACIÓN PRINCIPAL --}}
<div class="gtri-expediente-main-grid">

    {{-- DOCUMENTOS DE IDENTIDAD --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Documentos de identidad

        </div>


        <div class="row g-3">

            <div class="col-12">

                <x-rh.input-rh
                    label="CURP"
                    name="curp"
                    type="text"
                    placeholder="Ej. LOTM980722MPLRRO2"
                    style="text-transform: uppercase;"
                    oninput="this.value = this.value.toUpperCase()"
                    :value="$editando ? $empleado->curp : ''"
                />

            </div>


            <div class="col-md-6">

                <x-rh.input-rh
                    label="RFC"
                    name="rfc"
                    type="text"
                    placeholder="Ej. LOTM980722CD2"
                    style="text-transform: uppercase;"
                    oninput="this.value = this.value.toUpperCase()"
                    :value="$editando ? $empleado->rfc : ''"
                />

            </div>


            <div class="col-md-6">

                <x-rh.input-rh
                    label="NSS"
                    name="nss"
                    type="text"
                    placeholder="Ej. 12345678901"
                    :value="$editando
                        ? $empleado->nss
                        : ''
                    "
                />

            </div>

        </div>

    </div>


    {{-- INFORMACIÓN DE CONTACTO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Información de contacto

        </div>


        <div class="row g-3">

            <div class="col-12">

                <x-rh.input-rh
                    label="Teléfono"
                    name="telefono"
                    type="text"
                    placeholder="Ej. 222 123 4567"
                    :value="$editando
                        ? $empleado->telefono
                        : ''
                    "
                />

            </div>


            <div class="col-12">

                <x-rh.input-rh
                    label="Correo electrónico"
                    name="correo"
                    type="email"
                    placeholder="Ej. empleado@correo.com"
                    :value="$editando
                        ? $empleado->correo
                        : ''
                    "
                />

            </div>

        </div>

    </div>


    {{-- INFORMACIÓN DE RECURSOS HUMANOS --}}
    <div class="gtri-section gtri-section-wide">

        <div class="gtri-section-title">

            <span>04</span>

            Información de Recursos Humanos

        </div>


        <div class="row g-3">

            <div class="col-xl-3 col-md-6">

                <x-rh.input-rh
                    label="Puesto"
                    name="puesto"
                    type="text"
                    placeholder="Ej. Guardia de seguridad"
                    :value="$editando
                        ? $empleado->puesto
                        : ''
                    "
                />

            </div>


            <div class="col-xl-3 col-md-6">

                <x-rh.input-rh
                    label="Rango"
                    name="rango"
                    type="text"
                    placeholder="Ej. Supervisor"
                    :value="$editando
                        ? $empleado->rango
                        : ''
                    "
                />

            </div>


            <div class="col-xl-3 col-md-6">

                <x-rh.input-rh
                    label="Tipo de sangre"
                    name="tipo_sangre"
                    type="text"
                    placeholder="Ej. O+"
                    :value="$editando
                        ? $empleado->tipo_sangre
                        : ''
                    "
                />

            </div>


            <div class="col-xl-3 col-md-6">

                <x-rh.input-rh
                    label="Salario base"
                    name="salario_base"
                    type="text"
                    id="salario_base"
                    placeholder="Ej. $12,500.00"
                    :value="$editando
                        ? number_format(
                            $empleado->salario_base,
                            2
                        )
                        : ''
                    "
                />

            </div>

        </div>

    </div>


    {{-- DIRECCIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>05</span>

            Dirección

        </div>


        <x-rh.textarea-rh
            label="Dirección completa"
            name="direccion"
            placeholder="Ej. Calle Reforma No. 25, Col. Centro, Huejotzingo, Puebla, C.P. 74160"
        >{{ old(
            'direccion',
            $editando
                ? $empleado->direccion
                : ''
        ) }}</x-rh.textarea-rh>

    </div>


    {{-- CONTACTO DE EMERGENCIA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>06</span>

            Contacto de emergencia

        </div>


        <div class="row g-3">

            <div class="col-12">

                <x-rh.input-rh
                    label="Nombre del contacto"
                    name="contacto_emergencia"
                    type="text"
                    placeholder="Ej. María Hernández Ramírez"
                    :value="$editando
                        ? $empleado->contacto_emergencia
                        : ''
                    "
                />

            </div>


            <div class="col-12">

                <x-rh.input-rh
                    label="Teléfono de emergencia"
                    name="telefono_emergencia"
                    type="text"
                    placeholder="Ej. 222 987 6543"
                    :value="$editando
                        ? $empleado->telefono_emergencia
                        : ''
                    "
                />

            </div>

        </div>

    </div>

</div>


{{-- ACCIONES --}}
<div class="gtri-section ">

    <div
        class="
            d-flex
            flex-wrap
            justify-content-end
            align-items-center
            gap-2
        "
    >

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

            {{ $editando
                ? 'Actualizar empleado'
                : 'Guardar empleado'
            }}

        </button>

    </div>

</div>

<script>
    const inputFoto = document.getElementById('foto');

const previewImagen = document.getElementById(
    'preview-imagen'
);

const nombreArchivo = document.getElementById(
    'nombre-archivo'
);

if (inputFoto && previewImagen) {

    inputFoto.addEventListener(
        'change',
        function (event) {

            const archivo = event.target.files[0];

            if (archivo) {

                previewImagen.src =
                    URL.createObjectURL(archivo);

                nombreArchivo.textContent =
                    archivo.name;

            }

        }
    );

}
</script>