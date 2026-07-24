<div class="gtri-form">

    {{-- 01 IDENTIFICACIÓN DEL ACTIVO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Identificación del activo

        </div>

        <div class="row g-4">

            {{-- PRODUCTO --}}
            <div class="col-md-6">

                <label
                    for="producto_id"
                    class="gtri-label mb-2"
                >

                    Producto

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="producto_id"
                    id="producto_id"
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
                                    'producto_id',
                                    $activo->producto_id ?? ''
                                ) == $producto->id
                            )
                        >

                            {{ $producto->codigo }}
                            -
                            {{ $producto->nombre }}

                        </option>

                    @endforeach

                </select>

                @error('producto_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- NÚMERO DE SERIE --}}
            <div class="col-md-6">

                <label
                    for="numero_serie"
                    class="gtri-label mb-2"
                >

                    Número de serie

                </label>

                <input
                    type="text"
                    name="numero_serie"
                    id="numero_serie"
                    class="form-control gtri-input"
                    value="{{ old(
                        'numero_serie',
                        $activo->numero_serie ?? ''
                    ) }}"
                    placeholder="Ej. SN-2026-001245"
                >

                @error('numero_serie')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- 02 CARACTERÍSTICAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Características del activo

        </div>

        <div class="row g-4">

            {{-- MARCA --}}
            <div class="col-md-6">

                <label
                    for="marca"
                    class="gtri-label mb-2"
                >

                    Marca

                </label>

                <input
                    type="text"
                    name="marca"
                    id="marca"
                    class="form-control gtri-input"
                    value="{{ old(
                        'marca',
                        $activo->marca ?? ''
                    ) }}"
                    placeholder="Ej. Motorola"
                >

                @error('marca')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- MODELO --}}
            <div class="col-md-6">

                <label
                    for="modelo"
                    class="gtri-label mb-2"
                >

                    Modelo

                </label>

                <input
                    type="text"
                    name="modelo"
                    id="modelo"
                    class="form-control gtri-input"
                    value="{{ old(
                        'modelo',
                        $activo->modelo ?? ''
                    ) }}"
                    placeholder="Ej. DEP450"
                >

                @error('modelo')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- 03 CONTROL DEL ACTIVO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Control del activo

        </div>

        <div class="row g-4">

            {{-- FECHA --}}
            <div class="col-md-4">

                <label
                    for="fecha_adquisicion"
                    class="gtri-label mb-2"
                >

                    Fecha de adquisición

                </label>

                <input
                    type="date"
                    name="fecha_adquisicion"
                    id="fecha_adquisicion"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_adquisicion',
                        isset($activo) && $activo->fecha_adquisicion
                            ? $activo->fecha_adquisicion->format('Y-m-d')
                            : ''
                    ) }}"
                >

                @error('fecha_adquisicion')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- VALOR --}}
            <div class="col-md-4">

                <label
                    for="valor"
                    class="gtri-label mb-2"
                >

                    Valor

                    <span class="text-danger">*</span>

                </label>

                <div class="input-group">

                    <span class="input-group-text gtri-addon">

                        $

                    </span>

                    <input
                        type="number"
                        name="valor"
                        id="valor"
                        class="form-control gtri-input"
                        step="0.01"
                        min="0"
                        value="{{ old(
                            'valor',
                            $activo->valor ?? 0
                        ) }}"
                        required
                    >

                </div>

                @error('valor')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- ESTADO --}}
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
                        value="disponible"
                        @selected(
                            old(
                                'estado',
                                $activo->estado ?? 'disponible'
                            ) == 'disponible'
                        )
                    >

                        Disponible

                    </option>

                    <option
                        value="asignado"
                        @selected(
                            old(
                                'estado',
                                $activo->estado ?? ''
                            ) == 'asignado'
                        )
                    >

                        Asignado

                    </option>

                    <option
                        value="mantenimiento"
                        @selected(
                            old(
                                'estado',
                                $activo->estado ?? ''
                            ) == 'mantenimiento'
                        )
                    >

                        Mantenimiento

                    </option>

                    <option
                        value="baja"
                        @selected(
                            old(
                                'estado',
                                $activo->estado ?? ''
                            ) == 'baja'
                        )
                    >

                        Baja

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


    {{-- 04 INFORMACIÓN COMPLEMENTARIA --}}
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
            rows="4"
            class="form-control gtri-textarea"
            placeholder="Ingrese información adicional sobre el activo..."
        >{{ old(
            'observaciones',
            $activo->observaciones ?? ''
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
            href="{{ route('administracion.activos.index') }}"
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

            {{ isset($activo)
                ? 'Actualizar activo'
                : 'Guardar activo'
            }}

        </button>

    </div>

</div>