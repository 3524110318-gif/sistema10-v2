@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-people me-2"></i>

                Reclutamiento

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y gestiona el proceso de selección de candidatos.

            </p>

        </div>


        <a
            href="{{ route('rh.prospectos.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-person-plus me-1"></i>

            Nuevo prospecto

        </a>

    </div>


    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                flex-wrap
                justify-content-between
                align-items-center
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de prospectos

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $prospectos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:28%">

                        <col style="width:20%">

                        <col style="width:16%">

                        <col style="width:14%">

                        <col style="width:22%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Prospecto</th>

                            <th>Puesto solicitado</th>

                            <th>Entrevista</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($prospectos as $prospecto)

                            <tr>

                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{ $prospecto->nombre }}

                                            {{ $prospecto->apellido_paterno }}

                                            {{ $prospecto->apellido_materno }}

                                        </span>

                                        <small class="text-secondary">

                                            {{ $prospecto->correo ?: 'Sin correo' }}

                                        </small>

                                    </div>

                                </td>


                                <td>

                                    <span class="text-light">

                                        {{ $prospecto->puesto_solicitado ?: 'Sin especificar' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="text-secondary">

                                        {{ $prospecto->fecha_entrevista ?: 'Sin fecha' }}

                                    </span>

                                </td>


                                <td>

                                    @if($prospecto->estado === 'pendiente')

                                        <span class="badge bg-warning text-dark">

                                            Pendiente

                                        </span>

                                    @elseif($prospecto->estado === 'entrevistado')

                                        <span class="badge bg-info text-dark">

                                            Entrevistado

                                        </span>

                                    @elseif($prospecto->estado === 'aprobado')

                                        <span class="badge bg-success">

                                            Aprobado

                                        </span>

                                    @elseif($prospecto->estado === 'rechazado')

                                        <span class="badge bg-danger">

                                            Rechazado

                                        </span>

                                    @elseif($prospecto->estado === 'contratado')

                                        <span class="badge bg-primary">

                                            Contratado

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst($prospecto->estado) }}

                                        </span>

                                    @endif

                                </td>


                                <td class="text-center">

                                    @if($prospecto->estado === 'pendiente')

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'rh.prospectos.entrevistar',
                                                $prospecto->id
                                            ) }}"
                                            class="d-inline"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn btn-warning btn-sm"
                                                onclick="return confirm(
                                                    '¿Deseas marcar este prospecto como entrevistado?'
                                                )"
                                            >

                                                <i class="bi bi-chat-square-text me-1"></i>

                                                Entrevistar

                                            </button>

                                        </form>


                                    @elseif($prospecto->estado === 'entrevistado')

                                        <div
                                            class="
                                                d-flex
                                                justify-content-center
                                                gap-2
                                                flex-nowrap
                                            "
                                        >

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'rh.prospectos.aprobar',
                                                    $prospecto->id
                                                ) }}"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm(
                                                        '¿Deseas aprobar este prospecto?'
                                                    )"
                                                >

                                                    <i class="bi bi-check-circle me-1"></i>

                                                    Aprobar

                                                </button>

                                            </form>


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'rh.prospectos.rechazar',
                                                    $prospecto->id
                                                ) }}"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm(
                                                        '¿Deseas rechazar este prospecto?'
                                                    )"
                                                >

                                                    <i class="bi bi-x-circle me-1"></i>

                                                    Rechazar

                                                </button>

                                            </form>

                                        </div>


                                    @elseif($prospecto->estado === 'aprobado')

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'rh.prospectos.contratar',
                                                $prospecto->id
                                            ) }}"
                                            class="d-inline"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn gtri-btn-primary btn-sm"
                                                onclick="return confirm(
                                                    '¿Deseas contratar este prospecto?'
                                                )"
                                            >

                                                <i class="bi bi-person-check me-1"></i>

                                                Contratar

                                            </button>

                                        </form>


                                    @else

                                        <span class="text-secondary">

                                            <i class="bi bi-dash-circle me-1"></i>

                                            Sin acciones

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-person-search
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin prospectos registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un prospecto para comenzar el proceso de reclutamiento.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if (
            method_exists($prospectos, 'hasPages') &&
            $prospectos->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $prospectos->links() }}

            </div>

        @endif

    </div>

</div>

@endsection