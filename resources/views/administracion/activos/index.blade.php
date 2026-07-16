@extends('administracion.layouts.app')

@section('contenido')

<div class="container mt-4">

    <x-rh.alert-success />

    <h1 class="mb-4">

        ACTIVOS

    </h1>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route('administracion.activos.create') }}"
            class="btn btn-primary"
        >

            Nuevo activo

        </a>

    </div>

    <x-rh.card-rh titulo="Buscar activo">

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

    <x-rh.card-rh titulo="Listado de activos">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Código</th>

                        <th>Producto</th>

                        <th>Marca</th>

                        <th>Modelo</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($activos as $activo)

                        <tr>

                            <td>

                                {{ $activo->codigo_activo }}

                            </td>

                            <td>

                                {{ $activo->producto->nombre }}

                            </td>

                            <td>

                                {{ $activo->marca ?? '-' }}

                            </td>

                            <td>

                                {{ $activo->modelo ?? '-' }}

                            </td>

                            <td>

                                @switch($activo->estado)

                                    @case('disponible')

                                        <span class="badge bg-success">

                                            Disponible

                                        </span>

                                        @break

                                    @case('asignado')

                                        <span class="badge bg-primary">

                                            Asignado

                                        </span>

                                        @break

                                    @case('mantenimiento')

                                        <span class="badge bg-warning text-dark">

                                            Mantenimiento

                                        </span>

                                        @break

                                    @default

                                        <span class="badge bg-danger">

                                            Baja

                                        </span>

                                @endswitch

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('administracion.activos.show',$activo) }}"
                                        class="btn btn-info btn-sm"
                                    >

                                        Ver

                                    </a>

                                    <a
                                        href="{{ route('administracion.activos.edit',$activo) }}"
                                        class="btn btn-warning btn-sm"
                                    >

                                        Editar

                                    </a>

                                    <form
                                        action="{{ route('administracion.activos.destroy',$activo) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-secondary btn-sm"
                                            onclick="return confirm('¿Desea cambiar el estado del activo?')"
                                        >

                                            {{ $activo->estado == 'baja' ? 'Activar' : 'Dar de baja' }}

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center"
                            >

                                No hay activos registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-4">

            {{ $activos->links() }}

        </div>

    </x-rh.card-rh>

</div>

@endsection
