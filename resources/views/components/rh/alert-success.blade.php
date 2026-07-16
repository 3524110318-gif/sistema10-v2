@if(session('success'))

    <div

        class="alert alert-success rounded-4 shadow-sm mb-4"

        id="alerta-success"

    >

        {{ session('success') }}

    </div>


    <script>

        setTimeout(() => {

            let alerta = document.getElementById(

                'alerta-success'

            );


            if (alerta) {

                alerta.style.display = 'none';

            }

        }, 3000);

    </script>

@endif