document.addEventListener('DOMContentLoaded', () => {

    const descripcion = document.getElementById('descripcion');
    const contador = document.getElementById('contador-palabras');
    const formulario = document.getElementById('form-incidencia');

    if (!descripcion || !contador || !formulario) {
        return;
    }

    function contarPalabras() {

        const texto = descripcion.value.trim();

        const palabras =
            texto === ''
                ? []
                : texto.split(/\s+/);

        const total = palabras.length;

        contador.textContent = `${total} / 300 palabras`;

        contador.classList.toggle(
            'is-limit',
            total >= 270 && total <= 300
        );

        contador.classList.toggle(
            'is-invalid',
            total > 300
        );

        return total;

    }

    descripcion.addEventListener(
        'input',
        contarPalabras
    );

    formulario.addEventListener(
        'submit',
        (event) => {

            if (contarPalabras() > 300) {

                event.preventDefault();

                descripcion.focus();

                alert(
                    'La descripción no debe superar las 300 palabras.'
                );

            }

        }
    );

    contarPalabras();

});