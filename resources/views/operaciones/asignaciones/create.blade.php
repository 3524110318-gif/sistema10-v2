@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <h1>Nueva Asignación</h1>

    @if ($errors->has('repse'))

        <div
            class="alert alert-danger"
        >

            {{ $errors->first('repse') }}

        </div>

    @endif

    <form
        method="POST"
        action="{{ route('operaciones.asignaciones.store') }}"
    >

        @csrf

        <div class="mb-3">

            <label>Empleado</label>

            <select
                name="empleado_id"
                class="form-control"
                required
            >

                <option value="">
                    Seleccione un empleado
                </option>

                @foreach($empleados as $empleado)

                    <option
                        value="{{ $empleado->id }}"
                        @if(
                            !$empleado->repse_apto
                        )
                            disabled
                        @endif
                    >

                        {{ $empleado->numero_control }}
                        -
                        {{ $empleado->nombre }}
                        {{ $empleado->apellido_paterno }}

                        @if(
                            $empleado->repse_apto
                        )

                            ✅ APTO

                        @else

                            ⛔ BLOQUEADO REPSE

                        @endif

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Plaza Operativa</label>

            <select
                name="plaza_operativa_id"
                class="form-control"
                required
            >

                <option value="">
                    Seleccione una plaza
                </option>

                @foreach($plazas as $plaza)

                    <option
                        value="{{ $plaza->id }}"
                    >

                        {{ $plaza->nombre_plaza }}
                        -
                        {{ $plaza->turno }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Fecha Inicio</label>

            <input
                type="date"
                name="fecha_inicio"
                class="form-control"
                required
            >

        </div>

        <button
            class="btn btn-success"
        >

            Guardar

        </button>

    </form>

</div>

@endsection
