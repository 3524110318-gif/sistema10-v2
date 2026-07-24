<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Credencial GTRI</title>

    <style>

        @page {
            margin: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: DejaVu Sans, Arial, sans-serif;
            background: #E5E7EB;
        }

        .contenedor {
            width: 100%;
            text-align: center;
        }

        .credencial {
            display: inline-block;
            position: relative;
            vertical-align: top;
            width: 310px;
            height: 500px;
            margin: 0 8px;
            overflow: hidden;
            border-radius: 25px;
            background: #090909;
            border: 2px solid #D4AF37;
            color: white;
        }

        .linea-dorada {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: #D4AF37;
        }

        .linea-azul {
            position: absolute;
            top: 8px;
            left: 0;
            width: 100%;
            height: 5px;
            background: #005DAA;
        }

        /* FRENTE */

        .frente {
            position: relative;
            height: 100%;
            padding: 45px 25px 30px;
            text-align: center;
        }

        .logo {
            width: 205px;
            height: auto;
            max-height: 270px;
            object-fit: contain;
        }

        .empresa {
            margin-top: 25px;
            color: #D4AF37;
            font-size: 21px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .descripcion {
            margin-top: 8px;
            color: #D1D5DB;
            font-size: 14px;
            letter-spacing: 3px;
        }

        .linea-inferior {
            position: absolute;
            bottom: 25px;
            left: 25px;
            right: 25px;
            height: 2px;
            background: #D4AF37;
        }

        /* REVERSO */

        .reverso {
            position: relative;
            height: 100%;
            padding: 42px 25px 25px;
            text-align: left;
        }

        .nombre {
            color: #D4AF37;
            font-size: 20px;
            font-weight: bold;
            line-height: 1.3;
        }

        .puesto {
            margin-top: 5px;
            color: white;
            font-size: 14px;
        }

        .contactos {
            width: 100%;
            margin-top: 35px;
            border-collapse: collapse;
        }

        .contactos td {
            border: none;
            padding: 11px 2px;
            vertical-align: middle;
        }

        .icono {
            width: 42px;
            color: #D4AF37;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .dato {
            color: white;
            font-size: 12px;
        }

        .qr-contenedor {
            margin-top: 24px;
            text-align: center;
        }

        .qr-marco {
            display: inline-block;
            padding: 8px;
            border: 2px solid #D4AF37;
            border-radius: 14px;
            background: #111111;
        }

        .qr {
            width: 145px;
            height: 145px;
            object-fit: contain;
        }

        .aviso {
            position: absolute;
            bottom: 18px;
            left: 20px;
            right: 20px;
            color: #9CA3AF;
            font-size: 8px;
            line-height: 1.5;
            text-align: center;
        }

    </style>

</head>

<body>

    <div class="contenedor">

        {{-- FRENTE --}}
        <div class="credencial">

            <div class="linea-dorada"></div>

            <div class="linea-azul"></div>


            <div class="frente">

                <img
                    src="{{ public_path('images/logo-gtri.png') }}"
                    class="logo"
                    alt="Logo GTRI"
                >


                <div class="empresa">

                    GTRI S.A. DE C.V.

                </div>


                <div class="descripcion">

                    SEGURIDAD PRIVADA

                </div>


                <div class="linea-inferior"></div>

            </div>

        </div>


        {{-- REVERSO --}}
        <div class="credencial">

            <div class="linea-dorada"></div>

            <div class="linea-azul"></div>


            <div class="reverso">

                <div class="nombre">

                    {{ $empleado->nombre }}

                    {{ $empleado->apellido_paterno }}

                    {{ $empleado->apellido_materno }}

                </div>


                <div class="puesto">

                    {{ $empleado->puesto }}

                </div>


                <table class="contactos">

                    <tr>

                        <td class="icono">

                            TEL.

                        </td>

                        <td class="dato">

                            322 215 88 09

                        </td>

                    </tr>


                    <tr>

                        <td class="icono">

                            @

                        </td>

                        <td class="dato">

                            ventas.gtri@gmail.com

                        </td>

                    </tr>


                    <tr>

                        <td class="icono">

                            WEB

                        </td>

                        <td class="dato">

                            www.gtriseguridad.com

                        </td>

                    </tr>

                </table>


                <div class="qr-contenedor">

                    <div class="qr-marco">

                        <img
                            src="{{ public_path('images/qr-gtri.png') }}"
                            class="qr"
                            alt="Código QR GTRI"
                        >

                    </div>

                </div>


                <div class="aviso">

                    Esta credencial es propiedad de GTRI S.A. de C.V.

                    <br>

                    En caso de extravío, favor de reportarla a Recursos Humanos.

                </div>

            </div>

        </div>

    </div>

</body>

</html>