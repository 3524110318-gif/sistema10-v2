@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-exclamation-triangle me-2"></i>

                Incidencias operativas

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y gestiona las incidencias registradas
                durante la operación.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.incidencias.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva incidencia

        </a>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section mb-0">

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-2
                mb-4
            "
        >

            <div class="gtri-section-title mb-0">

                <span>01</span>

                Lista de incidencias

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $incidencias->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Guardia</th>

                            <th>Servicio</th>

                            <th>Plaza</th>

                            <th>Fecha</th>

                            <th>Tipo</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $incidencias
                            as $incidencia
                        )

                            <tr>

                                {{-- GUARDIA --}}
                                <td>

                                    @if(
                                        $incidencia
                                            ->supervision
                                            ?->asignacion
                                            ?->empleado
                                    )

                                        <div>

                                            <span class="text-light fw-semibold d-block">

                                                {{
                                                    $incidencia
                                                        ->supervision
                                                        ->asignacion
                                                        ->empleado
                                                        ->nombre
                                                }}

                                                {{
                                                    $incidencia
                                                        ->supervision
                                                        ->asignacion
                                                        ->empleado
                                                        ->apellido_paterno
                                                }}

                                            </span>

                                            <small class="text-secondary">

                                                {{
                                                    $incidencia
                                                        ->supervision
                                                        ->asignacion
                                                        ->empleado
                                                        ->numero_control
                                                }}

                                            </small>

                                        </div>

                                    @else

                                        <span class="text-secondary">

                                            No relacionado

                                        </span>

                                    @endif

                                </td>


                                {{-- SERVICIO --}}
                                <td>

                                    <span class="text-light">

                                        {{ $incidencia->servicio->nombre }}

                                    </span>

                                </td>


                                {{-- PLAZA --}}
                                <td>

                                    @if(
                                        $incidencia
                                            ->supervision
                                            ?->asignacion
                                            ?->plaza
                                    )

                                        <span class="text-warning fw-semibold">

                                            {{
                                                $incidencia
                                                    ->supervision
                                                    ->asignacion
                                                    ->plaza
                                                    ->nombre_plaza
                                            }}

                                        </span>

                                    @else

                                        <span class="text-secondary">

                                            Sin plaza

                                        </span>

                                    @endif

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    @if($incidencia->supervision)

                                        {{
                                            $incidencia
                                                ->supervision
                                                ->fecha_supervision
                                        }}

                                    @else

                                        <span class="text-secondary">

                                            Sin supervisión

                                        </span>

                                    @endif

                                </td>


                                {{-- TIPO --}}
                                <td>

                                    <span class="badge bg-secondary">

                                        {{ ucfirst($incidencia->tipo) }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($incidencia->estado === 'abierta')

                                        <span class="badge bg-danger">

                                            <i class="bi bi-exclamation-circle me-1"></i>

                                            Abierta

                                        </span>

                                    @else

                                        <span class="badge bg-success">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Cerrada

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    <div
                                        class="
                                            d-flex
                                            justify-content-center
                                            align-items-center
                                            gap-2
                                            flex-nowrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'operaciones.incidencias.show',
                                                $incidencia
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver incidencia"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        @if(
                                            $incidencia->estado
                                            !=
                                            'cerrada'
                                        )

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'operaciones.incidencias.cerrar',
                                                    $incidencia
                                                ) }}"
                                                class="d-inline"
                                                onsubmit="return confirm(
                                                    '¿Seguro que deseas cerrar esta incidencia?'
                                                )"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    title="Cerrar incidencia"
                                                >

                                                    <i class="bi bi-check-lg"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-shield-check
                                            fs-1
                                            text-secondary
                                            d-block
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin incidencias operativas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Actualmente no existen incidencias registradas.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINACIÓN --}}
        @if(
            method_exists($incidencias, 'hasPages')
            &&
            $incidencias->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $incidencias->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection