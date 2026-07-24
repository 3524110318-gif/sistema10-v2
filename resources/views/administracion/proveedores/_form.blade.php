<div class="gtri-form">

    {{-- ========================================= --}}
    {{-- 01 INFORMACIÓN FISCAL --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información fiscal

        </div>

        <div class="row g-4">

            {{-- RAZÓN SOCIAL --}}
            <div class="col-md-6">

                <label
                    for="razon_social"
                    class="gtri-label mb-2"
                >

                    Razón Social

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="razon_social"
                    id="razon_social"
                    value="{{ old(
                        'razon_social',
                        $proveedor->razon_social ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. Seguridad y Equipamiento S.A. de C.V."
                    required
                >

                @error('razon_social')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- RFC --}}
            <div class="col-md-6">

                <label
                    for="rfc"
                    class="gtri-label mb-2"
                >

                    RFC

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="rfc"
                    id="rfc"
                    value="{{ old(
                        'rfc',
                        $proveedor->rfc ?? ''
                    ) }}"
                    class="form-control gtri-input text-uppercase"
                    placeholder="Ej. SEE010101ABC"
                    maxlength="13"
                    required
                >

                @error('rfc')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- 02 INFORMACIÓN DE CONTACTO --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Información de contacto

        </div>

        <div class="row g-4">

            {{-- CONTACTO --}}
            <div class="col-md-6">

                <label
                    for="nombre_contacto"
                    class="gtri-label mb-2"
                >

                    Nombre del contacto

                </label>

                <input
                    type="text"
                    name="nombre_contacto"
                    id="nombre_contacto"
                    value="{{ old(
                        'nombre_contacto',
                        $proveedor->nombre_contacto ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Nombre de la persona de contacto"
                >

                @error('nombre_contacto')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- TELÉFONO --}}
            <div class="col-md-6">

                <label
                    for="telefono"
                    class="gtri-label mb-2"
                >

                    Teléfono

                </label>

                <input
                    type="text"
                    name="telefono"
                    id="telefono"
                    value="{{ old(
                        'telefono',
                        $proveedor->telefono ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. 222 123 4567"
                >

                @error('telefono')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- CORREO --}}
            <div class="col-md-6">

                <label
                    for="correo"
                    class="gtri-label mb-2"
                >

                    Correo electrónico

                </label>

                <input
                    type="email"
                    name="correo"
                    id="correo"
                    value="{{ old(
                        'correo',
                        $proveedor->correo ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. contacto@proveedor.com"
                >

                @error('correo')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- CIUDAD --}}
            <div class="col-md-6">

                <label
                    for="ciudad"
                    class="gtri-label mb-2"
                >

                    Ciudad

                </label>

                <input
                    type="text"
                    name="ciudad"
                    id="ciudad"
                    value="{{ old(
                        'ciudad',
                        $proveedor->ciudad ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. Puebla"
                >

                @error('ciudad')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- 03 UBICACIÓN --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Ubicación

        </div>

        <div class="row g-4">

            {{-- DIRECCIÓN --}}
            <div class="col-md-8">

                <label
                    for="direccion"
                    class="gtri-label mb-2"
                >

                    Dirección

                </label>

                <input
                    type="text"
                    name="direccion"
                    id="direccion"
                    value="{{ old(
                        'direccion',
                        $proveedor->direccion ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Calle, número, colonia..."
                >

                @error('direccion')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- CÓDIGO POSTAL --}}
            <div class="col-md-4">

                <label
                    for="codigo_postal"
                    class="gtri-label mb-2"
                >

                    Código Postal

                </label>

                <input
                    type="text"
                    name="codigo_postal"
                    id="codigo_postal"
                    value="{{ old(
                        'codigo_postal',
                        $proveedor->codigo_postal ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. 72000"
                    maxlength="5"
                >

                @error('codigo_postal')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

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
                placeholder="Agregue información adicional sobre el proveedor..."
            >{{ old(
                'observaciones',
                $proveedor->observaciones ?? ''
            ) }}</textarea>

            @error('observaciones')

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
            href="{{ route('administracion.proveedores.index') }}"
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

            {{ isset($proveedor)
                ? 'Actualizar proveedor'
                : 'Guardar proveedor'
            }}

        </button>

    </div>

</div>