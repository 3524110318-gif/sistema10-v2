@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar día

            </h2>

            <p class="gtri-page-subtitle">

                Modifica la información del día registrado.

            </p>

        </div>

    </div>


    <div class="gtri-section">

        <form
            method="POST"
            action="{{ route(
                'rh.calendario.update',
                $calendario
            ) }}"
        >

            @csrf
            @method('PUT')


            <div class="row g-4">

                <div class="col-md-6">

                    <label
                        for="fecha"
                        class="form-label text-light"
                    >

                        Fecha

                    </label>

                    <input
                        type="date"
                        name="fecha"
                        id="fecha"
                        class="form-control gtri-input"
                        value="{{ old(
                            'fecha',
                            $calendario->fecha
                        ) }}"
                        required
                    >

                    @error('fecha')

                        <div class="text-danger mt-2">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-md-6">

                    <label
                        for="tipo"
                        class="form-label text-light"
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

                        @foreach ([
                            'laboral' => 'Laboral',
                            'descanso' => 'Descanso',
                            'festivo' => 'Festivo',
                            'vacaciones' => 'Vacaciones',
                        ] as $valor => $texto)

                            <option
                                value="{{ $valor }}"
                                @selected(
                                    old(
                                        'tipo',
                                        $calendario->tipo
                                    ) === $valor
                                )
                            >

                                {{ $texto }}

                            </option>

                        @endforeach

                    </select>

                    @error('tipo')

                        <div class="text-danger mt-2">

                            {{ $message }}

                        </div>

                    @enderror

                </div>


                <div class="col-12">

                    <label
                        for="descripcion"
                        class="form-label text-light"
                    >

                        Descripción

                    </label>

                    <textarea
                        name="descripcion"
                        id="descripcion"
                        rows="4"
                        class="form-control gtri-input"
                        placeholder="Ej. Día festivo oficial..."
                    >{{ old(
                        'descripcion',
                        $calendario->descripcion
                    ) }}</textarea>

                    @error('descripcion')

                        <div class="text-danger mt-2">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>


            <div class="d-flex flex-wrap gap-2 mt-4">

                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-check-circle me-1"></i>

                    Guardar cambios

                </button>


                <a
                    href="{{ route(
                        'rh.calendario.index'
                    ) }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Volver

                </a>

            </div>

        </form>

    </div>

</div>

@endsection