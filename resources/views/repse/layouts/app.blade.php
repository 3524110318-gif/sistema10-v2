<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        REPSE

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

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

            <h3 class="fw-bold mb-4">

                REPSE

            </h3>

            <hr class="border-secondary">

            <ul class="nav flex-column gap-2">

                <x-rh.sidebar-link
                    href="{{ route('repse.dashboard') }}"
                    active="repse.dashboard"
                >

                    <i class="bi bi-house-door me-2"></i>

                    Inicio

                </x-rh.sidebar-link>

                <x-rh.sidebar-link
                    href="{{ route('expedientes.index') }}"
                    active="expedientes.*"
                >
                    Expedientes REPSE
                </x-rh.sidebar-link>

                <x-rh.sidebar-link
                    href="{{ route('repse.generador.index') }}"
                    active="repse.generador.*"
                >

                    <i class="bi bi-file-earmark-zip me-2"></i>

                    Generador Mensual

                </x-rh.sidebar-link>

            </ul>

        </div>

        <!-- CONTENIDO -->

        <div class="col-10 p-0">

            <nav
                class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3"
            >

                <h4 class="mb-0 fw-semibold">

                    Sistema REPSE

                </h4>

                <div class="ms-auto">

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

            <div class="p-4">

                @yield('contenido')

            </div>

        </div>

    </div>

</div>

@stack('scripts')

</body>

</html>