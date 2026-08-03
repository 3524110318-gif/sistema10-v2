document.addEventListener('DOMContentLoaded', () => {

    const descripcion =
        document.getElementById('descripcion');

    const contador =
        document.getElementById('contador-palabras');

    const formulario =
        document.getElementById('form-incidencia');

    const tipo =
        document.getElementById('tipo');

    const contenedorFolio =
        document.getElementById('contenedor-folio');

    const folioIncapacidad =
        document.getElementById('folio_incapacidad');


    /*
    |--------------------------------------------------------------------------
    | CONTADOR DE PALABRAS
    |--------------------------------------------------------------------------
    */

    function contarPalabras() {

        if (!descripcion || !contador) {
            return 0;
        }

        const texto =
            descripcion.value.trim();

        const palabras =
            texto === ''
                ? []
                : texto.split(/\s+/);

        const total =
            palabras.length;

        contador.textContent =
            `${total} / 300 palabras`;

        contador.classList.toggle(
            'is-limit',
            total >= 270 &&
            total <= 300
        );

        contador.classList.toggle(
            'is-invalid',
            total > 300
        );

        return total;

    }


    /*
    |--------------------------------------------------------------------------
    | FOLIO DE INCAPACIDAD
    |--------------------------------------------------------------------------
    */

    function actualizarCampoFolio() {

        if (
            !tipo ||
            !contenedorFolio ||
            !folioIncapacidad
        ) {
            return;
        }

        const esIncapacidad =
            tipo.value === 'incapacidad';

        contenedorFolio.style.display =
            esIncapacidad
                ? ''
                : 'none';

        folioIncapacidad.required =
            esIncapacidad;

        if (!esIncapacidad) {
            folioIncapacidad.value = '';
        }

    }


    /*
    |--------------------------------------------------------------------------
    | EVENTOS
    |--------------------------------------------------------------------------
    */

    if (descripcion && contador) {

        descripcion.addEventListener(
            'input',
            contarPalabras
        );

        contarPalabras();

    }


    if (tipo) {

        tipo.addEventListener(
            'change',
            actualizarCampoFolio
        );

        actualizarCampoFolio();

    }


    if (formulario) {

        formulario.addEventListener(
            'submit',
            (event) => {

                if (contarPalabras() > 300) {

                    event.preventDefault();

                    descripcion.focus();

                    alert(
                        'La descripción no debe superar las 300 palabras.'
                    );

                    return;

                }

                if (
                    tipo &&
                    tipo.value === 'incapacidad' &&
                    folioIncapacidad &&
                    folioIncapacidad.value.trim() === ''
                ) {

                    event.preventDefault();

                    folioIncapacidad.focus();

                    alert(
                        'Debes capturar el folio de la incapacidad.'
                    );

                }

            }
        );

    }

});