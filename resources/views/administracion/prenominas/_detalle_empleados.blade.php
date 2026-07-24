<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Empleados incluidos

    </div>


    <div
        class="table-responsive"
        style="overflow-x:auto;"
    >

        <table
            class="table gtri-table align-middle"
            id="tabla-empleados"
            style="min-width:1700px;"
        >

            <thead>

                <tr>

                    <th style="min-width:220px;">
                        Empleado
                    </th>

                    <th style="min-width:130px;" class="text-center">
                        Salario Base
                    </th>

                    <th style="min-width:110px;" class="text-center">
                        Días Laborados
                    </th>

                    <th style="min-width:110px;" class="text-center">
                        Incapacidad
                    </th>

                    <th style="min-width:140px;" class="text-center">
                        Folio IMSS
                    </th>

                    <th style="min-width:130px;" class="text-center">
                        Percepciones
                    </th>

                    <th style="min-width:130px;" class="text-center">
                        Deducciones
                    </th>

                    <th style="min-width:120px;" class="text-center">
                        Ajustes
                    </th>

                    <th style="min-width:220px;" class="text-center">
                        Justificación
                    </th>

                    <th style="min-width:130px;" class="text-center">
                        Horas Extra
                    </th>

                    <th style="min-width:150px;" class="text-center">
                        Total Neto
                    </th>

                    <th style="min-width:80px;" class="text-center">
                        Acción
                    </th>

                </tr>

            </thead>

            <tbody id="detalle-body">

                <tr>

                    <td>

                        <select
                            name="empleado_id[]"
                            class="form-select gtri-select"
                            required
                        >

                            <option value="">
                                Seleccione
                            </option>

                            @foreach($empleados as $empleado)

                                <option value="{{ $empleado->id }}">

                                    {{ $empleado->numero_control }}
                                    -
                                    {{ $empleado->nombre }}
                                    {{ $empleado->apellido_paterno }}

                                </option>

                            @endforeach

                        </select>

                    </td>


                    <td>

                        <input
                            type="text"
                            name="salario_base[]"
                            class="form-control gtri-input salario text-end"
                            value="0"
                            required
                        >

                    </td>


                    <td>

                        <input
                            type="number"
                            name="dias_laborados[]"
                            class="form-control gtri-input dias-laborados text-end"
                            value="15"
                            min="0"
                        >

                    </td>


                    <td>

                        <input
                            type="number"
                            name="dias_incapacidad[]"
                            class="form-control gtri-input dias-incapacidad text-end"
                            value="0"
                            min="0"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="folio_imss[]"
                            class="form-control gtri-input folio-imss"
                            placeholder="Folio IMSS"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="percepciones[]"
                            class="form-control gtri-input percepciones text-end"
                            value="0"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="deducciones[]"
                            class="form-control gtri-input deducciones text-end"
                            value="0"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="ajustes[]"
                            class="form-control gtri-input ajustes text-end"
                            value="0"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="justificacion[]"
                            class="form-control gtri-input justificacion"
                            placeholder="Obligatoria si hay ajuste"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            name="horas_extra[]"
                            class="form-control gtri-input horas-extra text-end"
                            value="0"
                        >

                    </td>


                    <td>

                        <input
                            type="text"
                            class="form-control gtri-input total-neto text-end fw-bold"
                            value="0.00"
                            readonly
                        >

                    </td>


                    <td class="text-center">

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm eliminar-fila"
                            title="Eliminar empleado"
                        >

                            <i class="bi bi-trash"></i>

                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    <div class="mt-3">

        <button
            type="button"
            class="btn gtri-btn-secondary"
            id="agregar-empleado"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Agregar empleado

        </button>

    </div>


    {{-- TOTAL --}}
    <div class="row justify-content-end mt-4">

        <div class="col-md-4">

            <div class="gtri-card">

                <div class="d-flex justify-content-between align-items-center">

                    <span class="text-secondary">

                        Total Nómina

                    </span>

                    <strong
                        id="total-nomina"
                        class="text-warning fs-4"
                    >

                        $ 0.00

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>