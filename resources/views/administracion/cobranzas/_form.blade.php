<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">

            Factura

        </label>

        <select
            name="factura_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione...

            </option>

            @foreach($facturas as $factura)

                <option
                    value="{{ $factura->id }}"
                    @selected(
                        old(
                            'factura_id',
                            $cobranza->factura_id ?? ''
                        ) == $factura->id
                    )
                >

                    {{ $factura->folio }}

                    -

                    {{ $factura->cliente->razon_social }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Fecha de vencimiento

        </label>

        <input
            type="date"
            name="fecha_vencimiento"
            class="form-control"
            value="{{ old('fecha_vencimiento', isset($cobranza) && $cobranza->fecha_vencimiento ? $cobranza->fecha_vencimiento->format('Y-m-d') : '') }}"
            required
        >

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">

            Fecha de pago

        </label>

        <input
            type="date"
            name="fecha_pago"
            class="form-control"
            value="{{ old('fecha_pago', isset($cobranza) && $cobranza->fecha_pago ? $cobranza->fecha_pago->format('Y-m-d') : '') }}"
        >

    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Monto

        </label>

        <input
            type="text"
            class="form-control"
            value="{{ isset($cobranza) ? number_format($cobranza->monto,2) : 'Se cargará automáticamente' }}"
            readonly
        >

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Estado

        </label>

        <select
            name="estado"
            class="form-select"
            required
        >

            <option value="pendiente"
                @selected(
                    old(
                        'estado',
                        $cobranza->estado ?? 'pendiente'
                    )=='pendiente'
                )
            >

                Pendiente

            </option>

            <option value="revision"
                @selected(
                    old(
                        'estado',
                        $cobranza->estado ?? ''
                    )=='revision'
                )
            >

                En revisión

            </option>

            <option value="pagada"
                @selected(
                    old(
                        'estado',
                        $cobranza->estado ?? ''
                    )=='pagada'
                )
            >

                Pagada

            </option>

            <option value="vencida"
                @selected(
                    old(
                        'estado',
                        $cobranza->estado ?? ''
                    )=='vencida'
                )
            >

                Vencida

            </option>

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Referencia de pago

        </label>

        <input
            type="text"
            name="referencia_pago"
            class="form-control"
            value="{{ old('referencia_pago', $cobranza->referencia_pago ?? '') }}"
        >

    </div>

</div>

<div class="mb-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        class="form-control"
        rows="4"
    >{{ old('observaciones', $cobranza->observaciones ?? '') }}</textarea>

</div>

<div class="text-end">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('administracion.cobranzas.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
