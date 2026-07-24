@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-pencil-square me-2"></i>

                Editar contrato

            </h2>

            <p class="gtri-page-subtitle">

                Actualiza la información y estado del contrato.

            </p>

        </div>


        <a
            href="{{ route(
                'operaciones.contratos.show',
                $contrato
            ) }}"
            class="btn gtri-btn-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Regresar

        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>

                <i class="bi bi-exclamation-triangle me-1"></i>

                Se encontraron los siguientes errores:

            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route(
            'operaciones.contratos.update',
            $contrato
        ) }}"
    >

        @csrf
        @method('PUT')


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>01</span>

                Información del contrato

            </div>


            <div class="row g-3">

                <div class="col-md-6">

                    <label
                        for="cliente_id"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Cliente

                    </label>


                    <select
                        name="cliente_id"
                        id="cliente_id"
                        class="form-select gtri-input"
                        required
                    >

                        @foreach($clientes as $cliente)

                            <option
                                value="{{ $cliente->id }}"
                                @selected(
                                    old(
                                        'cliente_id',
                                        $contrato->cliente_id
                                    ) == $cliente->id
                                )
                            >

                                {{ $cliente->razon_social }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6">

                    <label
                        for="numero_contrato"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Número de contrato

                    </label>


                    <input
                        type="text"
                        name="numero_contrato"
                        id="numero_contrato"
                        class="form-control gtri-input"
                        value="{{ old(
                            'numero_contrato',
                            $contrato->numero_contrato
                        ) }}"
                        required
                    >

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>02</span>

                Vigencia y estado

            </div>


            <div class="row g-3">

                <div class="col-md-4">

                    <label
                        for="fecha_inicio"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de inicio

                    </label>


                    <input
                        type="date"
                        name="fecha_inicio"
                        id="fecha_inicio"
                        class="form-control gtri-input"
                        value="{{ old(
                            'fecha_inicio',
                            $contrato->fecha_inicio
                        ) }}"
                        required
                    >

                </div>


                <div class="col-md-4">

                    <label
                        for="fecha_fin"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Fecha de fin

                    </label>


                    <input
                        type="date"
                        name="fecha_fin"
                        id="fecha_fin"
                        class="form-control gtri-input"
                        value="{{ old(
                            'fecha_fin',
                            $contrato->fecha_fin
                        ) }}"
                    >

                </div>


                <div class="col-md-4">

                    <label
                        for="estado"
                        class="form-label fw-semibold"
                        style="color:#CBD5E1;"
                    >

                        Estado

                    </label>


                    <select
                        name="estado"
                        id="estado"
                        class="form-select gtri-input"
                    >

                        <option
                            value="borrador"
                            @selected(
                                old(
                                    'estado',
                                    $contrato->estado
                                ) === 'borrador'
                            )
                        >

                            Borrador

                        </option>

                        <option
                            value="activo"
                            @selected(
                                old(
                                    'estado',
                                    $contrato->estado
                                ) === 'activo'
                            )
                        >

                            Activo

                        </option>

                        <option
                            value="vencido"
                            @selected(
                                old(
                                    'estado',
                                    $contrato->estado
                                ) === 'vencido'
                            )
                        >

                            Vencido

                        </option>

                        <option
                            value="cancelado"
                            @selected(
                                old(
                                    'estado',
                                    $contrato->estado
                                ) === 'cancelado'
                            )
                        >

                            Cancelado

                        </option>

                    </select>

                </div>

            </div>

        </div>


        <div class="gtri-section">

            <div class="gtri-section-title">

                <span>03</span>

                Observaciones

            </div>


            <textarea
                name="observaciones"
                class="form-control gtri-textarea"
                rows="4"
                placeholder="Escribe condiciones, notas o información adicional relacionada con el contrato..."
            >{{ old(
                'observaciones',
                $contrato->observaciones
            ) }}</textarea>

        </div>


        <div class="gtri-section mb-0">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route(
                        'operaciones.contratos.show',
                        $contrato
                    ) }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-x-circle me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-floppy me-1"></i>

                    Actualizar contrato

                </button>

            </div>

        </div>

    </form>

</div>

@endsection