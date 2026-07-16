<h5 class="mb-3">

    Servicios facturados

</h5>

<div class="table-responsive">

    <table
        class="table table-bordered align-middle"
        id="tabla-servicios"
    >

        <thead class="table-dark">

            <tr>

                <th style="width:28%;">

                    Servicio

                </th>

                <th style="width:15%;">

                    Plazas contratadas

                </th>

                <th style="width:15%;">

                    Plazas cubiertas

                </th>

                <th style="width:15%;">

                    Precio unitario

                </th>

                <th style="width:15%;">

                    Subtotal

                </th>

                <th style="width:12%;">

                    Acción

                </th>

            </tr>

        </thead>

        <tbody id="detalle-body">

            <tr>

                <td>

                    <select
                        name="servicio_id[]"
                        class="form-select"
                        required
                    >

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($servicios as $servicio)

                            <option
                                value="{{ $servicio->id }}"
                            >

                                {{ $servicio->nombre }}

                            </option>

                        @endforeach

                    </select>

                </td>

                <td>

                    <input
                        type="number"
                        name="plazas_contratadas[]"
                        class="form-control plazas"
                        min="0"
                        value="0"
                        required
                    >

                </td>

                <td>

                    <input
                        type="number"
                        name="plazas_cubiertas[]"
                        class="form-control cubiertas"
                        min="0"
                        value="0"
                        required
                    >

                </td>

                <td>

                    <input
                        type="text"
                        name="precio_unitario[]"
                        class="form-control precio"
                        value="0"
                        autocomplete="off"
                        required
                    >

                </td>

                <td>

                    <input
                        type="text"
                        class="form-control subtotal"
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

<div class="mt-3">

    <button
        type="button"
        class="btn btn-success"
        id="agregar-servicio"
    >

        <i class="bi bi-plus-circle"></i>

        Agregar servicio

    </button>

</div>

<hr class="my-4">

<div class="row justify-content-end">

    <div class="col-md-4">

        <table class="table table-bordered">

            <tr>

                <th>

                    Subtotal

                </th>

                <td id="subtotal-general">

                    $0.00

                </td>

            </tr>

            <tr>

                <th>

                    IVA (16%)

                </th>

                <td id="iva-general">

                    $0.00

                </td>

            </tr>

            <tr class="table-light">

                <th>

                    Total

                </th>

                <th id="total-general">

                    $0.00

                </th>

            </tr>

        </table>

    </div>

</div>
