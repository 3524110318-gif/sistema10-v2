@extends('repse.layouts.app')

@section('contenido')

<div class="container-fluid">

    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-file-earmark-zip me-2"></i>

                Generador Mensual REPSE

            </h2>

            <p class="gtri-page-subtitle">

                Genera el expediente mensual REPSE correspondiente a los guardias asignados a un cliente.

            </p>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route('repse.generador.generar') }}"
    >

        @csrf


        <!-- 01 · SELECCIÓN DEL PERIODO -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Selección del periodo

            </div>

            <p class="text-secondary mb-4">

                Seleccione el cliente y el mes correspondiente para preparar la documentación REPSE.

            </p>


            <div class="row g-3">

                <!-- CLIENTE -->

                <div class="col-md-6">

                    <label
                        for="cliente_id"
                        class="form-label"
                    >

                        Cliente

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="cliente_id"
                        id="cliente_id"
                        class="form-select gtri-input"
                        required
                    >

                        <option value="">

                            Seleccione un cliente

                        </option>

                        @foreach($clientes as $cliente)

                            <option
                                value="{{ $cliente->id }}"
                                @selected(old('cliente_id') == $cliente->id)
                            >

                                {{ $cliente->razon_social }}

                            </option>

                        @endforeach

                    </select>

                    <div class="form-text">

                        Solo se incluirán guardias asignados a plazas pertenecientes a este cliente.

                    </div>

                </div>


                <!-- MES -->

                <div class="col-md-6">

                    <label
                        for="mes"
                        class="form-label"
                    >

                        Mes del expediente

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="month"
                        name="mes"
                        id="mes"
                        class="form-control gtri-input"
                        value="{{ old('mes', now()->format('Y-m')) }}"
                        required
                    >

                    <div class="form-text">

                        Seleccione el periodo que desea procesar.

                    </div>

                </div>

            </div>

        </div>


        <!-- 02 · INFORMACIÓN DEL PROCESO -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Contenido del expediente

            </div>


            <div class="gtri-card">

                <div class="d-flex align-items-start gap-3">

                    <div class="gtri-stat-icon">

                        <i class="bi bi-info-circle fs-3"></i>

                    </div>

                    <div>

                        <h5 class="text-light mb-2">

                            Generación automática del expediente REPSE

                        </h5>

                        <p class="text-secondary mb-0">

                            El sistema identificará únicamente a los guardias asignados a las plazas del cliente seleccionado durante el periodo indicado.

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- 03 · DOCUMENTACIÓN A COMPILAR -->

        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Documentación a compilar

            </div>

            <div class="row g-3">

                <div class="col-md-6">

                    <div class="gtri-card h-100 d-flex align-items-center gap-3">

                        <div class="gtri-stat-icon">

                            <i class="bi bi-person-check fs-4"></i>

                        </div>

                        <div>

                            <div class="fw-bold text-light">

                                Altas IMSS

                            </div>

                            <small class="text-secondary">

                                Documentación de alta de cada trabajador.

                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-card h-100 d-flex align-items-center gap-3">

                        <div class="gtri-stat-icon">

                            <i class="bi bi-file-earmark-text fs-4"></i>

                        </div>

                        <div>

                            <div class="fw-bold text-light">

                                Nóminas XML / PDF

                            </div>

                            <small class="text-secondary">

                                Comprobantes correspondientes al periodo.

                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-card h-100 d-flex align-items-center gap-3">

                        <div class="gtri-stat-icon">

                            <i class="bi bi-bank fs-4"></i>

                        </div>

                        <div>

                            <div class="fw-bold text-light">

                                Pago SUA

                            </div>

                            <small class="text-secondary">

                                Documento general correspondiente al periodo.

                            </small>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="gtri-card h-100 d-flex align-items-center gap-3">

                        <div class="gtri-stat-icon">

                            <i class="bi bi-receipt fs-4"></i>

                        </div>

                        <div>

                            <div class="fw-bold text-light">

                                Constancias SAT

                            </div>

                            <small class="text-secondary">

                                Constancias fiscales requeridas para REPSE.

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- 04 · ACCIONES -->

        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end">

                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-search me-1"></i>

                    Preparar expediente

                </button>

            </div>

        </div>

    </form>

</div>

@endsection