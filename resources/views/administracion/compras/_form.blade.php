<div class="gtri-form">

    {{-- 01 DATOS DE LA COMPRA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Datos de la compra

        </div>

        <div class="row g-4">

            {{-- PROVEEDOR --}}
            <div class="col-md-6">

                <label
                    for="proveedor_id"
                    class="gtri-label mb-2"
                >

                    Proveedor

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="proveedor_id"
                    id="proveedor_id"
                    class="form-select gtri-select"
                    required
                >

                    <option value="">

                        Seleccione un proveedor

                    </option>

                    @foreach($proveedores as $proveedor)

                        <option
                            value="{{ $proveedor->id }}"
                            @selected(
                                old(
                                    'proveedor_id',
                                    $compra->proveedor_id ?? ''
                                ) == $proveedor->id
                            )
                        >

                            {{ $proveedor->razon_social }}

                        </option>

                    @endforeach

                </select>

                @error('proveedor_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- FECHA --}}
            <div class="col-md-3">

                <label
                    for="fecha_compra"
                    class="gtri-label mb-2"
                >

                    Fecha de compra

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="fecha_compra"
                    id="fecha_compra"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_compra',
                        isset($compra)
                            ? $compra->fecha_compra->format('Y-m-d')
                            : date('Y-m-d')
                    ) }}"
                    required
                >

                @error('fecha_compra')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- ESTADO --}}
            <div class="col-md-3">

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
                                $compra->estado ?? 'pendiente'
                            ) == 'pendiente'
                        )
                    >

                        Pendiente

                    </option>

                    <option
                        value="recibida"
                        @selected(
                            old(
                                'estado',
                                $compra->estado ?? ''
                            ) == 'recibida'
                        )
                    >

                        Recibida

                    </option>

                    <option
                        value="cancelada"
                        @selected(
                            old(
                                'estado',
                                $compra->estado ?? ''
                            ) == 'cancelada'
                        )
                    >

                        Cancelada

                    </option>

                </select>

                @error('estado')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>

    {{-- 02 PRODUCTOS DE LA COMPRA --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Productos de la compra

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle">

                    <thead>

                        <tr>

                            <th>Producto</th>

                            <th style="width:15%;">
                                Cantidad
                            </th>

                            <th style="width:20%;">
                                Precio unitario
                            </th>

                            <th style="width:20%;">
                                Subtotal
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @if(isset($compra) && $compra->detalles->isNotEmpty())

                            @foreach($compra->detalles as $detalle)

                                <tr>

                                    <td>

                                        <select
                                            name="producto_id[]"
                                            class="form-select gtri-select"
                                            required
                                        >

                                            <option value="">

                                                Seleccione un producto

                                            </option>

                                            @foreach($productos as $producto)

                                                <option
                                                    value="{{ $producto->id }}"
                                                    @selected(
                                                        old(
                                                            'producto_id.' . $loop->parent->index,
                                                            $detalle->producto_id
                                                        ) == $producto->id
                                                    )
                                                >

                                                    {{ $producto->codigo }}

                                                    -

                                                    {{ $producto->nombre }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </td>

                                    <td>

                                        <input
                                            type="number"
                                            name="cantidad[]"
                                            class="form-control gtri-input"
                                            min="1"
                                            value="{{ old(
                                                'cantidad.' . $loop->index,
                                                $detalle->cantidad
                                            ) }}"
                                            required
                                        >

                                    </td>

                                    <td>

                                        <input
                                            type="number"
                                            name="precio_unitario[]"
                                            class="form-control gtri-input"
                                            min="0"
                                            step="0.01"
                                            value="{{ old(
                                                'precio_unitario.' . $loop->index,
                                                $detalle->precio_unitario
                                            ) }}"
                                            required
                                        >

                                    </td>

                                    <td>

                                        <input
                                            type="text"
                                            class="form-control gtri-input"
                                            value="${{ number_format(
                                                $detalle->subtotal,
                                                2
                                            ) }}"
                                            readonly
                                        >

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>

                                <td>

                                    <select
                                        name="producto_id[]"
                                        class="form-select gtri-select"
                                        required
                                    >

                                        <option value="">

                                            Seleccione un producto

                                        </option>

                                        @foreach($productos as $producto)

                                            <option
                                                value="{{ $producto->id }}"
                                                @selected(
                                                    old('producto_id.0') == $producto->id
                                                )
                                            >

                                                {{ $producto->codigo }}

                                                -

                                                {{ $producto->nombre }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td>

                                    <input
                                        type="number"
                                        name="cantidad[]"
                                        class="form-control gtri-input"
                                        min="1"
                                        value="{{ old('cantidad.0', 1) }}"
                                        required
                                    >

                                </td>

                                <td>

                                    <input
                                        type="number"
                                        name="precio_unitario[]"
                                        class="form-control gtri-input"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('precio_unitario.0', 0) }}"
                                        required
                                    >

                                </td>

                                <td>

                                    <input
                                        type="text"
                                        class="form-control gtri-input"
                                        value="Se calculará al guardar"
                                        readonly
                                    >

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

</div>


    {{-- 03 INFORMACIÓN COMPLEMENTARIA --}}
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
            placeholder="Ingrese observaciones relacionadas con la compra..."
        >{{ old(
            'observaciones',
            $compra->observaciones ?? ''
        ) }}</textarea>

        @error('observaciones')

            <small class="text-danger d-block mt-1">

                {{ $message }}

            </small>

        @enderror

    </div>


    {{-- ACCIONES --}}
    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.compras.index') }}"
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

            {{ isset($compra)
                ? 'Actualizar compra'
                : 'Guardar compra'
            }}

        </button>

    </div>

</div>