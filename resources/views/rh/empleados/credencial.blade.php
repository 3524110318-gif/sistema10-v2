<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Credencial GTRI
    </title>

    <style>

        /*
        |--------------------------------------------------------------------------
        | TAMAÑO DE CREDENCIAL VERTICAL CR80
        |--------------------------------------------------------------------------
        |
        | Ancho: 53.98 mm
        | Alto: 85.60 mm
        |
        */

        @page {
            size: 53.98mm 85.60mm;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 53.98mm;
            height: 85.60mm;
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, Arial, sans-serif;
            background: #000000;
        }

        /*
        |--------------------------------------------------------------------------
        | ESTRUCTURA GENERAL
        |--------------------------------------------------------------------------
        */

        .pagina {
            position: relative;
            width: 53.98mm;
            height: 85.60mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #050505;
            color: #FFFFFF;
        }

        .salto-pagina {
            page-break-after: always;
        }

        /*
        |--------------------------------------------------------------------------
        | FRENTE
        |--------------------------------------------------------------------------
        */

        .frente {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            background: #050505;
        }

        .logo-contenedor {
            position: absolute;
            top: 7mm;
            left: 4mm;
            width: 45.98mm;
            height: 54mm;
            text-align: center;
        }

        .logo {
            width: 43mm;
            max-height: 52mm;
        }

        .empresa-contenedor {
            position: absolute;
            left: 2.5mm;
            right: 2.5mm;
            bottom: 8mm;
            text-align: center;
        }

        .empresa {
            margin: 0;
            color: #D4AF37;
            font-size: 13pt;
            font-weight: bold;
            line-height: 1.1;
            letter-spacing: 0.5pt;
            white-space: nowrap;
        }

        .descripcion {
            margin-top: 2mm;
            color: #D6D6D6;
            font-size: 7.5pt;
            font-weight: normal;
            letter-spacing: 1.5pt;
            white-space: nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | REVERSO
        |--------------------------------------------------------------------------
        */

        .reverso {
            position: relative;
            width: 100%;
            height: 100%;
            background: #050505;
            color: #FFFFFF;
        }

        .reverso-contenido {
            position: absolute;
            top: 9mm;
            left: 5mm;
            right: 5mm;
        }

        .titulo-empleado {
            margin-bottom: 1.5mm;
            color: #D4AF37;
            font-size: 12pt;
            font-weight: bold;
            line-height: 1.2;
            text-align: left;
        }

        .cargo {
            margin-bottom: 7mm;
            color: #FFFFFF;
            font-size: 8pt;
            line-height: 1.3;
            text-align: left;
        }

        .separador {
            width: 100%;
            height: 0.4mm;
            margin-bottom: 6mm;
            background: #D4AF37;
        }

        /*
        |--------------------------------------------------------------------------
        | DATOS DE CONTACTO
        |--------------------------------------------------------------------------
        */

        .tabla-contacto {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-contacto td {
            padding: 2.5mm 0;
            border: none;
            vertical-align: top;
        }

        .etiqueta {
            width: 13mm;
            color: #D4AF37;
            font-size: 6.7pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .dato {
            color: #FFFFFF;
            font-size: 7pt;
            line-height: 1.35;
            word-wrap: break-word;
        }

        /*
        |--------------------------------------------------------------------------
        | PIE DEL REVERSO
        |--------------------------------------------------------------------------
        */

        .marca-reverso {
            position: absolute;
            left: 4mm;
            right: 4mm;
            bottom: 7mm;
            text-align: center;
        }

        .marca-reverso-titulo {
            color: #D4AF37;
            font-size: 8.5pt;
            font-weight: bold;
            letter-spacing: 0.5pt;
        }

        .marca-reverso-subtitulo {
            margin-top: 1.5mm;
            color: #BFC3C9;
            font-size: 5.8pt;
            letter-spacing: 1pt;
        }

    </style>

</head>

<body>

    {{-- ============================================================= --}}
    {{-- FRENTE DE LA CREDENCIAL --}}
    {{-- ============================================================= --}}

    <div class="pagina frente salto-pagina">

        <div class="logo-contenedor">

            <img
                src="{{ public_path('images/logo-gtri.png') }}"
                class="logo"
                alt="Logo GTRI"
            >

        </div>


        <div class="empresa-contenedor">

            <div class="empresa">

                GTRI S.A. DE C.V.

            </div>


            <div class="descripcion">

                SEGURIDAD PRIVADA

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- REVERSO DE LA CREDENCIAL --}}
    {{-- ============================================================= --}}

    <div class="pagina reverso">

        <div class="reverso-contenido">

            <div class="titulo-empleado">

                {{ mb_strtoupper(
                    trim(
                        $empleado->nombre . ' ' .
                        $empleado->apellido_paterno . ' ' .
                        $empleado->apellido_materno
                    )
                ) }}

            </div>


            <div class="cargo">

                {{ $empleado->puesto ?: 'Sin cargo registrado' }}

            </div>


            <div class="separador"></div>


            <table class="tabla-contacto">

                <tr>

                    <td class="icono">
                        ☎
                    </td>

                    <td class="dato">
                        {{ $empleado->telefono ?: 'No registrado' }}
                    </td>

                </tr>

                <tr>

                    <td class="icono">
                        ✉
                    </td>

                    <td class="dato">
                        ventas.gtri@gmail.com
                    </td>

                </tr>

                <tr>

                    <td class="icono">
                        🌐
                    </td>

                    <td class="dato">
                        www.gtriseguridad.com
                    </td>

                </tr>

            </table>

        </div>

    </div>

</body>

</html>