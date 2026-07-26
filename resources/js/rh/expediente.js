document.addEventListener('DOMContentLoaded', function () {

    const formularios = document.querySelectorAll(
        '.gtri-document-form'
    );

    formularios.forEach(function (formulario) {

        formulario.addEventListener(
            'submit',
            async function (evento) {

                evento.preventDefault();

                const boton = formulario.querySelector(
                    'button[type="submit"]'
                );

                const textoOriginal = boton.innerHTML;

                boton.disabled = true;

                boton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-1"
                    ></span>

                    Procesando...
                `;

                try {

                    const respuesta = await fetch(
                        formulario.action,
                        {
                            method: formulario.method,
                            body: new FormData(formulario),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest',

                                'Accept':
                                    'application/json'
                            }
                        }
                    );

                    if (!respuesta.ok) {

                        throw new Error(
                            'No fue posible actualizar el documento.'
                        );

                    }

                    window.location.reload();

                } catch (error) {

                    boton.disabled = false;

                    boton.innerHTML = textoOriginal;

                    alert(error.message);

                }

            }
        );

    });

});