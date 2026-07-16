<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Categoría

        </label>

        <select
            name="categoria_producto_id"
            class="form-select"
        >

            <option value="">

                Seleccione una categoría

            </option>

            @foreach($categorias as $categoria)

                <option
                    value="{{ $categoria->id }}"
                    @selected(old('categoria_producto_id', $producto->categoria_producto_id ?? '') == $categoria->id)
                >

                    {{ $categoria->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="Código"
            name="codigo"
            type="text"
            :value="old('codigo', $producto->codigo ?? '')"
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Nombre"
            name="nombre"
            type="text"
            :value="old('nombre', $producto->nombre ?? '')"
        />

    </div>

    <div class="col-md-6">

        <label class="form-label">

            Unidad de medida

        </label>

        <select
            name="unidad_medida"
            class="form-select"
        >

            @foreach([
                'Pieza',
                'Caja',
                'Par',
                'Paquete',
                'Juego',
                'Kilogramo',
                'Litro',
                'Metro'
            ] as $unidad)

                <option
                    value="{{ $unidad }}"
                    @selected(old('unidad_medida', $producto->unidad_medida ?? 'Pieza') == $unidad)
                >

                    {{ $unidad }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <x-rh.input-rh
            label="Stock mínimo"
            name="stock_minimo"
            type="number"
            :value="old('stock_minimo', $producto->stock_minimo ?? 0)"
        />

    </div>

    <div class="col-md-6">

        <x-rh.input-rh
            label="Precio de compra"
            name="precio_compra"
            type="number"
            step="0.01"
            :value="old('precio_compra', $producto->precio_compra ?? 0)"
        />

    </div>

</div>

<div class="mt-3">

    <label class="form-label">

        Tipo de producto

    </label>

    <select
        name="tipo_producto"
        class="form-select"
    >

        <option
            value="consumible"
            @selected(old('tipo_producto', $producto->tipo_producto ?? 'consumible') == 'consumible')
        >

            Consumible

        </option>

        <option
            value="activo"
            @selected(old('tipo_producto', $producto->tipo_producto ?? '') == 'activo')
        >

            Activo

        </option>

    </select>

</div>

<div class="mt-3">

    <label class="form-label">

        Descripción

    </label>

    <textarea
        name="descripcion"
        rows="4"
        class="form-control"
    >{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button class="btn btn-primary">

        {{ isset($producto) ? 'Actualizar' : 'Guardar' }}

    </button>

    <a
        href="{{ route('administracion.productos.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
