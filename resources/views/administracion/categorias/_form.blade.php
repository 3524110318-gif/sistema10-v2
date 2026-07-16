<div class="row">

    <div class="col-md-12">

        <x-rh.input-rh
            label="Nombre"
            name="nombre"
            type="text"
            :value="old('nombre', $categoria->nombre ?? '')"
        />

    </div>

</div>

<div class="mt-3">

    <label class="form-label">

        Descripción

    </label>

    <textarea
        name="descripcion"
        rows="4"
        class="form-control"
    >{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button class="btn btn-primary">

        Guardar

    </button>

    <a
        href="{{ route('administracion.categorias.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
