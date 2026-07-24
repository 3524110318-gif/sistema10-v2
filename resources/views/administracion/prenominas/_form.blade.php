<div class="gtri-form">

    {{-- 01 PERIODO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información del periodo

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label
                    for="periodo_inicio"
                    class="gtri-label mb-2"
                >

                    Periodo inicio

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="periodo_inicio"
                    id="periodo_inicio"
                    class="form-control gtri-input"
                    value="{{ old(
                        'periodo_inicio',
                        isset($prenomina)
                            ? $prenomina->periodo_inicio->format('Y-m-d')
                            : ''
                    ) }}"
                    required
                >

            </div>


            <div class="col-md-4">

                <label
                    for="periodo_fin"
                    class="gtri-label mb-2"
                >

                    Periodo fin

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="periodo_fin"
                    id="periodo_fin"
                    class="form-control gtri-input"
                    value="{{ old(
                        'periodo_fin',
                        isset($prenomina)
                            ? $prenomina->periodo_fin->format('Y-m-d')
                            : ''
                    ) }}"
                    required
                >

            </div>


            <div class="col-md-4">

                <label
                    for="estatus"
                    class="gtri-label mb-2"
                >

                    Estatus

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="estatus"
                    id="estatus"
                    class="form-select gtri-select"
                    required
                >

                    <option
                        value="abierta"
                        @selected(
                            old(
                                'estatus',
                                $prenomina->estatus ?? 'abierta'
                            ) == 'abierta'
                        )
                    >
                        Abierta
                    </option>

                    <option
                        value="cerrada"
                        @selected(
                            old(
                                'estatus',
                                $prenomina->estatus ?? ''
                            ) == 'cerrada'
                        )
                    >
                        Cerrada
                    </option>

                    <option
                        value="autorizada"
                        @selected(
                            old(
                                'estatus',
                                $prenomina->estatus ?? ''
                            ) == 'autorizada'
                        )
                    >
                        Autorizada
                    </option>

                </select>

            </div>

        </div>


        <div class="mt-4">

            <label
                for="observaciones"
                class="gtri-label mb-2"
            >

                Observaciones

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="3"
                placeholder="Ingrese observaciones relacionadas con la prenómina..."
            >{{ old(
                'observaciones',
                $prenomina->observaciones ?? ''
            ) }}</textarea>

        </div>

    </div>


    @include(
        'administracion.prenominas._detalle_empleados'
    )


    {{-- ACCIONES --}}
    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.prenominas.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-x-circle me-1"></i>

            Cancelar

        </a>

        <button
            type="submit"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-check-circle me-1"></i>

            {{ isset($prenomina)
                ? 'Actualizar Prenómina'
                : 'Guardar Prenómina'
            }}

        </button>

    </div>

</div>