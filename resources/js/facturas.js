document.addEventListener('DOMContentLoaded', function () {

    const body = document.getElementById('detalle-body');

    function formatearNumero(valor) {

        valor = valor.replace(/,/g, '');

        if (valor === '' || isNaN(valor)) {
            return '';
        }

        return Number(valor).toLocaleString('en-US');
    }

    function obtenerNumero(valor) {

        return parseFloat(
            valor.replace(/,/g, '')
        ) || 0;

    }

    document.getElementById('agregar-servicio')
    .addEventListener('click', function () {

        const fila = body.rows[0].cloneNode(true);

        fila.querySelectorAll('input').forEach(input => {

            if (input.classList.contains('subtotal')) {

                input.value = '0.00';

            } else {

                input.value = '0';

            }

        });

        fila.querySelector('select').selectedIndex = 0;

        fila.querySelector('.plazas').value = '0';
        fila.querySelector('.cubiertas').value = '0';

        actualizarAlertaCobertura();

        body.appendChild(fila);

    });

    body.addEventListener('click', function (e) {

        if (e.target.closest('.eliminar-fila')) {

            if (body.rows.length > 1) {

                e.target.closest('tr').remove();

                calcularTotales();

            }

        }

    });

    body.addEventListener('input', function (e) {

        if (e.target.classList.contains('precio')) {

            let cursor = e.target.selectionStart;

            e.target.value = formatearNumero(
                e.target.value
            );

            e.target.setSelectionRange(cursor, cursor);

        }

        if (

            e.target.classList.contains('plazas')

            ||

            e.target.classList.contains('precio')

        ) {

            const fila = e.target.closest('tr');

            const plazas = parseFloat(

                fila.querySelector('.plazas').value

            ) || 0;

            const precio = obtenerNumero(

                fila.querySelector('.precio').value

            );

            const subtotal = plazas * precio;

            fila.querySelector('.subtotal').value = subtotal.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits: 2,

                    maximumFractionDigits: 2

                }

            );

            calcularTotales();

        }

    });

    function calcularTotales() {

        let subtotal = 0;

        document.querySelectorAll('.subtotal').forEach(s => {

            subtotal += obtenerNumero(

                s.value

            );

        });

        let iva = subtotal * 0.16;

        let total = subtotal + iva;

        document.getElementById('subtotal-general').innerHTML =

            '$ ' +

            subtotal.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits: 2,

                    maximumFractionDigits: 2

                }

            );

        document.getElementById('iva-general').innerHTML =

            '$ ' +

            iva.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits: 2,

                    maximumFractionDigits: 2

                }

            );

        document.getElementById('total-general').innerHTML =

            '$ ' +

            total.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits: 2,

                    maximumFractionDigits: 2

                }

            );

    }

    const tabla = document.getElementById('tabla-servicios');

    const alertaCobertura = document.getElementById(
        'alerta-cobertura'
    );

    const vacantesDetectadas = document.getElementById(
        'vacantes-detectadas'
    );

    function actualizarCobertura(select) {

        const fila = select.closest('tr');

        const opcion = select.options[
            select.selectedIndex
        ];

        const contratadas = parseInt(
            opcion.dataset.contratadas || 0
        );

        const cubiertas = parseInt(
            opcion.dataset.cubiertas || 0
        );

        fila.querySelector('.plazas').value =
            contratadas;

        fila.querySelector('.cubiertas').value =
            cubiertas;

        calcularTotales();

        actualizarAlertaCobertura();
    }

    function actualizarAlertaCobertura() {

        let totalVacantes = 0;

        document
            .querySelectorAll(
                'select[name="servicio_id[]"]'
            )
            .forEach(function (select) {

                const opcion = select.options[
                    select.selectedIndex
                ];

                totalVacantes += parseInt(
                    opcion?.dataset?.vacantes || 0
                );

            });

        if (!alertaCobertura || !vacantesDetectadas) {
            return;
        }

        if (totalVacantes > 0) {

            vacantesDetectadas.textContent =
                totalVacantes;

            alertaCobertura.classList.remove(
                'd-none'
            );

        } else {

            vacantesDetectadas.textContent = 0;

            alertaCobertura.classList.add(
                'd-none'
            );

        }
    }

    if (tabla) {

        tabla.addEventListener(
            'change',
            function (e) {

                if (
                    e.target.matches(
                        'select[name="servicio_id[]"]'
                    )
                ) {

                    actualizarCobertura(
                        e.target
                    );

                }

            }
        );

    }

});
