<!-- 01 · INFORMACIÓN DE LA COTIZACIÓN -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>01</span>

        Información de la cotización

    </div>

    <div class="row g-3">

        <div class="col-md-6">

            <label
                for="prospecto_comercial_id"
                class="form-label"
            >

                Prospecto

            </label>

            <select
                name="prospecto_comercial_id"
                id="prospecto_comercial_id"
                class="form-select gtri-input"
                required
            >

                <option value="">

                    Seleccione un prospecto

                </option>

                @foreach($prospectos as $prospecto)

                    <option
                        value="{{ $prospecto->id }}"
                        @selected(
                            old(
                                'prospecto_comercial_id',
                                $cotizacion->prospecto_comercial_id ?? ''
                            ) == $prospecto->id
                        )
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
                :value="old('folio', $cotizacion->folio ?? '')"
                placeholder="Ej. COT-2026-001"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Fecha"
                name="fecha"
                type="date"
                :value="old(
                    'fecha',
                    isset($cotizacion)
                        ? $cotizacion->fecha?->format('Y-m-d')
                        : now()->format('Y-m-d')
                )"
                required
            />

        </div>

    </div>

</div>


<!-- 02 · INFORMACIÓN COMERCIAL -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Información comercial

    </div>

    <div class="row g-3">

        <div class="col-md-3">

            <x-rh.input-rh
                label="Monto"
                name="monto"
                type="number"
                step="0.01"
                :value="old('monto', $cotizacion->monto ?? '')"
                placeholder="Ej. 25000.00"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Plazas"
                name="numero_plazas"
                type="number"
                :value="old('numero_plazas', $cotizacion->numero_plazas ?? '')"
                placeholder="Ej. 5"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Vigencia (días)"
                name="vigencia_dias"
                type="number"
                :value="old('vigencia_dias', $cotizacion->vigencia_dias ?? '')"
                placeholder="Ej. 30"
                required
            />

        </div>

        <div class="col-md-3">

            <label
                for="estatus"
                class="form-label"
            >

                Estatus

            </label>

            <select
                name="estatus"
                id="estatus"
                class="form-select gtri-input"
            >

                <option
                    value="pendiente"
                    @selected(
                        old(
                            'estatus',
                            $cotizacion->estatus ?? 'pendiente'
                        ) == 'pendiente'
                    )
                >

                    Pendiente

                </option>

                <option
                    value="aceptada"
                    @selected(
                        old(
                            'estatus',
                            $cotizacion->estatus ?? ''
                        ) == 'aceptada'
                    )
                >

                    Aceptada

                </option>

                <option
                    value="rechazada"
                    @selected(
                        old(
                            'estatus',
                            $cotizacion->estatus ?? ''
                        ) == 'rechazada'
                    )
                >

                    Rechazada

                </option>

                <option
                    value="cancelada"
                    @selected(
                        old(
                            'estatus',
                            $cotizacion->estatus ?? ''
                        ) == 'cancelada'
                    )
                >

                    Cancelada

                </option>

            </select>

        </div>

    </div>

</div>


<!-- 03 · OBSERVACIONES -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Observaciones

    </div>

    <div class="row g-3">

        <div class="col-12">

            <label
                for="observaciones"
                class="form-label"
            >

                Observaciones de la cotización

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Ej. Cotización para servicio de seguridad privada en 5 plazas, turno de 12 horas..."
            >{{ old('observaciones', $cotizacion->observaciones ?? '') }}</textarea>

        </div>

    </div>

</div>


<!-- 04 · ACCIONES -->

<div class="gtri-section mb-0">

    <div class="d-flex justify-content-end gap-2 flex-wrap">

        <a
            href="{{ route('comercial.cotizaciones.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-lg me-1"></i>

            Cancelar

        </a>

        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-check-circle me-1"></i>

            Guardar cotización

        </button>

    </div>

</div>