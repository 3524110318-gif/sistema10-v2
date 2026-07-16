<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>

        Ficha Técnica

    </title>

    <style>

        body{
            font-family: Arial;
            margin:40px;
        }

        .foto{
            width:150px;
            height:150px;
            border:1px solid #ccc;
            object-fit:cover;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        td{
            border:1px solid #ccc;
            padding:10px;
        }

    </style>

</head>

<body>

    <h1>

        FICHA TÉCNICA DE INGRESO

    </h1>

    @if($empleado->foto)

        <img

            src="{{ public_path(
                'fotos_empleados/' .
                $empleado->foto
            ) }}"

            class="foto"

        >

    @endif

    <table>

        <tr>

            <td>

                No. Control

            </td>

            <td>

                {{ $empleado->numero_control }}

            </td>

        </tr>

        <tr>

            <td>

                Nombre

            </td>

            <td>

                {{ $empleado->nombre }}
                {{ $empleado->apellido_paterno }}
                {{ $empleado->apellido_materno }}

            </td>

        </tr>

        <tr>

            <td>

                CURP

            </td>

            <td>

                {{ $empleado->curp }}

            </td>

        </tr>

        <tr>

            <td>

                RFC

            </td>

            <td>

                {{ $empleado->rfc }}

            </td>

        </tr>

        <tr>

            <td>

                NSS

            </td>

            <td>

                {{ $empleado->nss }}

            </td>

        </tr>

        <tr>

            <td>

                Puesto

            </td>

            <td>

                {{ $empleado->puesto }}

            </td>

        </tr>

        <tr>

            <td>

                Rango

            </td>

            <td>

                {{ $empleado->rango }}

            </td>

        </tr>

        <tr>

            <td>

                Fecha ingreso

            </td>

            <td>

                {{ $empleado->fecha_ingreso }}

            </td>

        </tr>

        <tr>
            <td>Tipo sangre</td>
            <td>{{ $empleado->tipo_sangre }}</td>
        </tr>

        <tr>
            <td>Estado</td>
            <td>{{ ucfirst($empleado->estado) }}</td>
        </tr>

        <tr>
            <td>Teléfono</td>
            <td>{{ $empleado->telefono }}</td>
        </tr>

        <tr>
            <td>Correo</td>
            <td>{{ $empleado->correo }}</td>
        </tr>

        <tr>
            <td>Dirección</td>
            <td>{{ $empleado->direccion }}</td>
        </tr>

        <tr>
            <td>Contacto emergencia</td>
            <td>{{ $empleado->contacto_emergencia }}</td>
        </tr>

        <tr>
            <td>Teléfono emergencia</td>
            <td>{{ $empleado->telefono_emergencia }}</td>
        </tr>

        <tr>
            <td>Antigüedad</td>
            <td>{{ $empleado->antiguedad() }}</td>
        </tr>

    </table>

    <h3>

    Documentación RH

    </h3>

    <table>

        <tr>

            <th>Documento</th>

            <th>Estado</th>

        </tr>

        @foreach ($empleado->documentos as $documento)

            <tr>

                <td>

                    {{ $documento->nombre }}

                </td>

                <td>

                    ENTREGADO

                </td>

            </tr>

        @endforeach

    </table>

    <br><br>

    <table>

        <tr>

            <td
                style="
                    text-align:center;
                    height:80px;
                "
            >

                ______________________

                <br>

                Empleado

            </td>

            <td
                style="
                    text-align:center;
                    height:80px;
                "
            >

                ______________________

                <br>

                Recursos Humanos

            </td>

        </tr>

    </table>

</body>

</html>
