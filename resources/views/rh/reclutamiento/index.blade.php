@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Reclutamiento

        </h1>

        <a
            href="{{ route('rh.prospectos.create') }}"
            class="btn btn-primary"
        >

            Nuevo Prospecto

        </a>

    </div>

    <x-rh.card-rh titulo="Prospectos">

        <table class="table">

            <thead>

                <tr>

                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Entrevista</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($prospectos as $prospecto)

                    <tr>

                        <td>

                            {{ $prospecto->nombre }}
                            {{ $prospecto->apellido_paterno }}

                        </td>

                        <td>

                            {{ $prospecto->puesto_solicitado }}

                        </td>

                        <td>

                            {{ $prospecto->fecha_entrevista }}

                        </td>

                        <td>

                            {{ ucfirst($prospecto->estado) }}

                        </td>

                        <td>

                            @if($prospecto->estado == 'pendiente')

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'rh.prospectos.entrevistar',
                                        $prospecto->id
                                    ) }}"
                                >

                                    @csrf

                                    <button
                                        class="btn btn-warning btn-sm"
                                    >

                                        Entrevistar

                                    </button>

                                </form>

                            @elseif($prospecto->estado == 'entrevistado')

                                <div class="d-flex gap-2">

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'rh.prospectos.aprobar',
                                            $prospecto->id
                                        ) }}"
                                    >

                                        @csrf

                                        <button
                                            class="btn btn-success btn-sm"
                                        >

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
                                            class="btn btn-danger btn-sm"
                                        >

                                            Rechazar

                                        </button>

                                    </form>

                                </div>

                                @elseif($prospecto->estado == 'aprobado')

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'rh.prospectos.contratar',
                                            $prospecto->id
                                        ) }}"
                                    >

                                        @csrf

                                        <button
                                            class="btn btn-primary btn-sm"
                                        >

                                            Contratar

                                        </button>

                                    </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            Sin prospectos

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </x-rh.card-rh>

</div>

@endsection
