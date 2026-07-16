@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        ASIGNACIÓN DE ACTIVOS

    </h1>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.asignaciones-activos.create') }}"
            class="btn btn-primary"
        >

            Nueva asignación

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar asignación">

        <form method="GET">

            <div class="row align-items-end">

                <div class="col-md-4">

                    <x-rh.input-rh
                        label="Código del activo"
                        name="buscar"
                        type="text"
                        :value="request('buscar')"
                    />

                </div>

                <div class="col-auto">

                    <button class="btn btn-primary">

                        Buscar

                    </button>

                </div>

            </div>

        </form>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Listado de asignaciones">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Activo</th>

                        <th>Empleado</th>

                        <th>Servicio</th>

                        <th>Fecha entrega</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($asignaciones as $asignacion)

                        <tr>

                            <td>

                                {{ $asignacion->activo->codigo_activo }}

                            </td>

                            <td>

                                {{ $asignacion->empleado->nombre }}

                                {{ $asignacion->empleado->apellido_paterno }}

                            </td>

                            <td>

                                {{ $asignacion->servicio->nombre ?? 'Sin servicio' }}

                            </td>

                            <td>

                                {{ $asignacion->fecha_entrega->format('d/m/Y') }}

                            </td>

                            <td>

                                @if($asignacion->estado == 'activa')

                                    <span class="badge bg-success">

                                        Activa

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Devuelta

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('administracion.asignaciones-activos.show', $asignacion) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        Ver

                                    </a>

                                    <a
                                        href="{{ route('administracion.asignaciones-activos.edit', $asignacion) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    @if($asignacion->estado == 'activa')

                                        <form
                                            action="{{ route('administracion.asignaciones-activos.destroy', $asignacion) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Registrar devolución del activo?')"
                                            >

                                                Devolver

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center"
                            >

                                No hay asignaciones registradas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $asignaciones->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
