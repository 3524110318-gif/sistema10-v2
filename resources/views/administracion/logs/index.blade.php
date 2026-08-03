@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-1">

                Logs del sistema

            </h1>

            <p class="text-secondary mb-0">

                Historial de acciones realizadas dentro del sistema.

            </p>

        </div>

    </div>


    {{-- TABLA --}}
    <x-rh.card-rh titulo="Actividad reciente">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Usuario</th>

                        <th>Rol</th>

                        <th>Acción</th>

                        <th>IP</th>

                        <th>Fecha</th>

                        <th class="text-center">

                            Detalles

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($logs as $log)

                        <tr>

                            {{-- USUARIO --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $log->usuario ?? 'Sistema' }}

                                </div>

                                <small class="text-secondary">

                                    ID:

                                    {{ $log->user_id ?? 'Sin registro' }}

                                </small>

                            </td>


                            {{-- ROL --}}
                            <td>

                                <span class="badge bg-secondary">

                                    {{ strtoupper($log->rol ?? 'Sin rol') }}

                                </span>

                            </td>


                            {{-- ACCIÓN --}}
                            <td>

                                {{ $log->accion }}

                            </td>


                            {{-- IP --}}
                            <td>

                                {{ $log->ip ?? 'No disponible' }}

                            </td>


                            {{-- FECHA --}}
                            <td>

                                {{ $log->created_at?->format('d/m/Y H:i') }}

                            </td>


                            {{-- DETALLES --}}
                            <td class="text-center">

                                @if ($log->valor_anterior || $log->valor_nuevo)

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLog{{ $log->id }}"
                                    >

                                        Ver cambios

                                    </button>

                                @else

                                    <span class="text-secondary">

                                        Sin cambios

                                    </span>

                                @endif

                            </td>

                        </tr>


                        {{-- MODAL DE DETALLES --}}
                        @if ($log->valor_anterior || $log->valor_nuevo)

                            <div
                                class="modal fade"
                                id="modalLog{{ $log->id }}"
                                tabindex="-1"
                                aria-labelledby="modalLogLabel{{ $log->id }}"
                                aria-hidden="true"
                            >

                                <div class="modal-dialog modal-xl modal-dialog-scrollable">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5
                                                class="modal-title"
                                                id="modalLogLabel{{ $log->id }}"
                                            >

                                                Detalles de auditoría

                                            </h5>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Cerrar"
                                            ></button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-4">

                                                <strong>

                                                    Acción:

                                                </strong>

                                                <p class="mb-0">

                                                    {{ $log->accion }}

                                                </p>

                                            </div>


                                            <div class="row g-4">

                                                {{-- VALOR ANTERIOR --}}
                                                <div class="col-12 col-lg-6">

                                                    <h6>

                                                        Valor anterior

                                                    </h6>

                                                    <pre class="border rounded p-3 mb-0 bg-light">{{ $log->valor_anterior
                                                        ? json_encode(
                                                            $log->valor_anterior,
                                                            JSON_PRETTY_PRINT
                                                            | JSON_UNESCAPED_UNICODE
                                                        )
                                                        : 'Sin valor anterior'
                                                    }}</pre>

                                                </div>


                                                {{-- VALOR NUEVO --}}
                                                <div class="col-12 col-lg-6">

                                                    <h6>

                                                        Valor nuevo

                                                    </h6>

                                                    <pre class="border rounded p-3 mb-0 bg-light">{{ $log->valor_nuevo
                                                        ? json_encode(
                                                            $log->valor_nuevo,
                                                            JSON_PRETTY_PRINT
                                                            | JSON_UNESCAPED_UNICODE
                                                        )
                                                        : 'Sin valor nuevo'
                                                    }}</pre>

                                                </div>

                                            </div>


                                            <div class="mt-4">

                                                <strong>

                                                    Navegador / dispositivo:

                                                </strong>

                                                <p class="text-break mb-0">

                                                    {{ $log->user_agent ?? 'No disponible' }}

                                                </p>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >

                                                Cerrar

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-4"
                            >

                                No hay actividad registrada

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINACIÓN --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $logs->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection