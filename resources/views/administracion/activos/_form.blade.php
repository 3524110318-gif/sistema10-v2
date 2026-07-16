<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Producto

        </label>

        <select
            name="producto_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un producto

            </option>

            @foreach($productos as $producto)

                <option
                    value="{{ $producto->id }}"
                    @selected(
                        old(
                            'producto_id',
                            $activo->producto_id ?? ''
                        ) == $producto->id
                    )
                >

                    {{ $producto->codigo }}
                    -
                    {{ $producto->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6">

        <label class="form-label">

            Número de serie

        </label>

        <input
            type="text"
            name="numero_serie"
            class="form-control"
            value="{{ old('numero_serie', $activo->numero_serie ?? '') }}"
        >

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <label class="form-label">

            Marca

        </label>

        <input
            type="text"
            name="marca"
            class="form-control"
            value="{{ old('marca', $activo->marca ?? '') }}"
        >

    </div>

    <div class="col-md-6">

        <label class="form-label">

            Modelo

        </label>

        <input
            type="text"
            name="modelo"
            class="form-control"
            value="{{ old('modelo', $activo->modelo ?? '') }}"
        >

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-4">

        <label class="form-label">

            Fecha de adquisición

        </label>

        <input
            type="date"
            name="fecha_adquisicion"
            class="form-control"
            value="{{ old('fecha_adquisicion', isset($activo) && $activo->fecha_adquisicion ? $activo->fecha_adquisicion->format('Y-m-d') : '') }}"
        >

    </div>

    <div class="col-md-4">

        <label class="form-label">

            Valor

        </label>

        <input
            type="number"
            name="valor"
            class="form-control"
            step="0.01"
            min="0"
            value="{{ old('valor', $activo->valor ?? 0) }}"
            required
        >

    </div>

    <div class="col-md-4">

        <label class="form-label">

            Estado

        </label>

        <select
            name="estado"
            class="form-select"
            required
        >

            <option
                value="disponible"
                @selected(old('estado', $activo->estado ?? 'disponible') == 'disponible')
            >

                Disponible

            </option>

            <option
                value="asignado"
                @selected(old('estado', $activo->estado ?? '') == 'asignado')
            >

                Asignado

            </option>

            <option
                value="mantenimiento"
                @selected(old('estado', $activo->estado ?? '') == 'mantenimiento')
            >

                Mantenimiento

            </option>

            <option
                value="baja"
                @selected(old('estado', $activo->estado ?? '') == 'baja')
            >

                Baja

            </option>

        </select>

    </div>

</div>

<div class="mt-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        rows="4"
        class="form-control"
    >{{ old('observaciones', $activo->observaciones ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('administracion.activos.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
