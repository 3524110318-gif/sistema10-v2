@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div
            class="
                d-flex
                flex-column
                flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
            "
        >

            <div>

                <h2 class="gtri-page-title">

                    <i class="bi bi-person-x me-2"></i>

                    Empleados inactivos

                </h2>


                <p class="gtri-page-subtitle mb-0">

                    Consulta y reactiva empleados dados de baja.

                </p>

            </div>


            <div>

                <a
                    href="{{ route('rh.empleados') }}"
                    class="btn gtri-btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Volver

                </a>

            </div>

        </div>

    </div>


    {{-- LISTADO --}}
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

                Lista de empleados inactivos

            </div>


            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $empleados->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <colgroup>

                        <col style="width: 16%;">

                        <col style="width: 34%;">

                        <col style="width: 22%;">

                        <col style="width: 12%;">

                        <col style="width: 16%;">

                    </colgroup>


                    <thead>

                        <tr>

                            <th>No. de control</th>

                            <th>Empleado</th>

                            <th>Puesto</th>

                            <th>Estado</th>

                            <th class="text-center">Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($empleados as $empleado)

                            <tr>

                                {{-- NÚMERO DE CONTROL --}}
                                <td>

                                    <span class="text-warning fw-bold">

                                        {{ $empleado->numero_control }}

                                    </span>

                                </td>


                                {{-- EMPLEADO --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        @if ($empleado->foto)

                                            <img
                                                src="{{ asset(
                                                    'fotos_empleados/' .
                                                    $empleado->foto
                                                ) }}"
                                                alt="Foto del empleado"
                                                class="rounded-circle"
                                                style="
                                                    width: 46px;
                                                    height: 46px;
                                                    object-fit: cover;
                                                    border: 2px solid #D4AF37;
                                                "
                                            >

                                        @else

                                            <div
                                                class="
                                                    rounded-circle
                                                    d-flex
                                                    align-items-center
                                                    justify-content-center
                                                "
                                                style="
                                                    width: 46px;
                                                    height: 46px;
                                                    min-width: 46px;
                                                    background: #111827;
                                                    border: 2px solid #D4AF37;
                                                "
                                            >

                                                <i class="bi bi-person text-secondary"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <span class="text-light fw-semibold d-block">

                                                {{ $empleado->nombre }}

                                                {{ $empleado->apellido_paterno }}

                                                {{ $empleado->apellido_materno }}

                                            </span>

                                            <small class="text-secondary">

                                                {{ $empleado->correo }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- PUESTO --}}
                                <td>

                                    <span class="text-light">

                                        {{ $empleado->puesto }}

                                    </span>

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    <span class="gtri-badge-danger">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Inactivo

                                    </span>

                                </td>


                                {{-- ACCIONES --}}
                                <td class="text-center">

                                    @php

                                        $ultimaBaja = $empleado->bajas->first();

                                    @endphp


                                    @if ($ultimaBaja)

                                        <a
                                            href="{{ route(
                                                'rh.bajas.show',
                                                $ultimaBaja->id
                                            ) }}"
                                            class="btn gtri-btn-secondary btn-sm me-1"
                                        >

                                            <i class="bi bi-eye me-1"></i>

                                            Ver baja

                                        </a>

                                    @endif

                                    <form
                                        action="{{ route(
                                            'rh.empleados.reactivar',
                                            $empleado->id
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('PUT')


                                        <button
                                            type="submit"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm(
                                                '¿Seguro que deseas reactivar este empleado?'
                                            )"
                                        >

                                            <i class="bi bi-person-check me-1"></i>

                                            Reactivar

                                        </button>

                                    </form>

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
                                            bi-person-check
                                            d-block
                                            fs-1
                                            text-secondary
                                            mb-3
                                        "
                                    ></i>

                                    <h5 class="text-light">

                                        No hay empleados inactivos

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Actualmente todos los empleados se encuentran activos.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if (method_exists($empleados, 'hasPages') && $empleados->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $empleados->links() }}

            </div>

        @endif

    </div>

</div>

@endsection