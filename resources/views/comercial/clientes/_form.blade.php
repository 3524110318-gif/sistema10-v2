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
                :value="old('razon_social', $cliente->razon_social ?? '')"
                placeholder="Ej. Seguridad Empresarial del Centro S.A. de C.V."
                required
            />

        </div>

        <div class="col-md-6">

            <x-rh.input-rh
                label="RFC"
                name="rfc"
                type="text"
                :value="old('rfc', $cliente->rfc ?? '')"
                placeholder="Ej. SEC240101ABC"
                required
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
                label="Representante Legal"
                name="representante_legal"
                type="text"
                :value="old('representante_legal', $cliente->representante_legal ?? '')"
                placeholder="Ej. Carlos Hernández López"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Teléfono"
                name="telefono"
                type="text"
                :value="old('telefono', $cliente->telefono ?? '')"
                placeholder="Ej. 222 123 4567"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Correo"
                name="correo"
                type="email"
                :value="old('correo', $cliente->correo ?? '')"
                placeholder="Ej. contacto@empresa.com"
                required
            />

        </div>

    </div>

</div>


<!-- 03 · INFORMACIÓN FISCAL -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Información fiscal

    </div>

    <div class="row g-3">

        <div class="col-md-8">

            <label
                for="domicilio_fiscal"
                class="form-label"
            >

                Domicilio Fiscal

            </label>

            <textarea
                name="domicilio_fiscal"
                id="domicilio_fiscal"
                class="form-control gtri-textarea"
                rows="3"
                placeholder="Ej. Av. Reforma #125, Col. Centro, Puebla, Puebla"
            >{{ old('domicilio_fiscal', $cliente->domicilio_fiscal ?? '') }}</textarea>

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
                    @selected(old('estatus', $cliente->estatus ?? '') == '')
                >

                    Seleccione un estatus

                </option>

                <option
                    value="activo"
                    @selected(old('estatus', $cliente->estatus ?? '') == 'activo')
                >

                    Activo

                </option>

                <option
                    value="inactivo"
                    @selected(old('estatus', $cliente->estatus ?? '') == 'inactivo')
                >

                    Inactivo

                </option>

            </select>

        </div>

    </div>

</div>


<!-- 04 · ACCIONES -->

<div class="gtri-section mb-0">

    <div class="d-flex justify-content-end gap-2 flex-wrap">

        <a
            href="{{ route('comercial.clientes.index') }}"
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

            Guardar cliente

        </button>

    </div>

</div>