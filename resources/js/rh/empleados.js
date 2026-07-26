const salario = document.getElementById('salario_base');

if (salario) {

    salario.addEventListener('focus', function () {

        this.value = this.value
            .replace(/\$/g, '')
            .replace(/,/g, '');

    });

    salario.addEventListener('blur', function () {

        let valor = this.value.trim();

        if (valor === '') {

            return;

        }

        let numero = Number(valor);

        if (isNaN(numero)) {

            return;

        }

        this.value =
            '$' +
            numero.toLocaleString(
                'es-MX',
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );

    });

}

const telefonos = [

    document.getElementById('telefono'),

    document.getElementById('telefono_emergencia')

];

telefonos.forEach(function (telefono) {

    if (!telefono) {

        return;

    }

    telefono.addEventListener('input', function () {

        let valor = this.value.replace(/\D/g, '');

        valor = valor.substring(0, 10);

        if (valor.length > 6) {

            valor = valor.replace(
                /(\d{3})(\d{3})(\d+)/,
                '$1 $2 $3'
            );

        } else if (valor.length > 3) {

            valor = valor.replace(
                /(\d{3})(\d+)/,
                '$1 $2'
            );

        }

        this.value = valor;

    });

});