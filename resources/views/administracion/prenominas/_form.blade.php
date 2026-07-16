<div class="row">

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Periodo inicio

        </label>

        <input
            type="date"
            name="periodo_inicio"
            class="form-control"
            value="{{ old('periodo_inicio', isset($prenomina) ? $prenomina->periodo_inicio->format('Y-m-d') : '') }}"
            required
        >

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Periodo fin

        </label>

        <input
            type="date"
            name="periodo_fin"
            class="form-control"
            value="{{ old('periodo_fin', isset($prenomina) ? $prenomina->periodo_fin->format('Y-m-d') : '') }}"
            required
        >

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">

            Estatus

        </label>

        <select
            name="estatus"
            class="form-select"
            required
        >

            <option
                value="abierta"
                @selected(old('estatus', $prenomina->estatus ?? 'abierta') == 'abierta')
            >

                Abierta

            </option>

            <option
                value="cerrada"
                @selected(old('estatus', $prenomina->estatus ?? '') == 'cerrada')
            >

                Cerrada

            </option>

            <option
                value="autorizada"
                @selected(old('estatus', $prenomina->estatus ?? '') == 'autorizada')
            >

                Autorizada

            </option>

        </select>

    </div>

</div>

<div class="mb-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        class="form-control"
        rows="3"
    >{{ old('observaciones', $prenomina->observaciones ?? '') }}</textarea>

</div>

<hr>

@include(
    'administracion.prenominas._detalle_empleados'
)

<div class="text-end mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        <i class="bi bi-check-circle"></i>

        Guardar Prenómina

    </button>

    <a
        href="{{ route('administracion.prenominas.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
