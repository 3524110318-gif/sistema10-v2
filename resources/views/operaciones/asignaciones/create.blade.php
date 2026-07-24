@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-plus me-2"></i>

                Nueva asignación

            </h2>

            <p class="gtri-page-subtitle">

                Asigna un empleado disponible a una plaza operativa.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.asignaciones.index'
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

                Se encontraron algunos errores:

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
            'operaciones.asignaciones.store'
        ) }}"
    >

        @csrf


        {{-- EMPLEADO --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Selección del empleado

            </div>

            <p class="text-secondary mb-4">

                Seleccione al empleado que será asignado a una plaza operativa.

            </p>


            <div class="row">

                <div class="col-lg-8">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Empleado disponible

                        <span class="text-danger">

                            *

                        </span>

                    </label>

                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un empleado

                        </option>

                        @foreach($empleados as $empleado)

                            <option
                                value="{{ $empleado->id }}"
                                {{
                                    old('empleado_id')
                                    ==
                                    $empleado->id
                                    ? 'selected'
                                    : ''
                                }}
                                @disabled(!$empleado->repse_apto)
                            >

                                {{ $empleado->numero_control }}

                                -

                                {{ $empleado->nombre }}

                                {{ $empleado->apellido_paterno }}

                                @if($empleado->repse_apto)

                                    - APTO REPSE

                                @else

                                    - BLOQUEADO REPSE

                                @endif

                            </option>

                        @endforeach

                    </select>

                    <div
                        class="form-text mt-2"
                        style="color:#94A3B8;"
                    >

                        <i class="bi bi-info-circle me-1"></i>

                        Los empleados bloqueados por REPSE no pueden ser seleccionados.

                    </div>

                </div>

            </div>

        </div>


        {{-- ESTADO REPSE --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Estado de cumplimiento REPSE

            </div>

            <p class="text-secondary mb-4">

                Verifica el cumplimiento de cada empleado antes de realizar la asignación.

            </p>


            <div class="row g-3">

                @forelse($empleados as $empleado)

                    <div class="col-xl-4 col-lg-6">

                        <div
                            class="h-100 rounded-3 p-4"
                            style="
                                background:#111827;
                                border:1px solid
                                {{
                                    $empleado->repse_apto
                                    ? '#198754'
                                    : '#DC3545'
                                }};
                            "
                        >

                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                    align-items-start
                                    gap-3
                                "
                            >

                                <div>

                                    <div
                                        class="fw-bold"
                                        style="color:#F8FAFC;"
                                    >

                                        {{ $empleado->numero_control }}

                                    </div>

                                    <div
                                        class="mt-1"
                                        style="color:#CBD5E1;"
                                    >

                                        {{ $empleado->nombre }}

                                        {{ $empleado->apellido_paterno }}

                                    </div>

                                </div>


                                <div>

                                    @if($empleado->repse_apto)

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Apto

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-lock me-1"></i>

                                            Bloqueado

                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div class="mt-3">

                                @if($empleado->repse_apto)

                                    <small class="text-success">

                                        <i class="bi bi-shield-check me-1"></i>

                                        Cumple con los requisitos REPSE.

                                    </small>

                                @else

                                    <small class="text-danger">

                                        <i class="bi bi-shield-x me-1"></i>

                                        No cumple con los requisitos REPSE.

                                    </small>

                                @endif

                            </div>


                            @if(!$empleado->repse_apto)

                                <div
                                    class="mt-3 pt-3"
                                    style="
                                        border-top:
                                        1px solid
                                        rgba(255,255,255,.08);
                                    "
                                >

                                    <small
                                        class="fw-semibold"
                                        style="color:#CBD5E1;"
                                    >

                                        Motivo del bloqueo:

                                    </small>

                                    <ul class="mb-0 mt-2 ps-3">

                                        @foreach(
                                            $empleado->repse_faltantes
                                            as $faltante
                                        )

                                            <li
                                                class="small mb-1"
                                                style="color:#94A3B8;"
                                            >

                                                {{ $faltante }}

                                            </li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div
                            class="text-center py-5 rounded-3"
                            style="
                                background:#111827;
                                border:1px solid
                                rgba(255,255,255,.08);
                            "
                        >

                            <i
                                class="
                                    bi
                                    bi-person-x
                                    d-block
                                    fs-1
                                    text-secondary
                                    mb-3
                                "
                            ></i>

                            <h5 class="text-light">

                                No hay empleados disponibles

                            </h5>

                            <p class="text-secondary mb-0">

                                Actualmente no existen empleados disponibles para asignación.

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- PLAZA OPERATIVA --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Plaza operativa

            </div>

            <p class="text-secondary mb-4">

                Seleccione la plaza vacante que será cubierta por el empleado.

            </p>


            <div class="row g-3">

                <div class="col-lg-8">

                    <label
                        for="plaza_operativa_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Plaza operativa

                        <span class="text-danger">

                            *

                        </span>

                    </label>

                    <select
                        name="plaza_operativa_id"
                        id="plaza_operativa_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione una plaza

                        </option>

                        @foreach($plazas as $plaza)

                            <option
                                value="{{ $plaza->id }}"
                                {{
                                    old('plaza_operativa_id')
                                    ==
                                    $plaza->id
                                    ? 'selected'
                                    : ''
                                }}
                            >

                                {{ $plaza->nombre_plaza }}

                                -

                                {{ $plaza->turno }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-lg-4">

                    <label
                        for="fecha_inicio"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de inicio

                        <span class="text-danger">

                            *

                        </span>

                    </label>

                    <input
                        type="date"
                        name="fecha_inicio"
                        id="fecha_inicio"
                        value="{{ old('fecha_inicio') }}"
                        class="form-control gtri-input"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- VALIDACIÓN REPSE --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>04</span>

                Validación de seguridad

            </div>


            <div
                class="rounded-3 p-4"
                style="
                    background:#111827;
                    border:1px solid #D4AF37;
                "
            >

                <div
                    class="
                        d-flex
                        align-items-start
                        gap-3
                    "
                >

                    <div
                        style="
                            color:#D4AF37;
                            font-size:2rem;
                        "
                    >

                        <i class="bi bi-shield-lock"></i>

                    </div>

                    <div>

                        <div
                            class="fw-bold mb-2"
                            style="color:#F8FAFC;"
                        >

                            Validación automática REPSE

                        </div>

                        <div
                            style="
                                color:#94A3B8;
                                line-height:1.7;
                            "
                        >

                            El sistema verificará nuevamente el cumplimiento
                            REPSE antes de guardar la asignación.

                            Si el empleado no cumple con los requisitos
                            obligatorios, la operación será bloqueada
                            automáticamente.

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BOTONES --}}
        <div class="gtri-section mb-0">

            <div
                class="
                    d-flex
                    flex-wrap
                    justify-content-end
                    gap-2
                "
            >

                <a
                    href="{{ route(
                        'operaciones.asignaciones.index'
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

                    Guardar asignación

                </button>

            </div>

        </div>

    </form>

</div>

@endsection