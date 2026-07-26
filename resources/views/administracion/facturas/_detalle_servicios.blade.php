<div class="gtri-section">

    <div class="gtri-section-title">

        <span>02</span>

        Servicios facturados

    </div>


    <div class="gtri-table-wrapper">

        <div class="table-responsive">

            <table
                class="table gtri-table align-middle"
                id="tabla-servicios"
            >

                <thead>

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

                        <th
                            style="width:12%;"
                            class="text-center"
                        >
                            Acción
                        </th>

                    </tr>

                </thead>


                <tbody id="detalle-body">

                    <tr>

                        <td>

                            <select
                                name="servicio_id[]"
                                class="form-select gtri-select"
                                required
                            >

                                <option value="">

                                    Seleccione

                                </option>

                                @foreach($servicios as $servicio)

                                    <option
                                        value="{{ $servicio->id }}"
                                        data-contratadas="{{ $servicio->plazas_contratadas }}"
                                        data-cubiertas="{{ $servicio->plazas_cubiertas }}"
                                        data-vacantes="{{ $servicio->plazas_vacantes }}"
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
                                class="form-control gtri-input plazas"
                                min="0"
                                value="0"
                                readonly
                                required
                            >
                        </td>


                        <td>

                            <input
                                type="number"
                                name="plazas_cubiertas[]"
                                class="form-control gtri-input cubiertas"
                                min="0"
                                value="0"
                                readonly
                                required
                            >

                        </td>


                        <td>

                            <div class="input-group">

                                <span class="input-group-text gtri-addon">
                                    $
                                </span>

                                <input
                                    type="text"
                                    name="precio_unitario[]"
                                    class="form-control gtri-input precio"
                                    value="0"
                                    autocomplete="off"
                                    required
                                >

                            </div>

                        </td>


                        <td>

                            <input
                                type="text"
                                class="form-control gtri-input subtotal"
                                value="0.00"
                                readonly
                            >

                        </td>


                        <td class="text-center">

                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm eliminar-fila"
                                title="Eliminar servicio"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div
            id="alerta-cobertura"
            class="alert alert-warning d-none mt-3"
        >

            <div class="d-flex align-items-start gap-2">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <div>

                    <strong>

                        Cobertura incompleta detectada

                    </strong>

                    <div class="mt-1">

                        El servicio seleccionado tiene

                        <span
                            id="vacantes-detectadas"
                            class="fw-bold"
                        >
                            0
                        </span>

                        plaza(s) vacante(s).

                    </div>

                    <div class="mt-1">

                        Se recomienda revisar el importe facturable
                        o considerar una nota de crédito.

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="mt-3">

        <button
            type="button"
            class="btn gtri-btn-secondary"
            id="agregar-servicio"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Agregar servicio

        </button>

    </div>


    {{-- TOTALES --}}
    <div class="row justify-content-end mt-4">

        <div class="col-md-5 col-lg-4">

            <div class="gtri-card">

                <div
                    class="d-flex justify-content-between py-2 border-bottom border-secondary"
                >

                    <span class="text-secondary">
                        Subtotal
                    </span>

                    <strong id="subtotal-general">
                        $0.00
                    </strong>

                </div>

                <div
                    class="d-flex justify-content-between py-2 border-bottom border-secondary"
                >

                    <span class="text-secondary">
                        IVA (16%)
                    </span>

                    <strong id="iva-general">
                        $0.00
                    </strong>

                </div>

                <div class="d-flex justify-content-between pt-3">

                    <span class="text-warning fw-bold">

                        Total

                    </span>

                    <strong
                        id="total-general"
                        class="text-warning fs-5"
                    >

                        $0.00

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>