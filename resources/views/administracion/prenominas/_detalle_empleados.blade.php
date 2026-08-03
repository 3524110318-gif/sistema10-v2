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

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Seleccione al empleado que será incluido en la prenómina."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:130px;"
                        class="text-center"
                    >

                        Salario Base

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Cantidad que le corresponde al empleado por el periodo completo."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:110px;"
                        class="text-center"
                    >

                        Días Laborados

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Número de días que el empleado trabajó durante el periodo."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:110px;"
                        class="text-center"
                    >

                        Incapacidad

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Número de días que el empleado estuvo incapacitado durante el periodo."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:140px;"
                        class="text-center"
                    >

                        Folio IMSS

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Número del comprobante de incapacidad emitido por el IMSS. Es obligatorio cuando hay días de incapacidad."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:130px;"
                        class="text-center"
                    >

                        Percepciones

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Pagos adicionales al salario, como bonos, comisiones, incentivos o vales."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:130px;"
                        class="text-center"
                    >

                        Deducciones

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Descuentos aplicados al empleado. En esta pantalla se calcula automáticamente la deducción por uniforme."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:120px;"
                        class="text-center"
                    >

                        Ajustes

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Corrección manual al pago. Puede ser positiva para aumentar o negativa para disminuir el total."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:220px;"
                        class="text-center"
                    >

                        Justificación

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Motivo por el cual se realizó un ajuste. Es obligatoria cuando el ajuste es diferente de cero."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:130px;"
                        class="text-center"
                    >

                        Horas Extra

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Importe adicional que se pagará por las horas extra trabajadas."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:150px;"
                        class="text-center"
                    >

                        Total Neto

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Cantidad final que recibirá el empleado después de sumar pagos y restar descuentos."
                            style="cursor:help;"
                        ></i>

                    </th>

                    <th
                        style="min-width:80px;"
                        class="text-center"
                    >

                        Acción

                    </th>

                </tr>

            </thead>

            <tbody id="detalle-body">

                @php

                    $detalles = isset($prenomina)
                        ? $prenomina->detalles
                        : collect([null]);

                @endphp

                @foreach($detalles as $detalle)

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

                                    <option
                                        value="{{ $empleado->id }}"
                                        @selected(
                                            old(
                                                'empleado_id.' . $loop->parent->index,
                                                $detalle->empleado_id ?? ''
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

                        </td>


<td>

    <input
        type="number"
        name="salario_base[]"
        class="form-control gtri-input salario text-end"
        value="{{ old(
            'salario_base.' . $loop->index,
            $detalle->salario_base ?? 0
        ) }}"
        min="0"
        step="0.01"
        required
    >

</td>


                        <td>

                            <input
                                type="number"
                                name="dias_laborados[]"
                                class="form-control gtri-input dias-laborados text-end"
                                value="{{ old(
                                    'dias_laborados.' . $loop->index,
                                    $detalle->dias_laborados ?? 15
                                ) }}"
                                min="0"
                            >

                        </td>


                        <td>

                            <input
                                type="number"
                                name="dias_incapacidad[]"
                                class="form-control gtri-input dias-incapacidad text-end"
                                value="{{ old(
                                    'dias_incapacidad.' . $loop->index,
                                    $detalle->dias_incapacidad ?? 0
                                ) }}"
                                min="0"
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                name="folio_imss[]"
                                class="form-control gtri-input folio-imss"
                                value="{{ old(
                                    'folio_imss.' . $loop->index,
                                    $detalle->folio_imss ?? ''
                                ) }}"
                                placeholder="Folio IMSS"
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                name="percepciones[]"
                                class="form-control gtri-input percepciones text-end"
                                value="{{ old(
                                    'percepciones.' . $loop->index,
                                    $detalle->percepciones ?? 0
                                ) }}"
                            >

                        </td>


                        <td>

                            <input
                                type="hidden"
                                name="deducciones[]"
                                class="deducciones-enviadas"
                                value="0"
                            >

                            <input
                                type="text"
                                class="form-control gtri-input deducciones text-end"
                                value="{{ number_format(
                                    $detalle->deducciones ?? 0,
                                    2,
                                    '.',
                                    ','
                                ) }}"
                                readonly
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                name="ajustes[]"
                                class="form-control gtri-input ajustes text-end"
                                value="{{ old(
                                    'ajustes.' . $loop->index,
                                    $detalle->ajustes ?? 0
                                ) }}"
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                name="justificacion[]"
                                class="form-control gtri-input justificacion"
                                value="{{ old(
                                    'justificacion.' . $loop->index,
                                    $detalle->justificacion ?? ''
                                ) }}"
                                placeholder="Obligatoria si hay ajuste"
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                name="horas_extra[]"
                                class="form-control gtri-input horas-extra text-end"
                                value="{{ old(
                                    'horas_extra.' . $loop->index,
                                    $detalle->horas_extra ?? 0
                                ) }}"
                            >

                        </td>


                        <td>

                            <input
                                type="text"
                                class="form-control gtri-input total-neto text-end fw-bold"
                                value="{{ number_format(
                                    $detalle->total_neto ?? 0,
                                    2,
                                    '.',
                                    ','
                                ) }}"
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

                @endforeach

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

                        <i
                            class="bi bi-info-circle ms-1"
                            title="Suma de los totales netos de todos los empleados incluidos."
                            style="cursor:help;"
                        ></i>

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