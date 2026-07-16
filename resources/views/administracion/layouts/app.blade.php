<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        GTRI Administración

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

            <h3 class="fw-bold mb-4">

                Administración

            </h3>

            <hr class="border-secondary">

            <ul class="nav flex-column gap-2">

                <!-- INICIO -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.dashboard') }}"
                    active="administracion.dashboard"
                >

                    <i class="bi bi-house-door me-2"></i>

                    Inicio

                </x-rh.sidebar-link>


                <!-- INVENTARIO -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.categorias.index') }}"
                    active="administracion.categorias*"
                >

                    <i class="bi bi-tags me-2"></i>

                    Categorías

                </x-rh.sidebar-link>


                <x-rh.sidebar-link
                    href="{{ route('administracion.productos.index') }}"
                    active="administracion.productos*"
                >

                    <i class="bi bi-box-seam me-2"></i>

                    Productos

                </x-rh.sidebar-link>


                <x-rh.sidebar-link
                    href="{{ route('administracion.proveedores.index') }}"
                    active="administracion.proveedores*"
                >

                    <i class="bi bi-truck me-2"></i>

                    Proveedores

                </x-rh.sidebar-link>


                <!-- COMPRAS -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.compras.index') }}"
                    active="administracion.compras*"
                >

                    <i class="bi bi-cart-check me-2"></i>

                    Compras

                </x-rh.sidebar-link>


                <!-- ACTIVOS -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.activos.index') }}"
                    active="administracion.activos*"
                >

                    <i class="bi bi-pc-display me-2"></i>

                    Activos

                </x-rh.sidebar-link>

                <x-rh.sidebar-link
                    href="{{ route('administracion.asignaciones-activos.index') }}"
                    active="administracion.asignaciones-activos*"
                >

                    <i class="bi bi-person-check me-2"></i>

                    Asignación de activos

                </x-rh.sidebar-link>


                <!-- FACTURACIÓN -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.facturas.index') }}"
                    active="administracion.facturas*"
                >

                    <i class="bi bi-receipt me-2"></i>

                    Facturación

                </x-rh.sidebar-link>


                <!-- COBRANZA -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.cobranzas.index') }}"
                    active="administracion.cobranzas*"
                >

                    <i class="bi bi-cash-stack me-2"></i>

                    Cobranza

                </x-rh.sidebar-link>


                <!-- PRENÓMINA -->

                <x-rh.sidebar-link
                    href="{{ route('administracion.prenominas.index') }}"
                    active="administracion.prenominas*"
                >

                    <i class="bi bi-calculator me-2"></i>

                    Prenómina

                </x-rh.sidebar-link>

            </ul>

        </div>

        <!-- CONTENIDO -->

        <div class="col-10 p-0">

            <!-- NAVBAR -->

            <nav
                class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3"
            >

                <h4 class="mb-0 fw-semibold">

                    Sistema Administración

                </h4>

                <div
                    class="ms-auto d-flex align-items-center gap-3"
                >

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
