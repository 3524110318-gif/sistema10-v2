document.addEventListener('DOMContentLoaded', function () {

    const checkboxes =
        document.querySelectorAll('.document-checkbox');

    const estado =
        document.getElementById('estado-documentacion');

    const contador =
        document.getElementById('contador-documentos');

    const observaciones =
        document.getElementById('observaciones');

    const contadorCaracteres =
        document.getElementById('contador-caracteres');


    function actualizarDocumentacion() {

        if (
            !checkboxes.length ||
            !estado ||
            !contador
        ) {
            return;
        }

        let seleccionados = 0;

        checkboxes.forEach(function (checkbox) {

            const contenedor =
                checkbox.closest('.document-option');

            if (checkbox.checked) {

                seleccionados++;

                contenedor?.classList.add(
                    'document-selected'
                );

            } else {

                contenedor?.classList.remove(
                    'document-selected'
                );

            }

        });


        contador.textContent =
            seleccionados + ' / 4 documentos';


        estado.classList.remove(
            'bg-danger',
            'bg-warning',
            'bg-success'
        );


        if (seleccionados === 4) {

            estado.textContent = 'Cumple';

            estado.classList.add(
                'bg-success'
            );

        } else if (seleccionados > 0) {

            estado.textContent = 'Pendiente';

            estado.classList.add(
                'bg-warning'
            );

        } else {

            estado.textContent =
                'Sin documentación';

            estado.classList.add(
                'bg-danger'
            );

        }

    }


    function actualizarCaracteres() {

        if (
            !observaciones ||
            !contadorCaracteres
        ) {
            return;
        }

        contadorCaracteres.textContent =
            observaciones.value.length +
            ' / 500';

    }


    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            actualizarDocumentacion
        );

    });


    if (observaciones) {

        observaciones.addEventListener(
            'input',
            actualizarCaracteres
        );

    }


    actualizarDocumentacion();

    actualizarCaracteres();

});