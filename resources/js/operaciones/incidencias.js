document.addEventListener('DOMContentLoaded', () => {

    const tipo = document.getElementById('tipo');
    const folio = document.getElementById('folio_fisico');
    const mensaje = document.getElementById('mensaje-folio');
    const descripcion = document.getElementById('descripcion');
    const contador = document.getElementById('contador-palabras');

    if (!tipo || !folio || !descripcion || !contador || !mensaje) {
        return;
    }

    function actualizarFolio() {

        const obligatorio =
            tipo.value === 'robo' ||
            tipo.value === 'accidente';

        folio.required = obligatorio;

        mensaje.textContent = obligatorio
            ? 'Este folio es obligatorio para este tipo de incidencia.'
            : 'Opcional para este tipo de incidencia.';

    }

    function actualizarContador() {

        const palabras = descripcion.value
            .trim()
            .split(/\s+/)
            .filter(Boolean);

        contador.textContent = `${palabras.length} / 300`;

        contador.classList.toggle(
            'text-danger',
            palabras.length > 300
        );

    }

    actualizarFolio();
    actualizarContador();

    tipo.addEventListener('change', actualizarFolio);
    descripcion.addEventListener('input', actualizarContador);

});