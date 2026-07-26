
@extends('comercial.layouts.app')

@section('contenido')

<div class="container-fluid">

    <x-rh.alert-success />


    <!-- ENCABEZADO -->

    <div class="gtri-page-header">

        <div>

            <h2 class="gtri-page-title">

                <i class="bi bi-person-lines-fill me-2"></i>

                Prospectos Comerciales

            </h2>

            <p class="gtri-page-subtitle">

                Administra las oportunidades comerciales y da seguimiento a cada prospecto.

            </p>

        </div>

        <a
            href="{{ route('comercial.prospectos.create') }}"
            class="btn gtri-btn-primary"
        >

            <i class="bi bi-plus-circle me-1"></i>

            Nuevo Prospecto

        </a>

    </div>


    <!-- BUSCADOR -->

    <div class="gtri-section">

        <div class="gtri-section-title">

            <span>01</span>

            Buscar prospectos

        </div>

        <form
            method="GET"
            class="row g-3 align-items-end"
        >

            <div class="col-lg-8 col-md-7">

                <label
                    for="buscar"
                    class="form-label"
                >

                    Buscar

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-dark border-secondary text-warning">

                        <i class="bi bi-search"></i>

                    </span>

                    <input
                        type="text"
                        id="buscar"
                        name="buscar"
                        class="form-control gtri-input"
                        placeholder="Buscar por razón social, contacto u otra información..."
                        value="{{ request('buscar') }}"
                    >

                </div>

            </div>

            <div class="col-lg-4 col-md-5">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn gtri-btn-primary flex-grow-1"
                    >

                        <i class="bi bi-search me-1"></i>

                        Buscar

                    </button>

                    @if(request('buscar'))

                        <a
                            href="{{ route('comercial.prospectos.index') }}"
                            class="btn gtri-btn-secondary"
                            title="Limpiar búsqueda"
                        >

                            <i class="bi bi-x-lg"></i>

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    <!-- LISTADO -->

    <div class="gtri-section mb-0">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">

            <div class="gtri-section-title mb-0">

                <span>02</span>

                Listado de prospectos

            </div>

            <div>

                <span class="text-secondary">

                    Registros:

                </span>

                <span class="text-warning fw-bold">

                    {{ $prospectos->count() }}

                </span>

            </div>

        </div>


        <div class="gtri-table-wrapper">

            <div class="table-responsive">

                <table class="table gtri-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>

                                Razón Social

                            </th>

                            <th>

                                Contacto

                            </th>

                            <th>

                                Teléfono

                            </th>

                            <th>

                                Correo

                            </th>

                            <th>

                                Tarifa

                            </th>

                            <th class="text-center">

                                Plazas

                            </th>

                            <th class="text-center">

                                Estatus

                            </th>

                            <th width="140">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($prospectos as $prospecto)

                            <tr>

                                <td>

                                    <div class="fw-semibold text-light">

                                        {{ $prospecto->razon_social }}

                                    </div>

                                </td>

                                <td>

                                    {{ $prospecto->contacto }}

                                </td>

                                <td>

                                    <i class="bi bi-telephone me-1 text-secondary"></i>

                                    {{ $prospecto->telefono }}

                                </td>

                                <td>

                                    @if($prospecto->correo)

                                        <i class="bi bi-envelope me-1 text-secondary"></i>

                                        {{ $prospecto->correo }}

                                    @else

                                        <span class="text-secondary">

                                            Sin correo

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <span class="fw-semibold">

                                        $ {{ number_format($prospecto->tarifa, 2) }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    <span class="badge bg-secondary">

                                        {{ $prospecto->numero_plazas }}

                                    </span>

                                </td>

                                <td class="text-center">

                                    @switch($prospecto->estatus)

                                        @case('nuevo')

                                            <span class="badge bg-primary">

                                                Nuevo

                                            </span>

                                        @break

                                        @case('seguimiento')

                                            <span class="badge bg-warning text-dark">

                                                Seguimiento

                                            </span>

                                        @break

                                        @case('cotizacion')

                                            <span class="badge bg-info text-dark">

                                                Cotización

                                            </span>

                                        @break

                                        @case('ganado')

                                            <span class="badge bg-success">

                                                Ganado

                                            </span>

                                        @break

                                        @case('perdido')

                                            <span class="badge bg-danger">

                                                Perdido

                                            </span>

                                        @break

                                    @endswitch

                                </td>

                                <td>

                                    <div class="d-flex gap-2 flex-nowrap">

                                        <a
                                            href="{{ route('comercial.prospectos.edit', $prospecto) }}"
                                            class="btn btn-warning btn-sm"
                                            title="Editar prospecto"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form
                                            action="{{ route('comercial.prospectos.destroy', $prospecto) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Eliminar prospecto"
                                                onclick="return confirm('¿Eliminar este prospecto?')"
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
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <i class="bi bi-person-x fs-1 text-secondary d-block mb-3"></i>

                                    <h5 class="text-light mb-2">

                                        No existen prospectos comerciales

                                    </h5>

                                    <p class="text-secondary mb-0">

                                        Registra un nuevo prospecto para comenzar su seguimiento comercial.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- PAGINACIÓN -->

        @if(method_exists($prospectos, 'hasPages') && $prospectos->hasPages())

            <div class="d-flex justify-content-center mt-4">

                {{ $prospectos->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
