@extends('rh.layouts.app')

@section('contenido')

<div class="container mt-4">

    <!-- EXPEDIENTE -->

    <x-rh.card-rh titulo="Expediente empleado">

        <div class="row">

            <!-- FOTO -->

            <div class="col-md-3 text-center">

                @if ($empleado->foto)

                    <img

                        src="{{ asset(

                            'fotos_empleados/' .

                            $empleado->foto

                        ) }}"

                        alt="Foto empleado"

                        class="img-fluid rounded-circle shadow mb-3"

                        style="

                            width: 220px;

                            height: 220px;

                            object-fit: cover;

                        "

                    >

                @else

                    <div

                        class="bg-secondary rounded-circle mx-auto mb-3"

                        style="

                            width: 220px;

                            height: 220px;

                        "

                    ></div>

                @endif


                <h4>

                    {{ $empleado->nombre }}

                </h4>


                <p class="text-muted">

                    {{ $empleado->puesto }}

                </p>


                @if ($empleado->estado == 'activo')

                    <span class="badge bg-success">

                        Activo

                    </span>

                @else

                    <span class="badge bg-danger">

                        Inactivo

                    </span>

                @endif

            </div>


            <!-- INFORMACION -->

            <div class="col-md-9">


                <!-- GENERAL -->

                <x-rh.card-rh titulo="Información general">

                    <div class="row">

                        <x-rh.info-item
                            titulo="No. Control"
                        >

                            {{ $empleado->numero_control }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Nombre completo"
                        >

                            {{ $empleado->nombre }}

                            {{ $empleado->apellido_paterno }}

                            {{ $empleado->apellido_materno }}

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>


                <!-- DOCUMENTOS -->

                <x-rh.card-rh titulo="Documentos">


                    <div class="row">

                        <x-rh.info-item
                            titulo="CURP"
                            col="4"
                        >

                            {{ $empleado->curp }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="RFC"
                            col="4"
                        >

                            {{ $empleado->rfc }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="NSS"
                            col="4"
                        >

                            {{ $empleado->nss }}

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>


                <!-- CONTACTO -->

                <x-rh.card-rh titulo="Contacto">

                    <div class="row">

                        <x-rh.info-item
                            titulo="Teléfono"
                        >

                            {{ $empleado->telefono }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Correo"
                        >

                            {{ $empleado->correo }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Dirección"
                            col="12"
                        >

                            {{ $empleado->direccion }}

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>


                <!-- RH -->

                <x-rh.card-rh titulo="Información RH">

                    <div class="row">

                        <x-rh.info-item
                            titulo="Puesto"
                            col="3"
                        >

                            {{ $empleado->puesto }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Rango"
                            col="3"
                        >

                            {{ $empleado->rango }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Salario"
                            col="3"
                        >

                            ${{ number_format($empleado->salario_base, 2) }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Tipo sangre"
                            col="3"
                        >

                            {{ $empleado->tipo_sangre }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Antigüedad"
                        >

                            {{ $empleado->antiguedad() }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Vacaciones disponibles"
                        >

                            {{ $empleado->vacaciones() }} días

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Vacaciones tomadas"
                        >

                            {{ $empleado->vacacionesTomadas() }} días

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Vacaciones restantes"
                        >

                            {{ $empleado->vacacionesRestantes() }} días

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>


                <!-- FECHAS -->

                <x-rh.card-rh titulo="Fechas">

                    <div class="row">

                        <x-rh.info-item
                            titulo="Fecha nacimiento"
                        >

                            {{ $empleado->fecha_nacimiento }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Fecha ingreso"
                        >

                            {{ $empleado->fecha_ingreso }}

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>


                <!-- EMERGENCIA -->

                <x-rh.card-rh titulo="Contacto emergencia">

                    <div class="row">

                        <x-rh.info-item
                            titulo="Contacto"
                        >

                            {{ $empleado->contacto_emergencia }}

                        </x-rh.info-item>


                        <x-rh.info-item
                            titulo="Teléfono"
                        >

                            {{ $empleado->telefono_emergencia }}

                        </x-rh.info-item>

                    </div>

                </x-rh.card-rh>

            </div>

        </div>

    </x-rh.card-rh>


    <!-- DOCUMENTOS RH -->

    <x-rh.card-rh titulo="Documentos RH">

        <div class="mb-4">

            <div class="d-flex justify-content-between">

                <strong>
                    Expediente RH
                </strong>

                <span>
                    {{ $documentos->count() }}
                    /
                    {{ count($documentosRH) }}
                </span>

            </div>

            <div class="progress mt-2">

                <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: {{ $porcentajeDocumentos }}%;"
                >

                    {{ $porcentajeDocumentos }}%

                </div>

            </div>

        </div>

        <div class="row">

            @foreach ($documentosRH as $documentoRH)

                @php

                    $documentoSubido =

                        $documentos

                        ->where(

                            'nombre',

                            $documentoRH

                        )

                        ->first();

                @endphp


                <div class="col-md-6 mb-3">

                    <div

                        class="border rounded-3 p-3 h-100"

                    >

                        <h5>

                            {{ $documentoRH }}

                        </h5>

                        @if ($documentoSubido)

                            <span class="badge bg-success mb-3">

                                Entregado

                            </span>

                            <br>

                            <form
                                method="POST"
                                action="{{ route(
                                    'rh.documentos.pendiente',
                                    $empleado->id
                                ) }}"
                                class="mt-2"
                            >
                                @csrf
                                @method('PATCH')

                                <input
                                    type="hidden"
                                    name="nombre"
                                    value="{{ $documentoRH }}"
                                >

                                <button
                                    class="btn btn-outline-danger btn-sm"
                                >
                                    Marcar pendiente
                                </button>

                            </form>

                        @else

                            <span class="badge bg-warning text-dark">

                                Pendiente

                            </span>

                            <form
                                method="POST"
                                action="{{ route('rh.documentos.store', $empleado->id) }}"
                                class="mt-2"
                            >
                                @csrf

                                <input
                                    type="hidden"
                                    name="nombre"
                                    value="{{ $documentoRH }}"
                                >

                                <button
                                    class="btn btn-success btn-sm"
                                >
                                    Marcar como entregado
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Historial de vacaciones">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Inicio</th>

                        <th>Fin</th>

                        <th>Días</th>

                        <th>Estado</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($vacaciones as $vacacion)

                        <tr>

                            <td>

                                {{ $vacacion->fecha_inicio }}

                            </td>

                            <td>

                                {{ $vacacion->fecha_fin }}

                            </td>

                            <td>

                                {{ $vacacion->dias }}

                            </td>

                            <td>

                                {{ ucfirst($vacacion->estado) }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                Sin vacaciones registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Historial de incidencias">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Tipo</th>

                        <th>Fecha</th>

                        <th>Descripción</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($incidencias as $incidencia)

                        <tr>

                            <td>

                                {{ ucfirst($incidencia->tipo) }}

                            </td>

                            <td>

                                {{ $incidencia->fecha }}

                            </td>

                            <td>

                                {{ $incidencia->descripcion }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3">

                                Sin incidencias registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Uniformes entregados">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Artículo</th>

                        <th>Tipo</th>

                        <th>Fecha</th>

                        <th>Observaciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($uniformes as $uniforme)

                        <tr>

                            <td>

                                {{ $uniforme->articulo }}

                            </td>

                            <td>

                                {{ ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $uniforme->tipo
                                    )
                                ) }}

                            </td>

                            <td>

                                {{ $uniforme->fecha_entrega }}

                            </td>

                            <td>

                                {{ $uniforme->observaciones }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                Sin uniformes registrados

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Semáforo de vigencias">

        <table class="table">

            <thead>

                <tr>

                    <th>Documento</th>

                    <th>Vence</th>

                    <th>Estado</th>

                </tr>

            </thead>

            <tbody>

                @forelse($vigencias as $vigencia)

                    @php

                        $dias = now()->diffInDays(
                            $vigencia->fecha_vencimiento,
                            false
                        );

                    @endphp

                    <tr>

                        <td>

                            {{ $vigencia->documento }}

                        </td>

                        <td>

                            {{ $vigencia->fecha_vencimiento }}

                        </td>

                        <td>

                            @if($dias < 0)

                                <span
                                    class="badge bg-danger"
                                >
                                    Vencido
                                </span>

                            @elseif($dias <= 30)

                                <span
                                    class="badge bg-warning text-dark"
                                >
                                    Próximo a vencer
                                </span>

                            @else

                                <span
                                    class="badge bg-success"
                                >
                                    Vigente
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3">

                            Sin vigencias registradas

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </x-rh.card-rh>

    <x-rh.card-rh titulo="Capacitaciones">

        <table class="table">

            <thead>

                <tr>

                    <th>Curso</th>

                    <th>Calificación</th>

                    <th>Vigencia</th>

                    <th>Estado</th>

                </tr>

            </thead>

            <tbody>

                @forelse($capacitaciones as $capacitacion)

                    @php

                        $dias = $capacitacion->vigencia_hasta
                            ? now()->diffInDays(
                                $capacitacion->vigencia_hasta,
                                false
                            )
                            : null;

                    @endphp

                    <tr>

                        <td>
                            {{ $capacitacion->curso }}
                        </td>

                        <td>
                            {{ $capacitacion->calificacion }}
                        </td>

                        <td>
                            {{ $capacitacion->vigencia_hasta }}
                        </td>

                        <td>

                            @if(!$capacitacion->vigencia_hasta)

                                <span class="badge bg-secondary">
                                    Sin vigencia
                                </span>

                            @elseif($dias < 0)

                                <span class="badge bg-danger">
                                    Vencida
                                </span>

                            @elseif($dias <= 30)

                                <span class="badge bg-warning text-dark">
                                    Próxima a vencer
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Vigente
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            Sin capacitaciones

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </x-rh.card-rh>

    <div class="d-flex gap-2 mb-4">

        <a
            href="{{ route(
                'rh.empleados.ficha',
                $empleado->id
            ) }}"
            class="btn btn-danger"
            target="_blank"
        >
            <i class="bi bi-file-earmark-pdf"></i>

            Ficha Técnica
        </a>

        <a
            href="{{ route(
                'rh.empleados.credencial',
                $empleado->id
            ) }}"
            class="btn btn-primary"
            target="_blank"
        >
            <i class="bi bi-person-badge"></i>

            Credencial
        </a>

        <a

            href="{{ route(
                'rh.uniformes.create',
                $empleado->id
            ) }}"

            class="btn btn-success"

        >

            <i class="bi bi-box-seam"></i>

            Uniformes

        </a>
        <a

            href="{{ route(
                'rh.vigencias.create',
                $empleado->id
            ) }}"

            class="btn btn-warning"

        >

            <i class="bi bi-calendar-check"></i>

            Vigencias

        </a>
        <a

            href="{{ route(
                'rh.capacitaciones.create',
                $empleado->id
            ) }}"

            class="btn btn-info"

        >

            <i class="bi bi-mortarboard"></i>

            Capacitación

        </a>

    </div>

</div>

@endsection
