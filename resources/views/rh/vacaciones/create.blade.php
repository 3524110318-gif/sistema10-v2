@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-airplane me-2"></i>

                Nueva solicitud de vacaciones

            </h2>

            <p class="gtri-page-subtitle">

                Registra una nueva solicitud de vacaciones para un empleado.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('rh.vacaciones.store') }}"
    >

        @csrf


        {{-- DATOS DE LA SOLICITUD --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos de la solicitud

            </div>


            <div class="row g-4">

                {{-- EMPLEADO --}}
                <div class="col-12">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        <i class="bi bi-person-badge me-1 text-warning"></i>

                        Empleado

                    </label>


                    <select
                        name="empleado_id"
                        id="empleado_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un empleado

                        </option>


                        @foreach ($empleados as $empleado)

                            <option
                                value="{{ $empleado->id }}"
                                @selected(
                                    old('empleado_id') ==
                                    $empleado->id
                                )
                            >

                                {{ $empleado->numero_control }}

                                -

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


                {{-- FECHA DE INICIO --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de inicio"
                        name="fecha_inicio"
                        type="date"
                        :value="old('fecha_inicio')"
                    />


                    <small class="text-secondary d-block mt-1">

                        Primer día del periodo solicitado.

                    </small>

                </div>


                {{-- FECHA DE FIN --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de fin"
                        name="fecha_fin"
                        type="date"
                        :value="old('fecha_fin')"
                    />


                    <small class="text-secondary d-block mt-1">

                        Último día del periodo solicitado.

                    </small>

                </div>


                {{-- AVISO DE CÁLCULO --}}
                <div class="col-12">

                    <div
                        class="
                            d-flex
                            align-items-center
                            gap-3
                            rounded-3
                            p-3
                        "
                        style="
                            background:rgba(15,94,199,.10);
                            border:1px solid rgba(15,94,199,.25);
                        "
                    >

                        <i
                            class="
                                bi
                                bi-calculator
                                fs-4
                                text-info
                            "
                        ></i>


                        <div>

                            <span class="text-light fw-semibold d-block">

                                Cálculo automático

                            </span>

                            <small class="text-secondary">

                                Los días solicitados se calcularán automáticamente
                                con base en las fechas seleccionadas.

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- OBSERVACIONES --}}
        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Observaciones

            </div>


            <x-rh.textarea-rh
                label="Motivo u observaciones adicionales"
                name="observaciones"
                placeholder="Ej. Vacaciones correspondientes al periodo 2026 o alguna indicación adicional..."
            >{{ old('observaciones') }}</x-rh.textarea-rh>


            <small class="text-secondary d-block mt-2">

                Este campo es opcional.

            </small>

        </div>


        {{-- ACCIONES --}}
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
                    href="{{ route('rh.vacaciones.index') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-calendar-check me-1"></i>

                    Guardar solicitud

                </button>

            </div>

        </div>

    </form>

</div>

@endsection