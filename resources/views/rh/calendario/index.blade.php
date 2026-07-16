@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-4">

        <h1>

            Calendario Laboral

        </h1>


        <a

            href="{{ route('rh.calendario.create') }}"

            class="btn btn-primary rounded-3"

        >

            Nuevo día

        </a>

    </div>


    <x-rh.card-rh titulo="Calendario">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Fecha</th>

                        <th>Tipo</th>

                        <th>Descripción</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($dias as $dia)

                        <tr>

                            <td>

                                {{ $dia->fecha }}

                            </td>


                            <td>

                               <x-rh.badge-tipo-dia
                                    :tipo="$dia->tipo"
                                />
                            </td>


                            <td>

                                {{ $dia->descripcion }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3">

                                No hay fechas registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

</div>

@endsection