<!-- 01 · INFORMACIÓN GENERAL -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>01</span>

        Información general

    </div>

    <div class="row g-3">

        <div class="col-md-6">

            <label
                for="cliente_comercial_id"
                class="form-label"
            >

                Cliente

            </label>

            <select
                name="cliente_comercial_id"
                id="cliente_comercial_id"
                class="form-select gtri-input"
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
                                'cliente_comercial_id',
                                $contrato->cliente_comercial_id ?? ''
                            ) == $cliente->id
                        )
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
                :value="old('folio', $contrato->folio ?? '')"
                placeholder="Ej. CONT-2026-001"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Tarifa"
                name="tarifa"
                type="number"
                step="0.01"
                :value="old('tarifa', $contrato->tarifa ?? '')"
                placeholder="Ej. 25000.00"
                required
            />

        </div>

    </div>

</div>


<!-- 02 · VIGENCIA Y CONDICIONES -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Vigencia y condiciones

    </div>

    <div class="row g-3">

        <div class="col-md-3">

            <x-rh.input-rh
                label="Fecha Inicio"
                name="fecha_inicio"
                type="date"
                :value="old(
                    'fecha_inicio',
                    isset($contrato)
                        ? $contrato->fecha_inicio?->format('Y-m-d')
                        : now()->format('Y-m-d')
                )"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Fecha Fin"
                name="fecha_fin"
                type="date"
                :value="old(
                    'fecha_fin',
                    isset($contrato)
                        ? $contrato->fecha_fin?->format('Y-m-d')
                        : ''
                )"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Plazas"
                name="numero_plazas"
                type="number"
                :value="old('numero_plazas', $contrato->numero_plazas ?? '')"
                placeholder="Ej. 10"
                required
            />

        </div>

        <div class="col-md-3">

            <x-rh.input-rh
                label="Indexación %"
                name="indexacion_anual"
                type="number"
                step="0.01"
                :value="old('indexacion_anual', $contrato->indexacion_anual ?? '')"
                placeholder="Ej. 5.00"
                required
            />

        </div>

    </div>

</div>


<!-- 03 · DOCUMENTACIÓN -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>03</span>

        Documentación

    </div>

    <div class="row g-3">

        <div class="col-12">

            <label
                for="pdf_consignas"
                class="form-label"
            >

                PDF de Consignas

            </label>

            @if(isset($contrato) && $contrato->pdf_consignas)

                <div class="mb-3">

                    <a
                        href="{{ asset('storage/'.$contrato->pdf_consignas) }}"
                        target="_blank"
                        class="btn gtri-btn-secondary btn-sm"
                    >

                        <i class="bi bi-file-earmark-pdf me-1"></i>

                        Ver PDF actual

                    </a>

                </div>

            @endif

            <input
                type="file"
                name="pdf_consignas"
                id="pdf_consignas"
                class="form-control gtri-input"
                accept="application/pdf"
            >

            <small class="text-secondary d-block mt-2">

                @if(isset($contrato))

                    Si no selecciona un archivo, se conservará el PDF actual.

                @else

                    Seleccione el PDF de consignas.

                @endif

            </small>

        </div>

    </div>

</div>


<!-- 04 · ESTADO Y OBSERVACIONES -->

<div class="gtri-section">

    <div class="gtri-section-title">

        <span>04</span>

        Estado y observaciones

    </div>

    <div class="row g-3">

        <div class="col-md-4">

            <label
                for="estado"
                class="form-label"
            >

                Estado

            </label>

            <select
                name="estado"
                id="estado"
                class="form-select gtri-input"
            >

                <option
                    value="borrador"
                    @selected(
                        old(
                            'estado',
                            $contrato->estado ?? 'borrador'
                        ) == 'borrador'
                    )
                >

                    Borrador

                </option>

                <option
                    value="pendiente"
                    @selected(
                        old(
                            'estado',
                            $contrato->estado ?? ''
                        ) == 'pendiente'
                    )
                >

                    Pendiente

                </option>

                <option
                    value="activo"
                    @selected(
                        old(
                            'estado',
                            $contrato->estado ?? ''
                        ) == 'activo'
                    )
                >

                    Activo

                </option>

                <option
                    value="finalizado"
                    @selected(
                        old(
                            'estado',
                            $contrato->estado ?? ''
                        ) == 'finalizado'
                    )
                >

                    Finalizado

                </option>

                <option
                    value="cancelado"
                    @selected(
                        old(
                            'estado',
                            $contrato->estado ?? ''
                        ) == 'cancelado'
                    )
                >

                    Cancelado

                </option>

            </select>

        </div>

        <div class="col-md-8">

            <label
                for="observaciones"
                class="form-label"
            >

                Observaciones

            </label>

            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Ej. Contrato correspondiente al servicio de seguridad privada para 10 plazas..."
            >{{ old('observaciones', $contrato->observaciones ?? '') }}</textarea>

        </div>

    </div>

</div>


<!-- 05 · ACCIONES -->

<div class="gtri-section mb-0">

    <div class="d-flex justify-content-end gap-2 flex-wrap">

        <a
            href="{{ route('comercial.contratos.index') }}"
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

            Guardar contrato

        </button>

    </div>

</div>