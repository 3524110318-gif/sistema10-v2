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

                if (!boton || boton.disabled) {
                    return;
                }

                const textoOriginal = boton.innerHTML;

                boton.disabled = true;

                boton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-1"
                        aria-hidden="true"
                    ></span>

                    Procesando...
                `;

                try {

                    const respuesta = await fetch(
                        formulario.action,
                        {
                            method:
                                formulario.method.toUpperCase(),

                            body:
                                new FormData(formulario),

                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest',

                                'Accept':
                                    'application/json'
                            }
                        }
                    );

                    const resultado =
                        await respuesta.json();

                    if (!respuesta.ok) {

                        let mensaje =
                            resultado.message
                            || 'No fue posible actualizar el documento.';

                        if (resultado.errors) {

                            const primerError =
                                Object.values(
                                    resultado.errors
                                )[0];

                            if (
                                Array.isArray(primerError)
                                && primerError.length > 0
                            ) {
                                mensaje = primerError[0];
                            }

                        }

                        throw new Error(mensaje);

                    }

                    window.location.reload();

                } catch (error) {

                    boton.disabled = false;

                    boton.innerHTML =
                        textoOriginal;

                    alert(
                        error.message
                        || 'Ocurrió un error al actualizar el documento.'
                    );

                }

            }
        );

    });

});