<div class="gtri-form">

    {{-- ========================================= --}}
    {{-- 01 DATOS GENERALES --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Datos generales

        </div>


        <div class="row g-4">

            {{-- CATEGORÍA --}}
            <div class="col-md-6">

                <label
                    for="categoria_producto_id"
                    class="gtri-label mb-2"
                >

                    Categoría

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="categoria_producto_id"
                    id="categoria_producto_id"
                    class="form-select gtri-select"
                    required
                >

                    <option value="">

                        Seleccione una categoría

                    </option>

                    @foreach($categorias as $categoria)

                        <option
                            value="{{ $categoria->id }}"
                            @selected(
                                old(
                                    'categoria_producto_id',
                                    $producto->categoria_producto_id ?? ''
                                ) == $categoria->id
                            )
                        >

                            {{ $categoria->nombre }}

                        </option>

                    @endforeach

                </select>

                @error('categoria_producto_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- CÓDIGO --}}
            <div class="col-md-6">

                <label
                    for="codigo"
                    class="gtri-label mb-2"
                >

                    Código

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="codigo"
                    id="codigo"
                    value="{{ old(
                        'codigo',
                        $producto->codigo ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. PROD-001"
                    maxlength="100"
                    required
                >

                @error('codigo')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- NOMBRE --}}
            <div class="col-md-6">

                <label
                    for="nombre"
                    class="gtri-label mb-2"
                >

                    Nombre del producto

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    value="{{ old(
                        'nombre',
                        $producto->nombre ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. Radio portátil Motorola"
                    maxlength="255"
                    required
                >

                @error('nombre')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- UNIDAD DE MEDIDA --}}
            <div class="col-md-6">

                <label
                    for="unidad_medida"
                    class="gtri-label mb-2"
                >

                    Unidad de medida

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="unidad_medida"
                    id="unidad_medida"
                    class="form-select gtri-select"
                    required
                >

                    @foreach([
                        'Pieza',
                        'Caja',
                        'Par',
                        'Paquete',
                        'Juego',
                        'Kilogramo',
                        'Litro',
                        'Metro'
                    ] as $unidad)

                        <option
                            value="{{ $unidad }}"
                            @selected(
                                old(
                                    'unidad_medida',
                                    $producto->unidad_medida ?? 'Pieza'
                                ) == $unidad
                            )
                        >

                            {{ $unidad }}

                        </option>

                    @endforeach

                </select>

                @error('unidad_medida')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- 02 CONTROL DE INVENTARIO --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Control de inventario

        </div>


        <div class="row g-4">

            {{-- STOCK MÍNIMO --}}
            <div class="col-md-4">

                <label
                    for="stock_minimo"
                    class="gtri-label mb-2"
                >

                    Stock mínimo

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="number"
                    name="stock_minimo"
                    id="stock_minimo"
                    min="0"
                    value="{{ old(
                        'stock_minimo',
                        $producto->stock_minimo ?? 0
                    ) }}"
                    class="form-control gtri-input"
                    required
                >

                <small class="gtri-help d-block mt-1">

                    Se usará para generar alertas de existencias bajas.

                </small>

                @error('stock_minimo')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- STOCK MÁXIMO --}}
            <div class="col-md-4">

                <label
                    for="stock_maximo"
                    class="gtri-label mb-2"
                >

                    Stock máximo

                </label>

                <input
                    type="number"
                    name="stock_maximo"
                    id="stock_maximo"
                    min="0"
                    value="{{ old(
                        'stock_maximo',
                        $producto->stock_maximo ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Opcional"
                >

                <small class="gtri-help d-block mt-1">

                    Nivel máximo recomendado de inventario.

                </small>

                @error('stock_maximo')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- TIPO DE PRODUCTO --}}
            <div class="col-md-4">

                <label
                    for="tipo_producto"
                    class="gtri-label mb-2"
                >

                    Tipo de producto

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="tipo_producto"
                    id="tipo_producto"
                    class="form-select gtri-select"
                    required
                >

                    <option
                        value="consumible"
                        @selected(
                            old(
                                'tipo_producto',
                                $producto->tipo_producto ?? 'consumible'
                            ) == 'consumible'
                        )
                    >

                        Consumible

                    </option>

                    <option
                        value="activo"
                        @selected(
                            old(
                                'tipo_producto',
                                $producto->tipo_producto ?? ''
                            ) == 'activo'
                        )
                    >

                        Activo

                    </option>

                </select>

                <small class="gtri-help d-block mt-1">

                    Consumible: se agota. Activo: puede asignarse y controlarse.

                </small>

                @error('tipo_producto')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- 03 COSTOS --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Costos

        </div>


        <div class="row g-4">

            {{-- PRECIO DE COMPRA --}}
            <div class="col-md-6">

                <label
                    for="precio_compra"
                    class="gtri-label mb-2"
                >

                    Precio de compra

                    <span class="text-danger">*</span>

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="number"
                        name="precio_compra"
                        id="precio_compra"
                        min="0"
                        step="0.01"
                        value="{{ old(
                            'precio_compra',
                            $producto->precio_compra ?? 0
                        ) }}"
                        class="form-control gtri-input"
                        required
                    >

                </div>

                @error('precio_compra')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- PRECIO PROMEDIO --}}
            <div class="col-md-6">

                <label
                    for="precio_promedio"
                    class="gtri-label mb-2"
                >

                    Precio promedio

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="number"
                        name="precio_promedio"
                        id="precio_promedio"
                        min="0"
                        step="0.01"
                        value="{{ old(
                            'precio_promedio',
                            $producto->precio_promedio ?? ''
                        ) }}"
                        class="form-control gtri-input"
                        placeholder="Opcional"
                    >

                </div>

                <small class="gtri-help d-block mt-1">

                    Puede actualizarse después con base en las compras realizadas.

                </small>

                @error('precio_promedio')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>

<div class="col-12">

    <div class="gtri-section">

        <div class="gtri-section-header">

            <div>

                <span class="gtri-section-number">
                    04
                </span>

                <h5 class="gtri-section-title">
                    Configuración de deducción
                </h5>

            </div>

        </div>

        <div class="row g-3">

            <div class="col-12 col-md-6">

                <div class="form-check form-switch mt-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="genera_deduccion"
                        name="genera_deduccion"
                        value="1"
                        @checked(old('genera_deduccion'))
                    >

                    <label
                        class="form-check-label"
                        for="genera_deduccion"
                    >
                        Genera deducción de nómina
                    </label>

                </div>

                <small class="text-secondary">
                    Activa esta opción cuando el producto deba cobrarse o descontarse al empleado.
                </small>

            </div>

            <div class="col-12 col-md-6">

                <label
                    for="monto_deduccion"
                    class="form-label"
                >
                    Monto de deducción
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        $
                    </span>

                    <input
                        type="number"
                        name="monto_deduccion"
                        id="monto_deduccion"
                        class="form-control @error('monto_deduccion') is-invalid @enderror"
                        value="{{ old('monto_deduccion') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ej. 550.00"
                    >

                    @error('monto_deduccion')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <small class="text-secondary">
                    Déjalo vacío cuando el producto no genere deducción.
                </small>

            </div>

        </div>

    </div>

</div>


    {{-- ========================================= --}}
    {{-- 04 INFORMACIÓN COMPLEMENTARIA --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>04</span>

            Información complementaria

        </div>


        <div>

            <label
                for="descripcion"
                class="gtri-label mb-2"
            >

                Descripción

            </label>

            <textarea
                name="descripcion"
                id="descripcion"
                rows="4"
                maxlength="500"
                class="form-control gtri-textarea"
                placeholder="Ingrese una descripción general del producto..."
            >{{ old(
                'descripcion',
                $producto->descripcion ?? ''
            ) }}</textarea>

            <small class="gtri-help d-block mt-1">

                Máximo 500 caracteres.

            </small>

            @error('descripcion')

                <small class="text-danger d-block mt-1">

                    {{ $message }}

                </small>

            @enderror

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- ACCIONES --}}
    {{-- ========================================= --}}

    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.productos.index') }}"
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

            {{ isset($producto)
                ? 'Actualizar producto'
                : 'Guardar producto'
            }}

        </button>

    </div>

</div>