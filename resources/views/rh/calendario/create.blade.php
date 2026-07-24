@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-calendar-plus me-2"></i>

                Nuevo día calendario

            </h2>

            <p class="gtri-page-subtitle">

                Registra un nuevo día dentro del calendario laboral.

            </p>

        </div>

        <a
            href="{{ route('rh.calendario.index') }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Volver

        </a>

    </div>


    <form
        method="POST"
        action="{{ route('rh.calendario.store') }}"
    >

        @csrf


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Datos del día

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <x-rh.input-rh
                        label="Fecha"
                        name="fecha"
                        type="date"
                    />

                </div>


                <div class="col-md-6">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Tipo de día

                    </label>


                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Selecciona un tipo

                        </option>

                        <option
                            value="laboral"
                            @selected(old('tipo') === 'laboral')
                        >

                            Laboral

                        </option>

                        <option
                            value="descanso"
                            @selected(old('tipo') === 'descanso')
                        >

                            Descanso

                        </option>

                        <option
                            value="festivo"
                            @selected(old('tipo') === 'festivo')
                        >

                            Festivo

                        </option>

                        <option
                            value="vacaciones"
                            @selected(old('tipo') === 'vacaciones')
                        >

                            Vacaciones

                        </option>

                    </select>

                    @error('tipo')

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-12">

                    <x-rh.input-rh
                        label="Descripción"
                        name="descripcion"
                        type="text"
                        placeholder="Escribe una descripción del día, por ejemplo: Día festivo, descanso oficial o suspensión de labores..."

                    />

                </div>

            </div>

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route('rh.calendario.index') }}"
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

                    Guardar día

                </button>

            </div>

        </div>

    </form>

</div>

@endsection