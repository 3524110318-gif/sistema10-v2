<div class="gtri-form">

    {{-- 01 INFORMACIÓN DE COBRANZA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de cobranza

        </div>

        <div class="row g-4">

            {{-- FACTURA --}}
            <div class="col-md-6">

                <label
                    for="factura_id"
                    class="gtri-label mb-2"
                >

                    Factura

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="factura_id"
                    id="factura_id"
                    class="form-select gtri-select"
                    required
                >

                    <option value="">

                        Seleccione una factura

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

                @error('factura_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- MONTO --}}
            <div class="col-md-6">

                <label class="gtri-label mb-2">

                    Monto

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="text"
                        class="form-control gtri-input"
                        value="{{ isset($cobranza)
                            ? number_format($cobranza->monto, 2)
                            : 'Se cargará automáticamente'
                        }}"
                        readonly
                    >

                </div>

                <small class="text-secondary">

                    El monto se obtiene automáticamente de la factura.

                </small>

            </div>

        </div>

    </div>


    {{-- 02 CONTROL DE FECHAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Control de fechas

        </div>

        <div class="row g-4">

            {{-- VENCIMIENTO --}}
            <div class="col-md-6">

                <label
                    for="fecha_vencimiento"
                    class="gtri-label mb-2"
                >

                    Fecha de vencimiento

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="fecha_vencimiento"
                    id="fecha_vencimiento"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_vencimiento',
                        isset($cobranza) && $cobranza->fecha_vencimiento
                            ? $cobranza->fecha_vencimiento->format('Y-m-d')
                            : ''
                    ) }}"
                    required
                >

                @error('fecha_vencimiento')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- FECHA PAGO --}}
            <div class="col-md-6">

                <label
                    for="fecha_pago"
                    class="gtri-label mb-2"
                >

                    Fecha de pago

                </label>

                <input
                    type="date"
                    name="fecha_pago"
                    id="fecha_pago"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_pago',
                        isset($cobranza) && $cobranza->fecha_pago
                            ? $cobranza->fecha_pago->format('Y-m-d')
                            : ''
                    ) }}"
                >

                <small class="text-secondary">

                    Puede dejarse vacía mientras el pago esté pendiente.

                </small>

            </div>

        </div>

    </div>


    {{-- 03 SEGUIMIENTO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Seguimiento del pago

        </div>

        <div class="row g-4">

            {{-- ESTADO --}}
            <div class="col-md-6">

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
                        value="pendiente"
                        @selected(
                            old(
                                'estado',
                                $cobranza->estado ?? 'pendiente'
                            ) == 'pendiente'
                        )
                    >

                        Pendiente

                    </option>

                    <option
                        value="revision"
                        @selected(
                            old(
                                'estado',
                                $cobranza->estado ?? ''
                            ) == 'revision'
                        )
                    >

                        En revisión

                    </option>

                    <option
                        value="pagada"
                        @selected(
                            old(
                                'estado',
                                $cobranza->estado ?? ''
                            ) == 'pagada'
                        )
                    >

                        Pagada

                    </option>

                    <option
                        value="vencida"
                        @selected(
                            old(
                                'estado',
                                $cobranza->estado ?? ''
                            ) == 'vencida'
                        )
                    >

                        Vencida

                    </option>

                </select>

            </div>


            {{-- REFERENCIA --}}
            <div class="col-md-6">

                <label
                    for="referencia_pago"
                    class="gtri-label mb-2"
                >

                    Referencia de pago

                </label>

                <input
                    type="text"
                    name="referencia_pago"
                    id="referencia_pago"
                    class="form-control gtri-input"
                    value="{{ old(
                        'referencia_pago',
                        $cobranza->referencia_pago ?? ''
                    ) }}"
                    placeholder="Ej. TRANSF-458921"
                >

            </div>

        </div>

    </div>


    {{-- 04 OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

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
            class="form-control gtri-textarea"
            rows="4"
            placeholder="Ingrese información adicional sobre la cobranza..."
        >{{ old(
            'observaciones',
            $cobranza->observaciones ?? ''
        ) }}</textarea>

    </div>


    {{-- ACCIONES --}}
    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.cobranzas.index') }}"
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

            {{ isset($cobranza)
                ? 'Actualizar cobranza'
                : 'Guardar cobranza'
            }}

        </button>

    </div>

</div>