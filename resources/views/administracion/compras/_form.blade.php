<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Proveedor

        </label>

        <select
            name="proveedor_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un proveedor

            </option>

            @foreach($proveedores as $proveedor)

                <option
                    value="{{ $proveedor->id }}"
                    @selected(
                        old(
                            'proveedor_id',
                            $compra->proveedor_id ?? ''
                        ) == $proveedor->id
                    )
                >

                    {{ $proveedor->razon_social }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3">

        <label class="form-label">

            Fecha de compra

        </label>

        <input
            type="date"
            name="fecha_compra"
            class="form-control"
            value="{{ old('fecha_compra', isset($compra) ? $compra->fecha_compra->format('Y-m-d') : date('Y-m-d')) }}"
            required
        >

    </div>

    <div class="col-md-3">

        <label class="form-label">

            Estado

        </label>

        <select
            name="estado"
            class="form-select"
            required
        >

            <option
                value="pendiente"
                @selected(old('estado', $compra->estado ?? 'pendiente') == 'pendiente')
            >

                Pendiente

            </option>

            <option
                value="recibida"
                @selected(old('estado', $compra->estado ?? '') == 'recibida')
            >

                Recibida

            </option>

            <option
                value="cancelada"
                @selected(old('estado', $compra->estado ?? '') == 'cancelada')
            >

                Cancelada

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
    >{{ old('observaciones', $compra->observaciones ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('administracion.compras.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
