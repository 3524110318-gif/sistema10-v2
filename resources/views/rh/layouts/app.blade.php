<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >


    <title>

        GTRI RH

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

                    GTRI RH

                </h3>

                <hr class="border-secondary">


                <!-- MENU -->

                <ul class="nav flex-column gap-2">


                    <!-- INICIO -->

                    <x-rh.sidebar-link
                        href="{{ route('rh.dashboard') }}"
                        active="rh.dashboard"
                    >

                        <i class="bi bi-house-door me-2"></i>

                        Inicio

                    </x-rh.sidebar-link>


                    <!-- EMPLEADOS -->

                    <x-rh.sidebar-link
                        href="{{ route('rh.empleados') }}"
                        active="rh.empleados*"
                    >

                        <i class="bi bi-people me-2"></i>

                        Empleados

                    </x-rh.sidebar-link>

                    <!-- VACACIONES -->

                    <x-rh.sidebar-link
                        href="{{ route('rh.vacaciones.index') }}"
                        active="rh.vacaciones*"
                    >

                        <i class="bi bi-calendar2-week me-2"></i>

                        Vacaciones

                    </x-rh.sidebar-link>

                    <x-rh.sidebar-link
                        href="{{ route('rh.prospectos.index') }}"
                        active="rh.prospectos*"
                    >

                        <i class="bi bi-person-badge me-2"></i>

                        Reclutamiento

                    </x-rh.sidebar-link>


                    <!-- CALENDARIO -->

                    <x-rh.sidebar-link
                        href="{{ route('rh.calendario.index') }}"
                        active="rh.calendario*"
                    >

                        <i class="bi bi-calendar-event me-2"></i>

                        Calendario laboral

                    </x-rh.sidebar-link>


                    <!-- INCIDENCIAS -->

                    <x-rh.sidebar-link
                        href="{{ route('rh.incidencias.index') }}"
                        active="rh.incidencias*"
                    >

                        <i class="bi bi-exclamation-triangle me-2"></i>

                        Incidencias

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

                        Sistema RH

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

</body>

</html>
