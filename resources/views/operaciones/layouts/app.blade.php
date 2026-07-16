<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >


    <title>

        GTRI Operaciones

    </title>


    @vite([

        'resources/css/app.css',

        'resources/js/app.js'

    ])


    <!-- BOOTSTRAP ICONS -->

    <link

        rel="stylesheet"

        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"

    >

</head>

<body style="background: #F5F7FB;">
    <div class="container-fluid">

        <div class="row">


            <!-- SIDEBAR -->

            <div

                class="col-2 text-white min-vh-100 p-4 shadow"

                style="background: #0B1220;"

            >

                <!-- LOGO -->

                <h3 class="fw-bold mb-4">

                    Operaciones

                </h3>

                <hr class="border-secondary">


                <!-- MENU -->

                <ul class="nav flex-column gap-2">


                    <!-- INICIO -->

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.dashboard') }}"
                        active="operaciones.dashboard"
                    >

                        <i class="bi bi-house-door me-2"></i>

                        Inicio

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.clientes.index') }}"
                        active="operaciones.clientes*"
                    >

                        <i class="bi bi-people me-2"></i>

                        Clientes

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.contratos.index') }}"
                        active="operaciones.contrato*"
                    >

                        <i class="bi bi-calendar2-week me-2"></i>

                        Contratos

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.servicios.index') }}"
                        active="operaciones.servicios*"
                    >
                        <i class="bi bi-building me-2"></i>

                        Servicios

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.plazas.index') }}"
                        active="operaciones.plazas*"
                    >

                        <i class="bi bi-calendar-event me-2"></i>

                        Plazas Operativas

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('operaciones.asignaciones.index') }}"
                        active="operaciones.asignaciones*"
                    >

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        Asignaciones

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.supervisiones.index'
                        ) }}"
                        active="operaciones.supervisiones*"
                    >

                        <i class="bi bi-clipboard-check me-2"></i>

                        Supervisiones

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.evidencias.index'
                        ) }}"
                        active="operaciones.evidencias*"
                    >

                        <i class="bi bi-camera me-2"></i>

                        Evidencias

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.incidencias.index'
                        ) }}"
                        active="operaciones.incidencias*"
                    >

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        Incidencias

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.dobletes.index'
                        ) }}"
                        active="operaciones.dobletes*"
                    >

                        <i class="bi bi-clock-history me-2"></i>

                        Dobletes

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.vehiculos.index'
                        ) }}"
                        active="operaciones.vehiculos*"
                    >

                        <i class="bi bi-car-front me-2"></i>

                        Vehículos

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route(
                            'operaciones.mantenimientos.index'
                        ) }}"
                        active="operaciones.mantenimientos*"
                    >

                        <i class="bi bi-wrench-adjustable me-2"></i>

                        Mantenimientos

                    </x-rh.sidebar-link>

                </ul>

            </div>


            <!-- CONTENIDO -->

            <div class="col-10 p-0">


                <!-- NAVBAR -->

                <nav

                    class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3"

                >

                    <!-- TITULO -->

                    <h4 class="mb-0 fw-semibold">

                        Sistema Operaciones

                    </h4>


                    <!-- DERECHA -->

                    <div

                        class="ms-auto d-flex align-items-center gap-3"

                    >
                        <!-- LOGOUT -->

                        <form

                            method="POST"

                            action="{{ route('logout') }}"

                        >

                            @csrf


                            <button

                                class="btn btn-outline-danger btn-sm rounded-3"

                            >

                                <i class="bi bi-box-arrow-right me-1"></i>

                                Salir

                            </button>

                        </form>

                    </div>

                </nav>


                <!-- CONTENIDO -->

                <div class="p-4">

                    @yield('contenido')

                </div>

            </div>

        </div>

    </div>

    @stack('scripts')

</body>

</html>
