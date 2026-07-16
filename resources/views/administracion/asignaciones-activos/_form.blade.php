<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Activo

        </label>

        <select
            name="activo_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un activo

            </option>

            @foreach($activos as $activo)

                <option
                    value="{{ $activo->id }}"
                    @selected(
                        old(
                            'activo_id',
                            $asignacion->activo_id ?? ''
                        ) == $activo->id
                    )
                >

                    {{ $activo->codigo_activo }}
                    -
                    {{ $activo->producto->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6">

        <label class="form-label">

            Empleado

        </label>

        <select
            name="empleado_id"
            class="form-select"
            required
        >

            <option value="">

                Seleccione un empleado

            </option>

            @foreach($empleados as $empleado)

                <option
                    value="{{ $empleado->id }}"
                    @selected(
                        old(
                            'empleado_id',
                            $asignacion->empleado_id ?? ''
                        ) == $empleado->id
                    )
                >

                    {{ $empleado->numero_control }}
                    -
                    {{ $empleado->nombre }}
                    {{ $empleado->apellido_paterno }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-6">

        <label class="form-label">

            Servicio

        </label>

        <select
            name="servicio_id"
            class="form-select"
        >

            <option value="">

                Sin servicio

            </option>

            @foreach($servicios as $servicio)

                <option
                    value="{{ $servicio->id }}"
                    @selected(
                        old(
                            'servicio_id',
                            $asignacion->servicio_id ?? ''
                        ) == $servicio->id
                    )
                >

                    {{ $servicio->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-3">

        <label class="form-label">

            Fecha de entrega

        </label>

        <input
            type="date"
            name="fecha_entrega"
            class="form-control"
            value="{{ old('fecha_entrega', isset($asignacion) && $asignacion->fecha_entrega ? $asignacion->fecha_entrega->format('Y-m-d') : date('Y-m-d')) }}"
            required
        >

    </div>

    <div class="col-md-3">

        <label class="form-label">

            Fecha de devolución

        </label>

        <input
            type="date"
            name="fecha_devolucion"
            class="form-control"
            value="{{ old('fecha_devolucion', isset($asignacion) && $asignacion->fecha_devolucion ? $asignacion->fecha_devolucion->format('Y-m-d') : '') }}"
        >

    </div>

</div>

<div class="row mt-3">

    <div class="col-md-4">

        <label class="form-label">

            Estado

        </label>

        <select
            name="estado"
            class="form-select"
            required
        >

            <option
                value="activa"
                @selected(old('estado', $asignacion->estado ?? 'activa') == 'activa')
            >

                Activa

            </option>

            <option
                value="devuelta"
                @selected(old('estado', $asignacion->estado ?? '') == 'devuelta')
            >

                Devuelta

            </option>

        </select>

    </div>

</div>

<div class="mt-3">

    <label class="form-label">

        Observaciones

    </label>

    <textarea
        name="observaciones"
        rows="4"
        class="form-control"
    >{{ old('observaciones', $asignacion->observaciones ?? '') }}</textarea>

</div>

<div class="mt-4">

    <button
        type="submit"
        class="btn btn-primary"
    >

        Guardar

    </button>

    <a
        href="{{ route('administracion.asignaciones-activos.index') }}"
        class="btn btn-secondary"
    >

        Cancelar

    </a>

</div>
