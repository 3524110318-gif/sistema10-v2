@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <h1 class="mb-4">

        Expedientes incompletos

    </h1>

    @forelse($empleadosIncompletos as $item)

        <div class="card shadow-sm mb-3">

            <div class="card-body">

                <h5>

                    {{ $item['empleado']->numero_control }}

                    -

                    {{ $item['empleado']->nombre }}

                    {{ $item['empleado']->apellido_paterno }}

                </h5>

                <strong>

                    Faltan:

                </strong>

                <ul class="mt-2">

                    @foreach($item['faltantes'] as $faltante)

                        <li>

                            {{ $faltante }}

                        </li>

                    @endforeach

                </ul>

                <a
                    href="{{ route(
                        'rh.empleados.show',
                        $item['empleado']->id
                    ) }}"
                    class="btn btn-primary btn-sm"
                >

                    Ver expediente

                </a>

            </div>

        </div>

    @empty

        <div class="alert alert-success">

            Todos los expedientes están completos.

        </div>

    @endforelse

</div>

@endsection
