document.addEventListener(

    'DOMContentLoaded',

    function(){

        const body =
        document.getElementById(
            'detalle-body'
        );

        if(!body){
            return;
        }

        const entregasDeducibles =
            window.entregasDeducibles || [];

        const periodoInicio =
            document.getElementById(
                'periodo_inicio'
            );

        const periodoFin =
            document.getElementById(
                'periodo_fin'
            );

        function obtenerNumero(valor){

            return parseFloat(

                valor.toString().replace(/,/g,'')

            ) || 0;

        }

        function formatearInput(input){

            const numero = obtenerNumero(
                input.value
            );

            input.value = numero.toLocaleString(

                'en-US',

                {

                    maximumFractionDigits:2

                }

            );

        }

        document
        .getElementById(
            'agregar-empleado'
        )
        .addEventListener(

            'click',

            function(){

                const fila =
                body.rows[0]
                .cloneNode(true);

                fila.querySelectorAll(
                    'input'
                ).forEach(

                    input=>{

                        if(

                            input.classList.contains(
                                'total-neto'
                            )

                        ){

                            input.value='0.00';

                        }

                        else if(

                            input.type==='number'

                        ){

                            input.value='0';

                        }

                        else{

                            input.value='';

                        }

                    }

                );

                fila.querySelector(
                    'select'
                ).selectedIndex=0;

                body.appendChild(
                    fila
                );

                calcularDeduccionAutomatica(
                    fila
                );

                calcularTotales();

            }

        );

        body.addEventListener(

            'click',

            function(e){

                if(

                    e.target.closest(
                        '.eliminar-fila'
                    )

                ){

                    if(

                        body.rows.length>1

                    ){

                        e.target
                        .closest('tr')
                        .remove();

                        calcularTotales();

                    }

                }

            }

        );

        body.addEventListener(

            'input',

            function(e){

                if(

                    e.target.classList.contains(
                        'salario'
                    )

                    ||

                    e.target.classList.contains(
                        'percepciones'
                    )

                    ||

                    e.target.classList.contains(
                        'deducciones'
                    )

                    ||

                    e.target.classList.contains(
                        'ajustes'
                    )

                    ||

                    e.target.classList.contains(
                        'justificacion'
                    )

                    ||

                    e.target.classList.contains(
                        'horas-extra'
                    )

                    ||

                    e.target.classList.contains(
                        'dias-laborados'
                    )

                    ||

                    e.target.classList.contains(
                        'dias-incapacidad'
                    )

                ){

                    

                    calcularFila(

                        e.target.closest(
                            'tr'
                        )

                    );

                    calcularTotales();

                    const fila = e.target.closest('tr');

                    if(fila){

                        const incapacidad =

                            parseInt(

                                fila.querySelector(
                                    '.dias-incapacidad'
                                ).value

                            ) || 0;

                        const folio =

                            fila.querySelector(
                                '.folio-imss'
                            );

                        if(

                            incapacidad > 0

                        ){

                            folio.required = true;

                            folio.classList.add(
                                'is-invalid'
                            );

                            if(

                                folio.value.trim() !== ''

                            ){

                                folio.classList.remove(
                                    'is-invalid'
                                );

                            }

                        }

                        else{

                            folio.required = false;

                            folio.classList.remove(
                                'is-invalid'
                            );

                            folio.value = '';

                        }

                    }

                }

            }

        );

        function calcularDeduccionAutomatica(fila){

            const empleadoSelect =
                fila.querySelector(
                    'select[name="empleado_id[]"]'
                );

            const campoDeduccion =
                fila.querySelector(
                    '.deducciones'
                );

            if(
                !empleadoSelect
                ||
                !campoDeduccion
            ){
                return;
            }

            const empleadoId =
                parseInt(
                    empleadoSelect.value
                ) || 0;

            const inicio =
                periodoInicio
                    ? periodoInicio.value
                    : '';

            const fin =
                periodoFin
                    ? periodoFin.value
                    : '';

            if(
                !empleadoId
                ||
                !inicio
                ||
                !fin
            ){

                campoDeduccion.value =
                    '0.00';

                calcularFila(fila);

                calcularTotales();

                return;
            }

            const totalDeduccion =
                entregasDeducibles
                .filter(
                    function(entrega){

                        const fechaEntrega =
                            String(
                                entrega.fecha_entrega
                            ).substring(
                                0,
                                10
                            );

                        return (
                            parseInt(
                                entrega.empleado_id
                            ) === empleadoId
                            &&
                            fechaEntrega >= inicio
                            &&
                            fechaEntrega <= fin
                        );

                    }
                )
                .reduce(
                    function(
                        total,
                        entrega
                    ){

                        const cantidad =
                            parseFloat(
                                entrega.cantidad
                            ) || 0;

                        const monto =
                            parseFloat(
                                entrega.producto
                                    ?.monto_deduccion
                            ) || 0;

                        return total
                            +
                            (
                                cantidad
                                *
                                monto
                            );

                    },
                    0
                );

            campoDeduccion.value =
                totalDeduccion.toLocaleString(
                    'en-US',
                    {
                        minimumFractionDigits:2,
                        maximumFractionDigits:2
                    }
                );

            calcularFila(fila);

            calcularTotales();

        }

        function calcularFila(fila){

            const salario =

                obtenerNumero(

                    fila.querySelector(
                        '.salario'
                    ).value

                );

            const diasLaborados =

                parseInt(

                    fila.querySelector(
                        '.dias-laborados'
                    ).value

                ) || 0;

            const diasIncapacidad =

                parseInt(

                    fila.querySelector(
                        '.dias-incapacidad'
                    ).value

                ) || 0;

            const percepciones =

                obtenerNumero(

                    fila.querySelector(
                        '.percepciones'
                    ).value

                );

            const deducciones =

                obtenerNumero(

                    fila.querySelector(
                        '.deducciones'
                    ).value

                );

            const ajustes =

                obtenerNumero(

                    fila.querySelector(
                        '.ajustes'
                    ).value

                );

            const justificacion =

                fila.querySelector(
                    '.justificacion'
                );

            const horasExtra =

                obtenerNumero(

                    fila.querySelector(
                        '.horas-extra'
                    ).value

                );

            const diasPagados =

                Math.max(

                    diasLaborados - diasIncapacidad,

                    0

                );

            const salarioDiario =

                diasLaborados > 0

                ?

                salario / diasLaborados

                :

                0;

            const pagoBase =

                salarioDiario * diasPagados;

            const total =

                pagoBase

                +

                percepciones

                +

                ajustes

                +

                horasExtra

                -

                deducciones;


                if(

                    ajustes !== 0

                ){

                    justificacion.required = true;

                    if(

                        justificacion.value.trim() === ''

                    ){

                        justificacion.classList.add(
                            'is-invalid'
                        );

                    }

                    else{

                        justificacion.classList.remove(
                            'is-invalid'
                        );

                    }

                }

                else{

                    justificacion.required = false;

                    justificacion.classList.remove(
                        'is-invalid'
                    );

                    justificacion.value = '';

                }
            fila.querySelector(
                '.total-neto'
            ).value =

            total.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits:2,

                    maximumFractionDigits:2

                }

            );

        }

        function calcularTotales(){

            let total = 0;

            document
            .querySelectorAll(
                '.total-neto'
            )
            .forEach(

                input=>{

                    total +=

                    obtenerNumero(
                        input.value
                    );

                }

            );

            document
            .getElementById(
                'total-nomina'
            )
            .innerHTML =

            '$ ' +

            total.toLocaleString(

                'en-US',

                {

                    minimumFractionDigits:2,

                    maximumFractionDigits:2

                }

            );

        }

        body.addEventListener(

            'change',

            function(e){

                if(

                    e.target.matches(
                        'select[name="empleado_id[]"]'
                    )

                ){

                    const fila =
                        e.target.closest(
                            'tr'
                        );

                    calcularDeduccionAutomatica(
                        fila
                    );

                }

            }

        );

        if(periodoInicio){

            periodoInicio.addEventListener(

                'change',

                function(){

                    Array.from(
                        body.rows
                    ).forEach(

                        function(fila){

                            calcularDeduccionAutomatica(
                                fila
                            );

                        }

                    );

                }

            );

        }

        if(periodoFin){

            periodoFin.addEventListener(

                'change',

                function(){

                    Array.from(
                        body.rows
                    ).forEach(

                        function(fila){

                            calcularDeduccionAutomatica(
                                fila
                            );

                        }

                    );

                }

            );

        }

        Array.from(
            body.rows
        ).forEach(

            function(fila){

                calcularDeduccionAutomatica(
                    fila
                );

            }

        );

        calcularTotales();

    }

);
