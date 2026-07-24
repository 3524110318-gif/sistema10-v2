@extends('operaciones.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-clock-history me-2"></i>

                Gestión de dobletes

            </h2>

            <p class="gtri-page-subtitle">

                Consulta y administra las coberturas temporales realizadas
                por ausencia de personal operativo.

            </p>

        </div>

        <a
            href="{{ route(
                'operaciones.dobletes.create'
            ) }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo doblete

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

                Lista de dobletes

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $dobletes->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width:24%">

                        <col style="width:22%">

                        <col style="width:20%">

                        <col style="width:14%">

                        <col style="width:10%">

                        <col style="width:10%">

                    </colgroup>

                    <thead>

                        <tr>

                            <th>Guardia que cubre</th>

                            <th>Plaza</th>

                            <th>Guardia ausente</th>

                            <th>Fecha</th>

                            <th>Estado</th>

                            <th class="text-center">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse(
                            $dobletes
                            as $doblete
                        )

                            <tr>

                                {{-- GUARDIA --}}
                                <td>

                                    <div>

                                        <span
                                            class="
                                                text-light
                                                fw-semibold
                                                d-block
                                            "
                                        >

                                            {{ $doblete->empleado->nombre }}

                                            {{
                                                $doblete
                                                    ->empleado
                                                    ->apellido_paterno
                                            }}

                                        </span>

                                        <small class="text-secondary">

                                            {{
                                                $doblete
                                                    ->empleado
                                                    ->numero_control
                                            }}

                                        </small>

                                    </div>

                                </td>


                                {{-- PLAZA --}}
                                <td>

                                    <span class="text-warning fw-semibold">

                                        {{ $doblete->plaza->nombre_plaza }}

                                    </span>

                                </td>


                                {{-- AUSENTE --}}
                                <td>

                                    <span class="text-light">

                                        {{ $doblete->guardia_ausente }}

                                    </span>

                                </td>


                                {{-- FECHA --}}
                                <td>

                                    <span class="text-light">

                                        <i
                                            class="
                                                bi
                                                bi-calendar3
                                                text-warning
                                                me-1
                                            "
                                        ></i>

                                        {{ $doblete->fecha }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    @if($doblete->estado === 'activo')

                                        <span class="badge bg-success">

                                            <i class="bi bi-clock me-1"></i>

                                            Activo

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Finalizado

                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    @if($doblete->estado === 'activo')

                                        <form
                                            action="{{ route(
                                                'operaciones.dobletes.finalizar',
                                                $doblete
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                '¿Seguro que deseas finalizar este doblete?'
                                            )"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-warning btn-sm"
                                                title="Finalizar doblete"
                                            >

                                                <i class="bi bi-check2-circle"></i>

                                            </button>

                                        </form>

                                    @else

                                        <span class="text-secondary">

                                            <i class="bi bi-dash-circle"></i>

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="
                                            bi
                                            bi-clock-history
                                            fs-1
                                            text-secondary
                                            d-block
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        Sin dobletes registrados

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Actualmente no existen coberturas temporales registradas.

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
            method_exists($dobletes, 'hasPages')
            &&
            $dobletes->hasPages()
        )

            <div class="d-flex justify-content-center mt-4">

                {{ $dobletes->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection