@extends('rh.layouts.app')

@section('contenido')

<div class="container-fluid">

    {{-- ENCABEZADO --}}
    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-folder-x me-2"></i>

                Expedientes incompletos

            </h2>

            <p class="gtri-page-subtitle">

                Empleados con documentación pendiente dentro de su expediente.

            </p>

        </div>

    </div>


    {{-- LISTADO --}}
    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Expedientes pendientes

        </div>


        @forelse($empleadosIncompletos as $item)

            <div class="gtri-card mb-3">

                <div class="d-flex justify-content-between align-items-start gap-3">

                    <div>

                        <div class="fw-bold text-light fs-5">

                            {{ $item['empleado']->numero_control }}

                            -

                            {{ $item['empleado']->nombre }}

                            {{ $item['empleado']->apellido_paterno }}

                        </div>

                        <div class="mt-3">

                            <span class="text-warning fw-semibold">

                                <i class="bi bi-exclamation-triangle me-1"></i>

                                Documentos faltantes

                            </span>

                            <ul class="mt-2 mb-0 text-secondary">

                                @foreach($item['faltantes'] as $faltante)

                                    <li>

                                        {{ $faltante }}

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>


                    <a
                        href="{{ route(
                            'rh.empleados.show',
                            $item['empleado']->id
                        ) }}"
                        class="btn gtri-btn-primary"
                    >

                        <i class="bi bi-folder2-open me-1"></i>

                        Ver expediente

                    </a>

                </div>

            </div>

        @empty

            <div class="gtri-card text-center py-5">

                <div class="fs-1 text-success mb-3">

                    <i class="bi bi-check-circle"></i>

                </div>

                <h5 class="text-light">

                    Todos los expedientes están completos

                </h5>

                <p class="text-secondary mb-0">

                    No existen documentos pendientes actualmente.

                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection