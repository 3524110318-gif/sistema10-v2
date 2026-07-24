<div class="gtri-form">

    {{-- 01 INFORMACIÓN GENERAL --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de la factura

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label
                    for="cliente_id"
                    class="gtri-label mb-2"
                >

                    Cliente

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="cliente_id"
                    id="cliente_id"
                    class="form-select gtri-select"
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

                <label
                    for="contrato_id"
                    class="gtri-label mb-2"
                >

                    Contrato

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="contrato_id"
                    id="contrato_id"
                    class="form-select gtri-select"
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


            <div class="col-md-4">

                <label
                    for="fecha_factura"
                    class="gtri-label mb-2"
                >

                    Fecha de factura

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="fecha_factura"
                    id="fecha_factura"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_factura',
                        isset($factura) && $factura->fecha_factura
                            ? $factura->fecha_factura->format('Y-m-d')
                            : date('Y-m-d')
                    ) }}"
                    required
                >

            </div>


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
                        isset($factura) && $factura->periodo_inicio
                            ? $factura->periodo_inicio->format('Y-m-d')
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
                        isset($factura) && $factura->periodo_fin
                            ? $factura->periodo_fin->format('Y-m-d')
                            : ''
                    ) }}"
                    required
                >

            </div>


            <div class="col-md-4">

                <label
                    for="estado"
                    class="gtri-label mb-2"
                >

                    Estado

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="estado"
                    id="estado"
                    class="form-select gtri-select"
                    required
                >

                    <option
                        value="borrador"
                        @selected(
                            old(
                                'estado',
                                $factura->estado ?? 'borrador'
                            ) == 'borrador'
                        )
                    >
                        Borrador
                    </option>

                    <option
                        value="emitida"
                        @selected(
                            old(
                                'estado',
                                $factura->estado ?? ''
                            ) == 'emitida'
                        )
                    >
                        Emitida
                    </option>

                    <option
                        value="cancelada"
                        @selected(
                            old(
                                'estado',
                                $factura->estado ?? ''
                            ) == 'cancelada'
                        )
                    >
                        Cancelada
                    </option>

                </select>

            </div>

        </div>

    </div>


    @include('administracion.facturas._detalle_servicios')


    {{-- 03 OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Información complementaria

        </div>

        <label
            for="observaciones"
            class="gtri-label mb-2"
        >

            Observaciones

        </label>

        <textarea
            name="observaciones"
            id="observaciones"
            rows="4"
            class="form-control gtri-textarea"
            placeholder="Ingrese observaciones relacionadas con la factura..."
        >{{ old(
            'observaciones',
            $factura->observaciones ?? ''
        ) }}</textarea>

    </div>


    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.facturas.index') }}"
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

            {{ isset($factura)
                ? 'Actualizar factura'
                : 'Guardar factura'
            }}

        </button>

    </div>

</div>