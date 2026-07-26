
<!-- 01 · INFORMACIÓN DE LA EMPRESA -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>01</span>

        Información de la empresa

    </div>

    <div class="row g-3">

        <div class="col-md-6">

            <x-rh.input-rh
                label="Razón Social"
                name="razon_social"
                type="text"
                :value="old('razon_social', $prospecto->razon_social ?? '')"
                placeholder="Ej. Seguridad Empresarial del Centro S.A. de C.V."
                required
            />

        </div>

        <div class="col-md-6">

            <x-rh.input-rh
                label="RFC"
                name="rfc"
                type="text"
                :value="old('rfc', $prospecto->rfc ?? '')"
                placeholder="Ej. SEC240101ABC"
            />

        </div>

    </div>

</div>


<!-- 02 · INFORMACIÓN DE CONTACTO -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Información de contacto

    </div>

    <div class="row g-3">

        <div class="col-md-6">

            <x-rh.input-rh
                label="Contacto"
                name="contacto"
                type="text"
                :value="old('contacto', $prospecto->contacto ?? '')"
                placeholder="Ej. Carlos Hernández López"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Teléfono"
                name="telefono"
                type="text"
                :value="old('telefono', $prospecto->telefono ?? '')"
                placeholder="Ej. 222 123 4567"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Correo"
                name="correo"
                type="email"
                :value="old('correo', $prospecto->correo ?? '')"
                placeholder="Ej. contacto@empresa.com"
            />

        </div>

        <div class="col-12">

            <label
                for="direccion"
                class="form-label"
            >

                Dirección

            </label>

            <textarea
                name="direccion"
                id="direccion"
                class="form-control gtri-textarea"
                rows="3"
                placeholder="Ej. Av. Reforma #125, Col. Centro, Puebla, Puebla"
            >{{ old('direccion', $prospecto->direccion ?? '') }}</textarea>

        </div>

    </div>

</div>


<!-- 03 · INFORMACIÓN COMERCIAL -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Información comercial

    </div>

    <div class="row g-3">

        <div class="col-md-4">

            <x-rh.input-rh
                label="Tarifa"
                name="tarifa"
                type="number"
                step="0.01"
                :value="old('tarifa', $prospecto->tarifa ?? '')"
                placeholder="Ej. 18500.00"
                required
            />

        </div>

        <div class="col-md-4">

            <x-rh.input-rh
                label="Plazas"
                name="numero_plazas"
                type="number"
                :value="old('numero_plazas', $prospecto->numero_plazas ?? '')"
                placeholder="Ej. 5"
                required
            />

        </div>

        <div class="col-md-4">

            <label
                for="estatus"
                class="form-label"
            >

                Estatus

            </label>

            <select
                name="estatus"
                id="estatus"
                class="form-select gtri-input"
            >

                <option
                    value=""
                    disabled
                    @selected(old('estatus', $prospecto->estatus ?? '') == '')
                >

                    Seleccione un estatus

                </option>

                <option
                    value="nuevo"
                    @selected(old('estatus', $prospecto->estatus ?? '') == 'nuevo')
                >

                    Nuevo

                </option>

                <option
                    value="seguimiento"
                    @selected(old('estatus', $prospecto->estatus ?? '') == 'seguimiento')
                >

                    Seguimiento

                </option>

                <option
                    value="cotizacion"
                    @selected(old('estatus', $prospecto->estatus ?? '') == 'cotizacion')
                >

                    Cotización

                </option>

                <option
                    value="ganado"
                    @selected(old('estatus', $prospecto->estatus ?? '') == 'ganado')
                >

                    Ganado

                </option>

                <option
                    value="perdido"
                    @selected(old('estatus', $prospecto->estatus ?? '') == 'perdido')
                >

                    Perdido

                </option>

            </select>

        </div>

        <div class="col-12">

            <label
                for="observaciones"
                class="form-label"
            >

                Observaciones

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Ej. Cliente interesado en servicio de seguridad para 5 plazas. Solicita seguimiento y propuesta comercial..."
            >{{ old('observaciones', $prospecto->observaciones ?? '') }}</textarea>

        </div>

    </div>

</div>


<!-- 04 · ACCIONES -->

<div class="gtri-section mb-0">

    <div class="d-flex justify-content-end gap-2 flex-wrap">

        <a
            href="{{ route('comercial.prospectos.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-lg me-1"></i>

            Cancelar

        </a>

        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-check-circle me-1"></i>

            Guardar prospecto

        </button>

    </div>

</div>
