@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-clock-history me-2"></i>

                Registrar doblete

            </h2>

            <p class="gtri-page-subtitle">

                Registra la cobertura temporal de una plaza por ausencia de un guardia.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.dobletes.index'
            ) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    {{-- ERRORES GENERALES --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle me-1"></i>

                Se encontraron los siguientes errores:

            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

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
            'operaciones.dobletes.store'
        ) }}"
    >

        @csrf


        {{-- PLAZA A CUBRIR --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Plaza a cubrir

            </div>

            <p class="text-secondary mb-4">

                Selecciona la plaza que requiere cobertura temporal.

            </p>


            <label
                for="plaza_operativa_id"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Plaza operativa

            </label>

            <select
                name="plaza_operativa_id"
                id="plaza_operativa_id"
                class="form-select gtri-input"
                required
            >

                <option value="">

                    Selecciona una plaza

                </option>

                @foreach(
                    $plazas
                    as $plaza
                )

                    <option
                        value="{{ $plaza->id }}"
                        data-guardia="{{
                            optional(
                                $plaza
                                    ->asignaciones
                                    ->first()
                                    ?->empleado
                            )->nombre
                        }}
                        {{
                            optional(
                                $plaza
                                    ->asignaciones
                                    ->first()
                                    ?->empleado
                            )->apellido_paterno
                        }}
                        {{
                            optional(
                                $plaza
                                    ->asignaciones
                                    ->first()
                                    ?->empleado
                            )->apellido_materno
                        }}"
                        data-empleado="{{
                            optional(
                                $plaza
                                    ->asignaciones
                                    ->first()
                                    ?->empleado
                            )->id
                        }}"
                        @selected(
                            old('plaza_operativa_id')
                            ==
                            $plaza->id
                        )
                    >

                        {{ $plaza->servicio->nombre }}

                        -

                        {{ $plaza->nombre_plaza }}

                    </option>

                @endforeach

            </select>

            @error('plaza_operativa_id')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- GUARDIA AUSENTE --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Guardia ausente

            </div>

            <label
                for="guardia_ausente"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Guardia asignado actualmente

            </label>

            <input
                type="text"
                id="guardia_ausente"
                class="form-control gtri-input"
                placeholder="Selecciona primero una plaza"
                readonly
            >

            <input
                type="hidden"
                name="guardia_ausente"
                id="guardia_ausente_hidden"
                value="{{ old('guardia_ausente') }}"
            >

            <small class="text-secondary d-block mt-2">

                Este dato se obtiene automáticamente de la plaza seleccionada.

            </small>

        </div>


        {{-- GUARDIA DE REEMPLAZO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Guardia de reemplazo

            </div>


            <div class="row g-3">

                <div class="col-lg-7">

                    <label
                        for="guardia_cubre"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Empleado que cubrirá la plaza

                    </label>

                    <select
                        id="guardia_cubre"
                        name="empleado_id"
                        class="form-select gtri-input"
                        required
                        disabled
                    >

                        <option value="">

                            Selecciona un empleado

                        </option>

                        @foreach(
                            $empleados
                            as $empleado
                        )

                            <option
                                value="{{ $empleado->id }}"
                                data-servicio="{{
                                    $empleado
                                        ->asignaciones
                                        ->first()
                                        ->plaza
                                        ->servicio
                                        ->nombre
                                }}"
                                data-plaza="{{
                                    $empleado
                                        ->asignaciones
                                        ->first()
                                        ->plaza
                                        ->nombre_plaza
                                }}"
                                @selected(
                                    old('empleado_id')
                                    ==
                                    $empleado->id
                                )
                            >

                                {{ $empleado->nombre }}

                                {{ $empleado->apellido_paterno }}

                                {{ $empleado->apellido_materno }}

                            </option>

                        @endforeach

                    </select>

                    @error('empleado_id')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>


            {{-- ORIGEN DEL GUARDIA --}}
            <div class="row g-3 mt-2">

                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Servicio actual

                        </div>

                        <div
                            id="info_servicio"
                            class="gtri-info-value"
                        >

                            Selecciona un guardia

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="gtri-info-card h-100">

                        <div class="gtri-info-label">

                            Plaza actual

                        </div>

                        <div
                            id="info_plaza"
                            class="gtri-info-value"
                        >

                            Selecciona un guardia

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- DATOS DEL DOBLETE --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Datos del doblete

            </div>

            <div class="row g-3">

                <div class="col-md-5">

                    <label
                        for="fecha"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha

                    </label>

                    <input
                        type="date"
                        name="fecha"
                        id="fecha"
                        class="form-control gtri-input"
                        value="{{ old('fecha') }}"
                        required
                    >

                    @error('fecha')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>


        {{-- MOTIVO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>05</span>

                Motivo

            </div>

            <label
                for="motivo"
                class="form-label fw-semibold"
                style="color:#CBD5E1;"
            >

                Motivo del doblete

            </label>

            <textarea
                name="motivo"
                id="motivo"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Describe el motivo por el cual se requiere cubrir temporalmente esta plaza..."
                required
            >{{ old('motivo') }}</textarea>

            @error('motivo')

                <div class="text-danger small mt-1">

                    {{ $message }}

                </div>

            @enderror

        </div>


        {{-- ACCIONES --}}
        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="{{ route(
                        'operaciones.dobletes.index'
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

                    <i class="bi bi-check-circle me-1"></i>

                    Guardar doblete

                </button>

            </div>

        </div>

    </form>

</div>


@push('scripts')

<script>

    const plazaSelect =
        document.getElementById('plaza_operativa_id');

    const guardiaAusente =
        document.getElementById('guardia_ausente');

    const guardiaAusenteHidden =
        document.getElementById('guardia_ausente_hidden');

    const guardiaCubre =
        document.getElementById('guardia_cubre');

    const infoServicio =
        document.getElementById('info_servicio');

    const infoPlaza =
        document.getElementById('info_plaza');


    function actualizarPlaza() {

        const opcion =
            plazaSelect.options[plazaSelect.selectedIndex];

        if (!opcion || !opcion.value) {

            guardiaAusente.value = '';

            guardiaAusenteHidden.value = '';

            guardiaCubre.disabled = true;

            return;

        }

        const nombreGuardia =
            opcion.dataset.guardia?.trim() || '';

        guardiaAusente.value =
            nombreGuardia || 'Sin guardia asignado';

        guardiaAusenteHidden.value =
            nombreGuardia;

        guardiaCubre.disabled = false;

    }


    function actualizarGuardia() {

        const opcion =
            guardiaCubre.options[guardiaCubre.selectedIndex];

        if (!opcion || !opcion.value) {

            infoServicio.textContent =
                'Selecciona un guardia';

            infoPlaza.textContent =
                'Selecciona un guardia';

            return;

        }

        infoServicio.textContent =
            opcion.dataset.servicio || 'Sin información';

        infoPlaza.textContent =
            opcion.dataset.plaza || 'Sin información';

    }


    if (plazaSelect) {

        plazaSelect.addEventListener(
            'change',
            actualizarPlaza
        );

        actualizarPlaza();

    }


    if (guardiaCubre) {

        guardiaCubre.addEventListener(
            'change',
            actualizarGuardia
        );

        actualizarGuardia();

    }

</script>

@endpush

@endsection