document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('firmaCanvas');
    const firmaInput = document.getElementById('firma');
    const limpiarButton = document.getElementById('limpiarFirma');
    const formulario = canvas?.closest('form');

    if (!canvas || !firmaInput || !formulario) {
        return;
    }

    const contexto = canvas.getContext('2d');

    let dibujando = false;
    let firmaRealizada = false;

    const obtenerPosicion = (evento) => {
        const rect = canvas.getBoundingClientRect();

        return {
            x: evento.clientX - rect.left,
            y: evento.clientY - rect.top,
        };
    };

    const prepararCanvas = () => {
        const rect = canvas.getBoundingClientRect();
        const escala = window.devicePixelRatio || 1;

        canvas.width = Math.round(rect.width * escala);
        canvas.height = Math.round(rect.height * escala);

        contexto.setTransform(escala, 0, 0, escala, 0, 0);

        contexto.lineWidth = 2;
        contexto.lineCap = 'round';
        contexto.lineJoin = 'round';
        contexto.strokeStyle = '#111827';

        contexto.fillStyle = '#FFFFFF';
        contexto.fillRect(0, 0, rect.width, rect.height);
    };

    const iniciarFirma = (evento) => {
        evento.preventDefault();

        dibujando = true;
        firmaRealizada = true;

        canvas.setPointerCapture(evento.pointerId);

        const posicion = obtenerPosicion(evento);

        contexto.beginPath();
        contexto.moveTo(posicion.x, posicion.y);
    };

    const dibujarFirma = (evento) => {
        if (!dibujando) {
            return;
        }

        evento.preventDefault();

        const posicion = obtenerPosicion(evento);

        contexto.lineTo(posicion.x, posicion.y);
        contexto.stroke();
    };

    const terminarFirma = (evento) => {
        if (!dibujando) {
            return;
        }

        evento.preventDefault();

        dibujando = false;
        contexto.closePath();

        if (canvas.hasPointerCapture(evento.pointerId)) {
            canvas.releasePointerCapture(evento.pointerId);
        }
    };

    const limpiarFirma = () => {
        const rect = canvas.getBoundingClientRect();

        contexto.clearRect(0, 0, rect.width, rect.height);

        contexto.fillStyle = '#FFFFFF';
        contexto.fillRect(0, 0, rect.width, rect.height);

        contexto.strokeStyle = '#111827';
        contexto.lineWidth = 2;
        contexto.lineCap = 'round';
        contexto.lineJoin = 'round';

        firmaInput.value = '';
        firmaRealizada = false;
    };

    prepararCanvas();

    canvas.style.touchAction = 'none';

    canvas.addEventListener('pointerdown', iniciarFirma);
    canvas.addEventListener('pointermove', dibujarFirma);
    canvas.addEventListener('pointerup', terminarFirma);
    canvas.addEventListener('pointercancel', terminarFirma);
    canvas.addEventListener('pointerleave', terminarFirma);

    limpiarButton?.addEventListener('click', limpiarFirma);

    formulario.addEventListener('submit', (evento) => {
        if (!firmaRealizada) {
            evento.preventDefault();

            alert(
                'La firma del empleado es obligatoria para registrar la entrega.'
            );

            canvas.scrollIntoView({
                behavior: 'smooth',
                block: 'center',
            });

            return;
        }

        firmaInput.value = canvas.toDataURL('image/png');
    });

    window.addEventListener('resize', () => {
        if (!firmaRealizada) {
            prepararCanvas();
        }
    });
});