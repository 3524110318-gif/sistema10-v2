@extends('operaciones.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- CARD PRINCIPAL --}}
    <x-rh.card-rh titulo="Nueva asignación">

        {{-- ERRORES GENERALES --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Se encontraron algunos errores:
                </strong>

                <ul class="mb-0 mt-2">

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
            action="{{ route('operaciones.asignaciones.store') }}"
        >

            @csrf


            {{-- ========================================= --}}
            {{-- INFORMACIÓN DEL EMPLEADO --}}
            {{-- ========================================= --}}

            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-person-badge me-2"></i>

                    Empleado

                </h5>

                <p class="text-muted mb-2">

                    Seleccione al empleado que será asignado a una plaza operativa.

                </p>

                <hr>

            </div>


            <div class="mb-4">

                <label
                    for="empleado_id"
                    class="form-label fw-semibold"
                >

                    Empleado disponible

                    <span class="text-danger">
                        *
                    </span>

                </label>

                <select
                    name="empleado_id"
                    id="empleado_id"
                    class="form-select"
                    required
                >

                    <option value="">

                        Seleccione un empleado

                    </option>

                    @foreach($empleados as $empleado)

                        <option
                            value="{{ $empleado->id }}"
                            {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}
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

                <div class="form-text">

                    Los empleados bloqueados por REPSE no pueden ser seleccionados.

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- ESTADO REPSE --}}
            {{-- ========================================= --}}

            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-shield-check me-2"></i>

                    Estado de cumplimiento REPSE

                </h5>

                <hr>

            </div>


            <div class="row g-3 mb-4">

                @forelse($empleados as $empleado)

                    <div class="col-md-6">

                        <div
                            class="border rounded p-3 h-100
                            {{ $empleado->repse_apto ? 'border-success' : 'border-danger' }}"
                        >

                            <div class="d-flex justify-content-between align-items-start gap-3">

                                <div>

                                    <div class="fw-bold">

                                        {{ $empleado->numero_control }}

                                        -

                                        {{ $empleado->nombre }}

                                        {{ $empleado->apellido_paterno }}

                                    </div>

                                    @if($empleado->repse_apto)

                                        <small class="text-success">

                                            Cumple con los requisitos REPSE.

                                        </small>

                                    @else

                                        <small class="text-danger">

                                            No cumple con los requisitos REPSE.

                                        </small>

                                    @endif

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


                            @if(!$empleado->repse_apto)

                                <div class="mt-3">

                                    <small class="fw-semibold">

                                        Motivo:

                                    </small>

                                    <ul class="mb-0 mt-1 ps-3">

                                        @foreach($empleado->repse_faltantes as $faltante)

                                            <li class="text-muted">

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

                        <div class="alert alert-info mb-0">

                            <i class="bi bi-info-circle me-1"></i>

                            No hay empleados disponibles para asignación.

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- ========================================= --}}
            {{-- INFORMACIÓN DE LA PLAZA --}}
            {{-- ========================================= --}}

            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-geo-alt me-2"></i>

                    Plaza operativa

                </h5>

                <p class="text-muted mb-2">

                    Seleccione la plaza vacante que será cubierta.

                </p>

                <hr>

            </div>


            <div class="row">

                <div class="col-md-8 mb-4">

                    <label
                        for="plaza_operativa_id"
                        class="form-label fw-semibold"
                    >

                        Plaza operativa

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <select
                        name="plaza_operativa_id"
                        id="plaza_operativa_id"
                        class="form-select"
                        required
                    >

                        <option value="">

                            Seleccione una plaza

                        </option>

                        @foreach($plazas as $plaza)

                            <option
                                value="{{ $plaza->id }}"
                                {{ old('plaza_operativa_id') == $plaza->id ? 'selected' : '' }}
                            >

                                {{ $plaza->nombre_plaza }}

                                -

                                {{ $plaza->turno }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-4 mb-4">

                    <label
                        for="fecha_inicio"
                        class="form-label fw-semibold"
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
                        class="form-control"
                        required
                    >

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- AVISO DE BLOQUEO --}}
            {{-- ========================================= --}}

            <div class="alert alert-light border mb-4">

                <div class="d-flex align-items-start gap-3">

                    <div class="text-primary fs-4">

                        <i class="bi bi-shield-lock"></i>

                    </div>

                    <div>

                        <strong>

                            Validación automática REPSE

                        </strong>

                        <div class="text-muted mt-1">

                            El sistema verificará nuevamente el cumplimiento REPSE
                            antes de guardar la asignación.

                            Si el empleado no cumple con los requisitos obligatorios,
                            la operación será bloqueada automáticamente.

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- BOTONES --}}
            {{-- ========================================= --}}

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('operaciones.asignaciones.index') }}"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-x-circle"></i>

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="btn btn-success"
                >

                    <i class="bi bi-check-circle"></i>

                    Guardar asignación

                </button>

            </div>

        </form>

    </x-rh.card-rh>

</div>

@endsection