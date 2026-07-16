<h5 class="mb-3">

    Empleados

</h5>

<div
    class="table-responsive"
    style="overflow-x:auto;"
>

    <table
        class="table table-bordered align-middle"
        id="tabla-empleados"
        style="min-width:1700px;"
    >

        <thead class="table-dark">

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
                        class="form-select"
                        required
                    >

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($empleados as $empleado)

                            <option
                                value="{{ $empleado->id }}"
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
                        type="text"
                        name="salario_base[]"
                        class="form-control salario text-end"
                        value="0"
                        required
                    >

                </td>

                <td>

                    <input
                        type="number"
                        name="dias_laborados[]"
                        class="form-control dias-laborados text-end"
                        value="15"
                        min="0"
                    >

                </td>

                <td>

                    <input
                        type="number"
                        name="dias_incapacidad[]"
                        class="form-control dias-incapacidad text-end"
                        value="0"
                        min="0"
                    >

                </td>

                <td>

                    <input
                        type="text"
                        name="folio_imss[]"
                        class="form-control folio-imss"
                    >

                </td>

                <td>

                    <input
                        type="text"
                        name="percepciones[]"
                        class="form-control percepciones text-end"
                        value="0"
                    >

                </td>

                <td>

                    <input
                        type="text"
                        name="deducciones[]"
                        class="form-control deducciones text-end"
                        value="0"
                    >

                </td>

                <td>

                    <input
                        type="text"
                        name="ajustes[]"
                        class="form-control ajustes text-end"
                        value="0"
                    >

                </td>

                <td>

                <input
                    type="text"
                    name="justificacion[]"
                    class="form-control justificacion"
                    placeholder="Obligatoria si hay ajuste"
                >

            </td>

                <td>

                    <input
                        type="text"
                        name="horas_extra[]"
                        class="form-control horas-extra text-end"
                        value="0"
                    >

                </td>

                <td>

                    <input
                        type="text"
                        class="form-control total-neto text-end fw-bold"
                        value="0.00"
                        readonly
                    >

                </td>

                <td class="text-center">

                    <button
                        type="button"
                        class="btn btn-danger btn-sm eliminar-fila"
                    >

                        <i class="bi bi-trash"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>

</div>

<button
    type="button"
    class="btn btn-success"
    id="agregar-empleado"
>

    <i class="bi bi-plus-circle"></i>

    Agregar empleado

</button>

<hr class="my-4">

<div class="row justify-content-end">

    <div class="col-md-4">

        <table class="table table-bordered">

            <tr>

                <th>

                    Total Nómina

                </th>

                <td
                    id="total-nomina"
                    class="text-end fw-bold fs-5"
                >

                    $ 0.00

                </td>

            </tr>

        </table>

    </div>

</div>
