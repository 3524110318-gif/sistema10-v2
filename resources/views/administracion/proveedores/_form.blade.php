<div class="row">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Razón Social"
            name="razon_social"
            type="text"
            :value="old('razon_social', $proveedor->razon_social ?? '')"
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="RFC"
            name="rfc"
            type="text"
            :value="old('rfc', $proveedor->rfc ?? '')"
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Nombre del contacto"
            name="nombre_contacto"
            type="text"
            :value="old('nombre_contacto', $proveedor->nombre_contacto ?? '')"
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="Teléfono"
            name="telefono"
            type="text"
            :value="old('telefono', $proveedor->telefono ?? '')"
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Correo electrónico"
            name="correo"
            type="email"
            :value="old('correo', $proveedor->correo ?? '')"
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="Ciudad"
            name="ciudad"
            type="text"
            :value="old('ciudad', $proveedor->ciudad ?? '')"
        />

    </div>

</div>

<div class="mt-3">

    <x-rh.input-rh
        label="Dirección"
        name="direccion"
        type="text"
        :value="old('direccion', $proveedor->direccion ?? '')"
    />

</div>

<div class="mt-3">

    <x-rh.input-rh
        label="Código Postal"
        name="codigo_postal"
        type="text"
        :value="old('codigo_postal', $proveedor->codigo_postal ?? '')"
    />

</div>

<div class="mt-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        rows="4"
        class="form-control"
    >{{ old('observaciones', $proveedor->observaciones ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button class="btn btn-primary">

        {{ isset($proveedor) ? 'Actualizar' : 'Guardar' }}

    </button>

    <a
        href="{{ route('administracion.proveedores.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
