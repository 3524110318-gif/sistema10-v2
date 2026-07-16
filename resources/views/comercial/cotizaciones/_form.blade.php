<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Prospecto

        </label>

        <select
            name="prospecto_comercial_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione

            </option>

            @foreach($prospectos as $prospecto)

                <option
                    value="{{ $prospecto->id }}"
                    @selected(old('prospecto_comercial_id',$cotizacion->prospecto_comercial_id ?? '')==$prospecto->id)
                >

                    {{ $prospecto->razon_social }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Folio"
            name="folio"
            type="text"
            :value="old('folio',$cotizacion->folio ?? '')"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Fecha"
            name="fecha"
            type="date"
            :value="old('fecha',isset($cotizacion) ? $cotizacion->fecha?->format('Y-m-d') : now()->format('Y-m-d'))"
            required
        />

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-3">

        <x-rh.input-rh
            label="Monto"
            name="monto"
            type="number"
            step="0.01"
            :value="old('monto',$cotizacion->monto ?? 0)"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Plazas"
            name="numero_plazas"
            type="number"
            :value="old('numero_plazas',$cotizacion->numero_plazas ?? 1)"
            required
        />

    </div>

    <div class="col-md-3">

        <x-rh.input-rh
            label="Vigencia (días)"
            name="vigencia_dias"
            type="number"
            :value="old('vigencia_dias',$cotizacion->vigencia_dias ?? 30)"
            required
        />

    </div>

    <div class="col-md-3">

        <label class="form-label">

            Estatus

        </label>

        <select
            name="estatus"
            class="form-select"
        >

            <option value="pendiente">Pendiente</option>

            <option value="aceptada">Aceptada</option>

            <option value="rechazada">Rechazada</option>

            <option value="cancelada">Cancelada</option>

        </select>

    </div>

</div>

<div class="mt-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        class="form-control"
        rows="3"
    >{{ old('observaciones',$cotizacion->observaciones ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('comercial.cotizaciones.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>