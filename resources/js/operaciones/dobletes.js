document.addEventListener(
    'DOMContentLoaded',
    function () {

        const plaza =
            document.querySelector(
                'select[name="plaza_operativa_id"]'
            );

        const cubre =
            document.getElementById(
                'guardia_cubre'
            );

        const guardia =
            document.getElementById(
                'guardia_ausente'
            );

        const hidden =
            document.getElementById(
                'guardia_ausente_hidden'
            );

        const servicio =
            document.getElementById(
                'info_servicio'
            );

        const plazaActual =
            document.getElementById(
                'info_plaza'
            );

        if (
            !plaza ||
            !cubre ||
            !guardia ||
            !hidden ||
            !servicio ||
            !plazaActual
        ) {
            return;
        }

        plaza.addEventListener(
            'change',
            function () {

                const opcion =
                    plaza.options[
                        plaza.selectedIndex
                    ];

                const nombre =
                    opcion.dataset.guardia || '';

                const empleadoId =
                    opcion.dataset.empleado || '';

                guardia.value = nombre;

                hidden.value = nombre;

                cubre.disabled = false;

                Array.from(
                    cubre.options
                ).forEach(function (op) {

                    op.hidden =
                        op.value == empleadoId;

                });

                if (cubre.value == empleadoId) {

                    cubre.value = "";

                }

                servicio.innerHTML =
                    "Selecciona un guardia";

                plazaActual.innerHTML =
                    "Selecciona un guardia";

                cubre.selectedIndex = 0;

            }
        );

        cubre.addEventListener(
            'change',
            function () {

                const opcion =
                    cubre.options[
                        cubre.selectedIndex
                    ];

                servicio.innerHTML =
                    opcion.dataset.servicio || "";

                plazaActual.innerHTML =
                    opcion.dataset.plaza || "";

            }
        );

    }
);
