<div class="row">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Razón Social"
            name="razon_social"
            type="text"
            :value="old('razon_social',$cliente->razon_social ?? '')"
            required
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="RFC"
            name="rfc"
            type="text"
            :value="old('rfc',$cliente->rfc ?? '')"
            required
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Representante Legal"
            name="representante_legal"
            type="text"
            :value="old('representante_legal',$cliente->representante_legal ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Teléfono"
            name="telefono"
            type="text"
            :value="old('telefono',$cliente->telefono ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Correo"
            name="correo"
            type="email"
            :value="old('correo',$cliente->correo ?? '')"
            required
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-8">

        <label class="form-label">

            Domicilio Fiscal

        </label>

        <textarea
            name="domicilio_fiscal"
            class="form-control"
            rows="2"
        >{{ old('domicilio_fiscal',$cliente->domicilio_fiscal ?? '') }}</textarea>

    </div>

    <div class="col-md-4">

        <label class="form-label">

            Estatus

        </label>

        <select
            name="estatus"
            class="form-select"
        >

            <option
                value="activo"
                @selected(old('estatus',$cliente->estatus ?? '')=='activo')
            >

                Activo

            </option>

            <option
                value="inactivo"
                @selected(old('estatus',$cliente->estatus ?? '')=='inactivo')
            >

                Inactivo

            </option>

        </select>

    </div>

</div>

<div class="mt-4">

    <button
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('comercial.clientes.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>