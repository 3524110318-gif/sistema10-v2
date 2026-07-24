@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-box-seam me-2"></i>

                Entrega de uniforme

            </h2>

            <p class="gtri-page-subtitle">

                Registra la entrega de uniformes, equipo o accesorios al empleado.

            </p>

        </div>


        <a
            href="{{ route('rh.empleados.show', $empleado->id) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route(
            'rh.uniformes.store',
            $empleado->id
        ) }}"
    >

        @csrf


        {{-- INFORMACIÓN DEL EMPLEADO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del empleado

            </div>


            <div
                class="
                    d-flex
                    flex-wrap
                    align-items-center
                    gap-3
                    p-4
                    rounded-3
                "
                style="
                    background:#111827;
                    border:1px solid rgba(255,255,255,.08);
                "
            >

                @if ($empleado->foto)

                    <img
                        src="{{ asset(
                            'fotos_empleados/' .
                            $empleado->foto
                        ) }}"
                        alt="Foto del empleado"
                        class="rounded-circle"
                        style="
                            width:70px;
                            height:70px;
                            object-fit:cover;
                            border:3px solid #D4AF37;
                        "
                    >

                @else

                    <div
                        class="
                            rounded-circle
                            d-flex
                            align-items-center
                            justify-content-center
                        "
                        style="
                            width:70px;
                            height:70px;
                            background:#1F2937;
                            border:3px solid #D4AF37;
                        "
                    >

                        <i class="bi bi-person fs-3 text-secondary"></i>

                    </div>

                @endif


                <div>

                    <h5 class="text-light mb-1">

                        {{ $empleado->nombre }}

                        {{ $empleado->apellido_paterno }}

                        {{ $empleado->apellido_materno }}

                    </h5>


                    <div class="text-secondary">

                        No. de control:

                        <span class="text-warning fw-bold">

                            {{ $empleado->numero_control }}

                        </span>

                    </div>


                    <div class="text-secondary">

                        Puesto:

                        <span class="text-light">

                            {{ $empleado->puesto }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- DATOS DE LA ENTREGA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la entrega

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="articulo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Artículo

                    </label>


                    <select
                        name="articulo"
                        id="articulo"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un artículo

                        </option>


                        <option
                            value="Botas"
                            @selected(old('articulo') === 'Botas')
                        >

                            Botas

                        </option>


                        <option
                            value="Camisa"
                            @selected(old('articulo') === 'Camisa')
                        >

                            Camisa

                        </option>


                        <option
                            value="Pantalón"
                            @selected(old('articulo') === 'Pantalón')
                        >

                            Pantalón

                        </option>


                        <option
                            value="Chaleco"
                            @selected(old('articulo') === 'Chaleco')
                        >

                            Chaleco

                        </option>


                        <option
                            value="Radio"
                            @selected(old('articulo') === 'Radio')
                        >

                            Radio

                        </option>

                    </select>


                    @error('articulo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Tipo

                    </label>


                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona el tipo

                        </option>


                        <option
                            value="nuevo"
                            @selected(old('tipo') === 'nuevo')
                        >

                            Nuevo

                        </option>


                        <option
                            value="segunda_mano"
                            @selected(old('tipo') === 'segunda_mano')
                        >

                            Segunda mano

                        </option>

                    </select>


                    @error('tipo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="fecha_entrega"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de entrega

                    </label>


                    <input
                        type="date"
                        name="fecha_entrega"
                        id="fecha_entrega"
                        class="form-control gtri-input"
                        value="{{ old('fecha_entrega') }}"
                        required
                    >


                    @error('fecha_entrega')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Observaciones

            </div>


            <label
                for="observaciones"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Observaciones de la entrega

            </label>


            <textarea
                name="observaciones"
                id="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Escribe aquí cualquier detalle sobre el artículo entregado..."
            >{{ old('observaciones') }}</textarea>


            @error('observaciones')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route(
                        'rh.empleados.show',
                        $empleado->id
                    ) }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-box-arrow-in-down me-1"></i>

                    Registrar entrega

                </button>

            </div>

        </div>

    </form>

</div>

@endsection