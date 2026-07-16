<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Cliente

        </label>

        <select
            name="cliente_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un cliente

            </option>

            @foreach($clientes as $cliente)

                <option
                    value="{{ $cliente->id }}"
                    @selected(
                        old(
                            'cliente_id',
                            $factura->cliente_id ?? ''
                        ) == $cliente->id
                    )
                >

                    {{ $cliente->razon_social }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6">

        <label class="form-label">

            Contrato

        </label>

        <select
            name="contrato_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un contrato

            </option>

            @foreach($contratos as $contrato)

                <option
                    value="{{ $contrato->id }}"
                    @selected(
                        old(
                            'contrato_id',
                            $factura->contrato_id ?? ''
                        ) == $contrato->id
                    )
                >

                    {{ $contrato->numero_contrato }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-4">

        <label class="form-label">

            Fecha de factura

        </label>

        <input
            type="date"
            name="fecha_factura"
            class="form-control"
            value="{{ old('fecha_factura', isset($factura) && $factura->fecha_factura ? $factura->fecha_factura->format('Y-m-d') : date('Y-m-d')) }}"
            required
        >

    </div>

    <div class="col-md-4">

        <label class="form-label">

            Periodo inicio

        </label>

        <input
            type="date"
            name="periodo_inicio"
            class="form-control"
            value="{{ old('periodo_inicio', isset($factura) && $factura->periodo_inicio ? $factura->periodo_inicio->format('Y-m-d') : '') }}"
            required
        >

    </div>

    <div class="col-md-4">

        <label class="form-label">

            Periodo fin

        </label>

        <input
            type="date"
            name="periodo_fin"
            class="form-control"
            value="{{ old('periodo_fin', isset($factura) && $factura->periodo_fin ? $factura->periodo_fin->format('Y-m-d') : '') }}"
            required
        >

    </div>

</div>

<div class="row mt-3">

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
                value="borrador"
                @selected(old('estado', $factura->estado ?? 'borrador') == 'borrador')
            >

                Borrador

            </option>

            <option
                value="emitida"
                @selected(old('estado', $factura->estado ?? '') == 'emitida')
            >

                Emitida

            </option>

            <option
                value="cancelada"
                @selected(old('estado', $factura->estado ?? '') == 'cancelada')
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
    >{{ old('observaciones', $factura->observaciones ?? '') }}</textarea>

</div>

<hr class="my-4">

@include('administracion.facturas._detalle_servicios')

<div class="mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar factura

    </button>

    <a
        href="{{ route('administracion.facturas.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
