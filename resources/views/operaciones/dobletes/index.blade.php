@extends('operaciones.layouts.app')

@section('contenido')

<div class="container">

    <div
        class="d-flex justify-content-between mb-4"
    >

        <h1>

            Gestión de Dobletes

        </h1>

        <a
            href="{{ route(
                'operaciones.dobletes.create'
            ) }}"
            class="btn btn-primary"
        >

            Nuevo Doblete

        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>Guardia</th>

                <th>Plaza</th>

                <th>Ausente</th>

                <th>Fecha</th>

                <th>Estado</th>

                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse(
                $dobletes as $doblete
            )

                <tr>

                    <td>

                        {{ $doblete
                            ->empleado
                            ->nombre }}

                        {{ $doblete
                            ->empleado
                            ->apellido_paterno }}

                    </td>

                    <td>

                        {{ $doblete
                            ->plaza
                            ->nombre_plaza }}

                    </td>

                    <td>

                        {{ $doblete
                            ->guardia_ausente }}

                    </td>

                    <td>

                        {{ $doblete
                            ->fecha }}

                    </td>

                    <td>

                        @if($doblete->estado == 'activo')

                            <span class="badge bg-success">

                                Activo

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Finalizado

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($doblete->estado == 'activo')

                            <form
                                action="{{ route('operaciones.dobletes.finalizar', $doblete) }}"
                                method="POST"
                            >

                                @csrf

                                @method('PATCH')

                                <button
                                    class="btn btn-warning btn-sm"
                                    onclick="return confirm('¿Finalizar este doblete?')"
                                >

                                    Finalizar

                                </button>

                            </form>

                        @else

                            <span class="text-muted">

                                Sin acciones

                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">

                        Sin dobletes registrados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
