<div class="gtri-form">

    {{-- 01 ASIGNACIÓN --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Datos de asignación

        </div>

        <div class="row g-4">

            {{-- ACTIVO --}}
            <div class="col-md-6">

                <label
                    for="activo_id"
                    class="gtri-label mb-2"
                >

                    Activo

                    <span class="text-danger">*</span>

                </label>


                @if(isset($asignacion))

                    <input
                        type="hidden"
                        name="activo_id"
                        value="{{ $asignacion->activo_id }}"
                    >

                    <input
                        type="text"
                        id="activo_id"
                        class="form-control gtri-input"
                        value="{{ $asignacion->activo->codigo_activo }}
                        -
                        {{ $asignacion->activo->producto->nombre }}"
                        readonly
                    >

                    <small class="text-secondary d-block mt-1">

                        El activo no puede cambiarse después de crear la asignación.

                    </small>

                @else

                    <select
                        name="activo_id"
                        id="activo_id"
                        class="form-select gtri-select"
                        required
                    >

                        <option value="">

                            Seleccione un activo

                        </option>

                        @foreach($activos as $activo)

                            <option
                                value="{{ $activo->id }}"
                                @selected(
                                    old('activo_id') == $activo->id
                                )
                            >

                                {{ $activo->codigo_activo }}
                                -
                                {{ $activo->producto->nombre }}

                            </option>

                        @endforeach

                    </select>

                @endif


                @error('activo_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- EMPLEADO --}}
            <div class="col-md-6">

                <label
                    for="empleado_id"
                    class="gtri-label mb-2"
                >

                    Empleado

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="empleado_id"
                    id="empleado_id"
                    class="form-select gtri-select"
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

                @error('empleado_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- 02 UBICACIÓN Y FECHAS --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>02</span>

            Servicio y vigencia

        </div>

        <div class="row g-4">

            {{-- SERVICIO --}}
            <div class="col-md-6">

                <label
                    for="servicio_id"
                    class="gtri-label mb-2"
                >

                    Servicio

                </label>

                <select
                    name="servicio_id"
                    id="servicio_id"
                    class="form-select gtri-select"
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

                @error('servicio_id')

                    <small class="text-danger d-block mt-1">

                        {{ $message }}

                    </small>

                @enderror

            </div>


            {{-- FECHA ENTREGA --}}
            <div class="col-md-6">

                <label
                    for="fecha_entrega"
                    class="gtri-label mb-2"
                >

                    Fecha de entrega

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="date"
                    name="fecha_entrega"
                    id="fecha_entrega"
                    class="form-control gtri-input"
                    value="{{ old(
                        'fecha_entrega',
                        isset($asignacion) && $asignacion->fecha_entrega
                            ? $asignacion->fecha_entrega->format('Y-m-d')
                            : date('Y-m-d')
                    ) }}"
                    required
                >

            </div>

        </div>

    </div>

    {{-- 03 OBSERVACIONES --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>03</span>

            Información complementaria

        </div>

        <label
            for="observaciones"
            class="gtri-label mb-2"
        >

            Observaciones

        </label>

        <textarea
            name="observaciones"
            id="observaciones"
            rows="4"
            class="form-control gtri-textarea"
            placeholder="Ingrese observaciones relacionadas con la asignación..."
        >{{ old(
            'observaciones',
            $asignacion->observaciones ?? ''
        ) }}</textarea>

    </div>


    {{-- ACCIONES --}}
    <div class="d-flex justify-content-end gap-3 mt-4">

        <a
            href="{{ route('administracion.asignaciones-activos.index') }}"
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

            {{ isset($asignacion)
                ? 'Actualizar asignación'
                : 'Guardar asignación'
            }}

        </button>

    </div>

</div>