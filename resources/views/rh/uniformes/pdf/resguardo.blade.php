<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Resguardo de entrega de uniforme
    </title>

    <style>

        @page {
            margin: 35px 45px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .encabezado {
            width: 100%;
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
            margin-bottom: 22px;
        }

        .empresa {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
        }

        .titulo {
            font-size: 17px;
            font-weight: bold;
            text-align: center;
            margin-top: 8px;
            text-transform: uppercase;
        }

        .folio {
            text-align: right;
            font-size: 11px;
            color: #4B5563;
            margin-top: 5px;
        }

        .seccion {
            margin-top: 20px;
        }

        .seccion-titulo {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            background: #E5E7EB;
            padding: 7px 9px;
            border: 1px solid #9CA3AF;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        th,
        td {
            border: 1px solid #9CA3AF;
            padding: 8px;
            vertical-align: top;
        }

        th {
            width: 25%;
            background: #F3F4F6;
            text-align: left;
        }

        .observaciones {
            min-height: 55px;
            border: 1px solid #9CA3AF;
            padding: 10px;
            margin-top: 8px;
        }

        .firma-contenedor {
            margin-top: 18px;
            text-align: center;
        }

        .firma-imagen {
            max-width: 300px;
            max-height: 120px;
        }

        .linea-firma {
            width: 320px;
            border-top: 1px solid #111827;
            margin: 10px auto 5px;
        }

        .pie {
            margin-top: 25px;
            font-size: 10px;
            color: #6B7280;
            text-align: center;
        }

    </style>

</head>

<body>

    <div class="encabezado">

        <p class="empresa">
            GTRI
        </p>

        <div class="titulo">
            Resguardo de entrega de uniforme
        </div>

        <div class="folio">
            Folio: EU-{{ str_pad($entrega->id, 6, '0', STR_PAD_LEFT) }}
        </div>

    </div>


    <div class="seccion">

        <div class="seccion-titulo">
            Datos del empleado
        </div>

        <table>

            <tr>

                <th>
                    Nombre
                </th>

                <td>
                    {{ $entrega->empleado->nombre }}
                    {{ $entrega->empleado->apellido_paterno }}
                    {{ $entrega->empleado->apellido_materno }}
                </td>

            </tr>

            <tr>

                <th>
                    Número de control
                </th>

                <td>
                    {{ $entrega->empleado->numero_control }}
                </td>

            </tr>

            <tr>

                <th>
                    Puesto
                </th>

                <td>
                    {{ $entrega->empleado->puesto ?? 'No especificado' }}
                </td>

            </tr>

        </table>

    </div>


    <div class="seccion">

        <div class="seccion-titulo">
            Datos de la entrega
        </div>

        <table>

            <tr>

                <th>
                    Artículo
                </th>

                <td>
                    {{ $entrega->articulo }}
                </td>

            </tr>

            <tr>

                <th>
                    Cantidad
                </th>

                <td>
                    {{ $entrega->cantidad }}
                </td>

            </tr>

            <tr>

                <th>
                    Condición
                </th>

                <td>
                    {{ $entrega->tipo === 'segunda_mano'
                        ? 'Segunda mano'
                        : 'Nuevo' }}
                </td>

            </tr>

            <tr>

                <th>
                    Fecha de entrega
                </th>

                <td>
                    {{ \Carbon\Carbon::parse(
                        $entrega->fecha_entrega
                    )->format('d/m/Y') }}
                </td>

            </tr>

        </table>

    </div>


    <div class="seccion">

        <div class="seccion-titulo">
            Observaciones
        </div>

        <div class="observaciones">

            {{ $entrega->observaciones
                ?: 'Sin observaciones.' }}

        </div>

    </div>


    <div class="seccion">

        <div class="seccion-titulo">
            Firma de conformidad
        </div>

        <div class="firma-contenedor">

            @if($entrega->firma_path)

                <img
                    src="{{ public_path(
                        'storage/' .
                        $entrega->firma_path
                    ) }}"
                    alt="Firma del empleado"
                    class="firma-imagen"
                >

            @endif

            <div class="linea-firma"></div>

            <strong>

                {{ $entrega->empleado->nombre }}
                {{ $entrega->empleado->apellido_paterno }}
                {{ $entrega->empleado->apellido_materno }}

            </strong>

            <div>
                Firma del colaborador
            </div>

        </div>

    </div>


    <div class="seccion">

        <table>

            <tr>

                <th>
                    Registrado por
                </th>

                <td>
                    {{ $usuarioRegistro }}
                </td>

            </tr>

            <tr>

                <th>
                    Fecha y hora de registro
                </th>

                <td>
                    {{ $entrega->created_at->format(
                        'd/m/Y H:i'
                    ) }}
                </td>

            </tr>

        </table>

    </div>


    <div class="pie">

        Este documento constituye el comprobante de entrega y recepción del uniforme,
        equipo o accesorio descrito. El archivo fue generado automáticamente por el
        sistema GTRI.

    </div>

</body>

</html>