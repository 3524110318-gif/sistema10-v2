<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        @yield('titulo', 'GTRI APP')

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- BOOTSTRAP ICONS --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

</head>


<body class="gtri-page">


<div class="container-fluid p-0">

    <div class="row g-0">


        {{-- ========================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================= --}}

        <aside
            class="col-2 min-vh-100 gtri-sidebar"
        >

            <div class="p-4">


                {{-- MARCA --}}
                <div class="mb-4">

                    <div
                        class="d-flex align-items-center gap-3"
                    >

                        <div
                            class="gtri-logo-mark"
                        >

                            G

                        </div>


                        <div>

                            <div
                                class="gtri-sidebar-title fs-4"
                            >

                                GTRI

                            </div>

                            <small
                                class="text-secondary"
                            >

                                APP

                            </small>

                        </div>

                    </div>

                </div>


                <hr
                    class="border-secondary opacity-25"
                >


                {{-- NOMBRE DEL MÓDULO --}}
                <div class="mb-4">

                    <small
                        class="text-secondary text-uppercase"
                    >

                        Módulo

                    </small>

                    <div
                        class="fw-bold text-light mt-1"
                    >

                        @yield(
                            'nombre_modulo',
                            'Sistema'
                        )

                    </div>

                </div>


                {{-- MENÚ DEL MÓDULO --}}
                <ul
                    class="nav flex-column gap-2"
                >

                    @yield('menu')

                </ul>


            </div>

        </aside>


        {{-- ========================================= --}}
        {{-- ÁREA PRINCIPAL --}}
        {{-- ========================================= --}}

        <main
            class="col-10"
        >


            {{-- NAVBAR --}}
            <nav
                class="navbar gtri-navbar px-4 py-3"
            >

                <div>

                    <h5
                        class="mb-0 fw-bold text-light"
                    >

                        @yield(
                            'nombre_sistema',
                            'Sistema GTRI'
                        )

                    </h5>

                    <small
                        class="text-secondary"
                    >

                        Gestión empresarial

                    </small>

                </div>


                <div
                    class="ms-auto d-flex align-items-center gap-3"
                >


                    {{-- USUARIO --}}
                    @auth

                        <div
                            class="text-end d-none d-md-block"
                        >

                            <div
                                class="small text-light fw-semibold"
                            >

                                {{ Auth::user()->name }}

                            </div>

                            <small
                                class="text-secondary"
                            >

                                {{ ucfirst(
                                    Auth::user()->rol
                                ) }}

                            </small>

                        </div>

                    @endauth


                    {{-- SALIR --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn gtri-btn-secondary btn-sm"
                        >

                            <i
                                class="bi bi-box-arrow-right me-1"
                            ></i>

                            Salir

                        </button>

                    </form>


                </div>

            </nav>


            {{-- ========================================= --}}
            {{-- CONTENIDO --}}
            {{-- ========================================= --}}

            <div
                class="p-4"
            >

                @yield('contenido')

            </div>


        </main>


    </div>

</div>


@stack('scripts')


</body>

</html>