@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h1 class="gtri-page-title">

                Control Maestro de Accesos

            </h1>

            <p class="gtri-page-subtitle">

                Administración de códigos de acceso para los módulos del sistema.

            </p>

        </div>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success gtri-alert">

        {{ session('success') }}

    </div>

@endif


<div class="gtri-table-wrapper">

    <table class="table gtri-table align-middle mb-0">

        <thead>

            <tr>

                <th>Módulo</th>

                <th>Código</th>

                <th>Estado</th>

                <th>Generado</th>

                <th>Responsable</th>

                <th class="text-center">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse($codigos as $codigo)

                <tr>

                    <td class="fw-bold">

                        {{ ucfirst($codigo->modulo) }}

                    </td>

                    <td>

                        <span
                            class="codigo-oculto"
                            id="codigo-{{ $codigo->id }}"
                            data-codigo="{{ $codigo->codigo }}"
                        >

                            ••••••

                        </span>

                    </td>

                    <td>

                        @if($codigo->estado === 'activo')

                            <span class="badge gtri-badge-success">

                                Activo

                            </span>

                        @else

                            <span class="badge gtri-badge-danger">

                                Inactivo

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ optional($codigo->fecha_generacion)->format('d/m/Y H:i') }}

                    </td>

                    <td>

                        {{ $codigo->usuario->name ?? 'Sin responsable' }}

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <a
                                href="{{ route('gerencia.codigos.edit', $codigo) }}"
                                class="btn btn-sm btn-outline-warning"
                                title="Editar"
                            >

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form
                                action="{{ route('gerencia.codigos.destroy', $codigo) }}"
                                method="POST"
                                onsubmit="return confirm('¿Deseas eliminar este código?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Eliminar"
                                >

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center text-muted py-5"
                    >

                        No existen códigos de acceso registrados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


<div class="mt-4">

    {{ $codigos->links() }}

</div>

@endsection