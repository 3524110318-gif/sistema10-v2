<div class="row">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Razón Social"
            name="razon_social"
            type="text"
            :value="old('razon_social', $prospecto->razon_social ?? '')"
            required
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="RFC"
            name="rfc"
            type="text"
            :value="old('rfc', $prospecto->rfc ?? '')"
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Contacto"
            name="contacto"
            type="text"
            :value="old('contacto', $prospecto->contacto ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Teléfono"
            name="telefono"
            type="text"
            :value="old('telefono', $prospecto->telefono ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Correo"
            name="correo"
            type="email"
            :value="old('correo', $prospecto->correo ?? '')"
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-8">

        <label class="form-label">

            Dirección

        </label>

        <textarea
            name="direccion"
            class="form-control"
            rows="2"
        >{{ old('direccion', $prospecto->direccion ?? '') }}</textarea>

    </div>

    <div class="col-md-2">

        <x-rh.input-rh
            label="Tarifa"
            name="tarifa"
            type="number"
            step="0.01"
            :value="old('tarifa', $prospecto->tarifa ?? 0)"
            required
        />

    </div>

    <div class="col-md-2">

        <x-rh.input-rh
            label="Plazas"
            name="numero_plazas"
            type="number"
            :value="old('numero_plazas', $prospecto->numero_plazas ?? 0)"
            required
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-4">

        <label class="form-label">

            Estatus

        </label>

        <select
            name="estatus"
            class="form-select"
        >

            <option value="nuevo"
                @selected(old('estatus', $prospecto->estatus ?? '')=='nuevo')>

                Nuevo

            </option>

            <option value="seguimiento"
                @selected(old('estatus', $prospecto->estatus ?? '')=='seguimiento')>

                Seguimiento

            </option>

            <option value="cotizacion"
                @selected(old('estatus', $prospecto->estatus ?? '')=='cotizacion')>

                Cotización

            </option>

            <option value="ganado"
                @selected(old('estatus', $prospecto->estatus ?? '')=='ganado')>

                Ganado

            </option>

            <option value="perdido"
                @selected(old('estatus', $prospecto->estatus ?? '')=='perdido')>

                Perdido

            </option>

        </select>

    </div>

    <div class="col-md-8">

        <label class="form-label">

            Observaciones

        </label>

        <textarea
            name="observaciones"
            class="form-control"
            rows="2"
        >{{ old('observaciones', $prospecto->observaciones ?? '') }}</textarea>

    </div>

</div>

<div class="mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('comercial.prospectos.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>