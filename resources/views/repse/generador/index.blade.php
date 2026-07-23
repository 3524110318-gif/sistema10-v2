@extends('repse.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- ENCABEZADO --}}
    <div class="mb-4">

        <h4 class="fw-bold mb-1">

            <i class="bi bi-file-earmark-zip me-2"></i>

            Generador Mensual REPSE

        </h4>

        <p class="text-muted mb-0">

            Genera el expediente mensual REPSE correspondiente
            a los guardias asignados a un cliente.

        </p>

    </div>


    {{-- CARD PRINCIPAL --}}
    <x-rh.card-rh titulo="Generar expediente mensual">

        <div class="mb-4">

            <h5 class="fw-bold">

                <i class="bi bi-building me-2"></i>

                Selección del periodo

            </h5>

            <p class="text-muted mb-2">

                Seleccione el cliente y el mes correspondiente
                para preparar la documentación REPSE.

            </p>

            <hr>

        </div>


        <form
            method="POST"
            action="{{ route('repse.generador.generar') }}"
        >

            @csrf

            <div class="row">

                {{-- CLIENTE --}}
                <div class="col-md-6 mb-4">

                    <label
                        for="cliente_id"
                        class="form-label fw-semibold"
                    >

                        Cliente

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <select
                        name="cliente_id"
                        id="cliente_id"
                        class="form-select"
                        required
                    >

                        <option value="">

                            Seleccione un cliente

                        </option>

                        @foreach($clientes as $cliente)

                            <option value="{{ $cliente->id }}">

                                {{ $cliente->razon_social }}

                            </option>

                        @endforeach

                    </select>

                    <div class="form-text">

                        Solo se incluirán guardias asignados
                        a plazas pertenecientes a este cliente.

                    </div>

                </div>


                {{-- MES --}}
                <div class="col-md-6 mb-4">

                    <label
                        for="mes"
                        class="form-label fw-semibold"
                    >

                        Mes del expediente

                        <span class="text-danger">
                            *
                        </span>

                    </label>

                    <input
                        type="month"
                        name="mes"
                        id="mes"
                        class="form-control"
                        value="{{ now()->format('Y-m') }}"
                        required
                    >

                    <div class="form-text">

                        Seleccione el periodo que desea procesar.

                    </div>

                </div>

            </div>


            {{-- INFORMACIÓN --}}
            <div class="alert alert-light border mb-4">

                <div class="d-flex align-items-start gap-3">

                    <div class="fs-3 text-primary">

                        <i class="bi bi-info-circle"></i>

                    </div>

                    <div>

                        <strong>

                            Contenido del expediente REPSE

                        </strong>

                        <div class="text-muted mt-1">

                            El sistema identificará únicamente a los
                            guardias asignados a las plazas del cliente
                            seleccionado durante el periodo indicado.

                        </div>

                    </div>

                </div>

            </div>


            {{-- DOCUMENTACIÓN --}}
            <div class="mb-4">

                <h5 class="fw-bold">

                    <i class="bi bi-folder-check me-2"></i>

                    Documentación a compilar

                </h5>

                <hr>

            </div>


            <div class="row g-3 mb-4">

                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <i class="bi bi-check-circle text-success me-2"></i>

                        <strong>
                            Altas IMSS
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <i class="bi bi-check-circle text-success me-2"></i>

                        <strong>
                            Nóminas XML / PDF
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <i class="bi bi-check-circle text-success me-2"></i>

                        <strong>
                            Pago SUA
                        </strong>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <i class="bi bi-check-circle text-success me-2"></i>

                        <strong>
                            Constancias SAT
                        </strong>

                    </div>

                </div>

            </div>


            {{-- BOTÓN --}}
            <div class="d-flex justify-content-end">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-search me-1"></i>

                    Preparar expediente

                </button>

            </div>

        </form>

    </x-rh.card-rh>

</div>

@endsection