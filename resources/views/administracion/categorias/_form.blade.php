<div class="gtri-form">

    {{-- ========================================= --}}
    {{-- 01 INFORMACIÓN DE LA CATEGORÍA --}}
    {{-- ========================================= --}}

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Información de la categoría

        </div>


        <div class="row g-4">

            {{-- NOMBRE --}}
            <div class="col-md-12">

                <label
                    for="nombre"
                    class="gtri-label mb-2"
                >

                    Nombre de la categoría

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    value="{{ old(
                        'nombre',
                        $categoria->nombre ?? ''
                    ) }}"
                    class="form-control gtri-input"
                    placeholder="Ej. Uniformes, Equipo táctico, Papelería..."
                    maxlength="255"
                    required
                >

                @error('nombre')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- DESCRIPCIÓN --}}
            <div class="col-md-12">

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
                    class="form-control gtri-textarea"
                    placeholder="Ingrese una descripción general de la categoría..."
                >{{ old(
                    'descripcion',
                    $categoria->descripcion ?? ''
                ) }}</textarea>

                <small class="gtri-help d-block mt-1">

                    Describa brevemente qué tipo de productos pertenecen a esta categoría.

                </small>

                @error('descripcion')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- ACCIONES --}}
    {{-- ========================================= --}}

    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.categorias.index') }}"
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

            {{ isset($categoria)
                ? 'Actualizar categoría'
                : 'Guardar categoría'
            }}

        </button>

    </div>

</div>