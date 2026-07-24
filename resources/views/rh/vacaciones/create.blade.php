@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

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


        <a
            href="{{ route('rh.vacaciones.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route('rh.vacaciones.store') }}"
    >

        @csrf


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos de la solicitud

            </div>


            <div class="row g-3">

                {{-- EMPLEADO --}}
                <div class="col-12">

                    <label
                        for="empleado_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

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


                {{-- FECHA INICIO --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de inicio"
                        name="fecha_inicio"
                        type="date"
                    />

                </div>


                {{-- FECHA FIN --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha de fin"
                        name="fecha_fin"
                        type="date"
                    />

                </div>


                {{-- DÍAS --}}
                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Días solicitados"
                        name="dias"
                        type="number"
                    />

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Observaciones

            </div>


            <x-rh.textarea-rh
                label="Observaciones"
                name="observaciones"
                placeholder="Escribe el motivo o alguna observación adicional sobre la solicitud de vacaciones..."

            />

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

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