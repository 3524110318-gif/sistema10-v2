@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-clipboard-check me-2"></i>

                Supervisiones

            </h2>

            <p class="gtri-page-subtitle">

                Consulta las supervisiones realizadas al personal operativo.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.supervisiones.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nueva supervisión

        </a>

    </div>


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

                Lista de supervisiones

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $supervisiones->count() }}

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

                            <th>Turno</th>

                            <th>Fecha</th>

                            <th>Resultado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $supervisiones
                            as $supervision
                        )

                            <tr>

                                <td>

                                    <div>

                                        <span class="text-light fw-semibold d-block">

                                            {{
                                                $supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->nombre
                                            }}

                                            {{
                                                $supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->apellido_paterno
                                            }}

                                        </span>

                                        <small class="text-secondary">

                                            {{
                                                $supervision
                                                    ->asignacion
                                                    ->empleado
                                                    ->numero_control
                                            }}

                                        </small>

                                    </div>

                                </td>

                                <td>

                                    {{
                                        $supervision
                                            ->asignacion
                                            ->plaza
                                            ->servicio
                                            ->nombre
                                    }}

                                </td>

                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{
                                            $supervision
                                                ->asignacion
                                                ->plaza
                                                ->nombre_plaza
                                        }}

                                    </span>

                                </td>

                                <td>

                                    {{
                                        ucfirst(
                                            $supervision
                                                ->asignacion
                                                ->plaza
                                                ->turno
                                        )
                                    }}

                                </td>

                                <td>

                                    {{ $supervision->fecha_supervision }}

                                </td>

                                <td>

                                    @if($supervision->resultado === 'correcto')

                                        <span class="badge bg-success">

                                            Correcto

                                        </span>

                                    @elseif($supervision->resultado === 'incidencia')

                                        <span class="badge bg-warning text-dark">

                                            Incidencia

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Ausente

                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <div
                                        class="
                                            d-flex
                                            justify-content-center
                                            gap-2
                                            flex-wrap
                                        "
                                    >

                                        <a
                                            href="{{ route(
                                                'operaciones.supervisiones.show',
                                                $supervision
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                            title="Ver supervisión"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        @if(
                                            $supervision->resultado
                                            !=
                                            'correcto'
                                        )

                                            @if($supervision->incidencia)

                                                <a
                                                    href="{{ route(
                                                        'operaciones.incidencias.index'
                                                    ) }}"
                                                    class="btn btn-info btn-sm"
                                                >

                                                    <i class="bi bi-eye me-1"></i>

                                                    Incidencia

                                                </a>

                                            @else

                                                <a
                                                    href="{{ route(
                                                        'operaciones.incidencias.create.supervision',
                                                        $supervision
                                                    ) }}"
                                                    class="btn btn-danger btn-sm"
                                                >

                                                    <i class="bi bi-exclamation-triangle me-1"></i>

                                                    Generar

                                                </a>

                                            @endif

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
                                            bi-clipboard-x
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin supervisiones registradas

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra una supervisión para comenzar.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if(
            method_exists($supervisiones, 'hasPages')
            &&
            $supervisiones->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $supervisiones->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection