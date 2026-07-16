<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Cliente

        </label>

        <select
            name="cliente_comercial_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione

            </option>

            @foreach($clientes as $cliente)

                <option
                    value="{{ $cliente->id }}"
                    @selected(old('cliente_comercial_id',$contrato->cliente_comercial_id ?? '')==$cliente->id)
                >

                    {{ $cliente->razon_social }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Folio"
            name="folio"
            type="text"
            :value="old('folio',$contrato->folio ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Tarifa"
            name="tarifa"
            type="number"
            step="0.01"
            :value="old('tarifa',$contrato->tarifa ?? 0)"
            required
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-3">

        <x-rh.input-rh
            label="Fecha Inicio"
            name="fecha_inicio"
            type="date"
            :value="old('fecha_inicio',isset($contrato)?$contrato->fecha_inicio?->format('Y-m-d'):now()->format('Y-m-d'))"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Fecha Fin"
            name="fecha_fin"
            type="date"
            :value="old('fecha_fin',isset($contrato)?$contrato->fecha_fin?->format('Y-m-d'):'')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Plazas"
            name="numero_plazas"
            type="number"
            :value="old('numero_plazas',$contrato->numero_plazas ?? 1)"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Indexación %"
            name="indexacion_anual"
            type="number"
            step="0.01"
            :value="old('indexacion_anual',$contrato->indexacion_anual ?? 0)"
            required
        />

    </div>

</div>

<div class="col-md-6">

    <label class="form-label">

        PDF de Consignas

    </label>

    @if(isset($contrato) && $contrato->pdf_consignas)

        <div class="mb-2">

            <a
                href="{{ asset('storage/'.$contrato->pdf_consignas) }}"
                target="_blank"
                class="btn btn-outline-primary btn-sm"
            >

                <i class="bi bi-file-earmark-pdf"></i>

                Ver PDF actual

            </a>

        </div>

    @endif

    <input
        type="file"
        name="pdf_consignas"
        class="form-control"
        accept="application/pdf"
    >

    <small class="text-muted">

        @if(isset($contrato))

            Si no selecciona un archivo, se conservará el PDF actual.

        @else

            Seleccione el PDF de consignas.

        @endif

    </small>

</div>

<div class="row mt-3">

    <div class="col-md-4">

        <label class="form-label">

            Estado

        </label>

        <select
            name="estado"
            class="form-select"
        >

            <option value="borrador">Borrador</option>

            <option value="pendiente">Pendiente</option>

            <option value="activo">Activo</option>

            <option value="finalizado">Finalizado</option>

            <option value="cancelado">Cancelado</option>

        </select>

    </div>

    <div class="col-md-8">

        <label class="form-label">

            Observaciones

        </label>

        <textarea
            name="observaciones"
            class="form-control"
            rows="3"
        >{{ old('observaciones',$contrato->observaciones ?? '') }}</textarea>

    </div>

</div>

<div class="mt-4">

    <button
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('comercial.contratos.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>