document

    .getElementById('foto')

    .addEventListener('change', function(event) {

        const imagen = document

            .getElementById('preview-imagen');


        const archivo = event.target.files[0];


        if (archivo) {

            imagen.src = URL.createObjectURL(archivo);

        }

    });