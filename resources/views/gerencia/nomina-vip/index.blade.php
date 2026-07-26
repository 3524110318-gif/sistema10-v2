@extends('gerencia.layouts.app')

@section('contenido')

<div class="gtri-page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="gtri-page-title">

                Nómina VIP

            </h1>

            <p class="gtri-page-subtitle">

                Consulta exclusiva de salarios para Dirección General.

            </p>

        </div>

        <div class="text-end">

            <small class="text-muted">

                Total mensual

            </small>

            <h3 class="text-warning mb-0">

                ${{ number_format($totalMensual,2) }}

            </h3>

        </div>

    </div>

</div>


<div class="gtri-card mb-4">

    <form method="GET">

        <div class="row">

            <div class="col-md-10">

                <input
                    type="text"
                    name="buscar"
                    class="form-control gtri-input"
                    placeholder="Buscar por número de control, nombre, puesto o rango..."
                    value="{{ request('buscar') }}"
                >

            </div>

            <div class="col-md-2 d-grid">

                <button
                    class="btn gtri-btn-primary"
                >

                    <i class="bi bi-search"></i>

                    Buscar

                </button>

            </div>

        </div>

    </form>

</div>


<div class="gtri-table-wrapper">

    <table class="table gtri-table align-middle mb-0">

        <thead>

            <tr>

                <th>No. Control</th>

                <th>Empleado</th>

                <th>Puesto</th>

                <th>Rango</th>

                <th>Salario Base</th>

            </tr>

        </thead>

        <tbody>

            @forelse($empleados as $empleado)

                <tr>

                    <td>

                        {{ $empleado->numero_control }}

                    </td>

                    <td>

                        {{ $empleado->nombre }}

                        {{ $empleado->apellido_paterno }}

                        {{ $empleado->apellido_materno }}

                    </td>

                    <td>

                        {{ $empleado->puesto }}

                    </td>

                    <td>

                        {{ $empleado->rango }}

                    </td>

                    <td class="fw-bold text-warning">

                        ${{ number_format($empleado->salario_base,2) }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="5"
                        class="text-center text-muted py-5"
                    >

                        No existen empleados de nivel directivo registrados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


<div class="mt-4">

    {{ $empleados->links() }}

</div>

@endsection