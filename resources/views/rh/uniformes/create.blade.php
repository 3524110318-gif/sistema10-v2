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

    </div>


    {{-- ERRORES GENERALES --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle me-1"></i>

            <strong>

                No se pudo registrar la entrega.

            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route(
            'rh.uniformes.store',
            $empleado->id
        ) }}"
    >

        @csrf


        {{-- 01 · INFORMACIÓN DEL EMPLEADO --}}

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

                @if($empleado->foto)

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


        {{-- 02 · DATOS DE LA ENTREGA --}}

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Datos de la entrega

            </div>


            <div class="row g-3">


                {{-- PRODUCTO DEL INVENTARIO --}}

                <div class="col-md-6">

                    <label
                        for="producto_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Producto del inventario

                    </label>


                    <select
                        name="producto_id"
                        id="producto_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un producto

                        </option>


                        @foreach($productos as $producto)

                            <option
                                value="{{ $producto->id }}"
                                @selected(
                                    old('producto_id') == $producto->id
                                )
                            >

                                {{ $producto->codigo }}

                                -

                                {{ $producto->nombre }}

                                (Disponible: {{ $producto->stock_actual }})

                            </option>

                        @endforeach

                    </select>


                    <div class="form-text">

                        Solo se muestran productos consumibles activos del inventario.

                    </div>


                    @error('producto_id')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- CANTIDAD --}}

                <div class="col-md-3">

                    <label
                        for="cantidad"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Cantidad

                    </label>


                    <input
                        type="number"
                        name="cantidad"
                        id="cantidad"
                        class="form-control gtri-input"
                        value="{{ old('cantidad', 1) }}"
                        min="1"
                        placeholder="Ej. 2"
                        required
                    >


                    @error('cantidad')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                {{-- TIPO --}}

                <div class="col-md-3">

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


                {{-- FECHA --}}

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
                        value="{{ old(
                            'fecha_entrega',
                            now()->format('Y-m-d')
                        ) }}"
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


        {{-- 03 · INFORMACIÓN DEL INVENTARIO --}}

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Información del inventario

            </div>


            <div
                class="p-4 rounded-3"
                style="
                    background:#111827;
                    border:1px solid rgba(212,175,55,.25);
                "
            >

                <div class="d-flex align-items-start gap-3">

                    <div
                        class="
                            d-flex
                            align-items-center
                            justify-content-center
                            rounded-3
                        "
                        style="
                            width:48px;
                            height:48px;
                            min-width:48px;
                            background:rgba(212,175,55,.12);
                            color:#D4AF37;
                        "
                    >

                        <i class="bi bi-boxes fs-4"></i>

                    </div>


                    <div>

                        <h6 class="text-light fw-bold mb-2">

                            Movimiento automático de inventario

                        </h6>

                        <p class="text-secondary mb-0">

                            Al registrar esta entrega, la cantidad seleccionada se descontará automáticamente del stock disponible en bodega y quedará registrada como una salida de inventario vinculada a Recursos Humanos.

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- 04 · OBSERVACIONES --}}

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

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
                placeholder="Ej. Se entregaron dos camisas nuevas correspondientes al uniforme operativo..."
            >{{ old('observaciones') }}</textarea>


            @error('observaciones')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>

        {{-- 05 · FIRMA DE CONFORMIDAD --}}

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>05</span>

                Firma de conformidad

            </div>

            <div
                class="p-4 rounded-3"
                style="
                    background:#111827;
                    border:1px solid rgba(212,175,55,.25);
                "
            >

                <div class="mb-3">

                    <h6 class="text-light fw-bold mb-2">

                        Firma del colaborador

                    </h6>

                    <p class="text-secondary mb-0">

                        El colaborador confirma mediante su firma que recibió correctamente
                        el uniforme, equipo o accesorio descrito en esta entrega.

                    </p>

                </div>

                <div
                    class="rounded-3 overflow-hidden"
                    style="
                        background:#FFFFFF;
                        border:2px dashed #D4AF37;
                    "
                >

                    <canvas
                        id="firmaCanvas"
                        width="900"
                        height="250"
                        style="
                            width:100%;
                            height:250px;
                            display:block;
                            cursor:crosshair;
                            touch-action:none;
                        "
                    ></canvas>

                </div>

                <input
                    type="hidden"
                    name="firma"
                    id="firma"
                    value="{{ old('firma') }}"
                >

                <div
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        flex-wrap
                        gap-3
                        mt-3
                    "
                >

                    <small class="text-secondary">

                        Puede firmar utilizando mouse, pantalla táctil o S-Pen.

                    </small>

                    <button
                        type="button"
                        id="limpiarFirma"
                        class="btn gtri-btn-secondary"
                    >

                        <i class="bi bi-eraser me-1"></i>

                        Limpiar firma

                    </button>

                </div>

                @error('firma')

                    <div class="text-danger small mt-2">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>


        {{-- 05 · ACCIONES --}}

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