<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Ficha Técnica de Ingreso</title>

    <style>

        @page {
            margin: 25px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            margin: 0;
            color: #111827;
            font-size: 12px;
        }

        .encabezado {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .encabezado td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .marca {
            background: #0B1220;
            color: #F4C430;
            width: 130px;
            text-align: center;
            padding: 18px 10px !important;
            font-size: 24px;
            font-weight: bold;
        }

        .titulo-contenedor {
            border: 1px solid #D1D5DB !important;
            padding: 15px 18px !important;
        }

        .titulo {
            font-size: 21px;
            font-weight: bold;
            margin: 0 0 5px;
            color: #0B1220;
        }

        .subtitulo {
            color: #6B7280;
            font-size: 11px;
        }

        .perfil {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .perfil td {
            border: 1px solid #D1D5DB;
            vertical-align: middle;
            padding: 14px;
        }

        .foto-contenedor {
            width: 180px;
            text-align: center;
            background: #F8FAFC;
        }

        .foto {
            width: 135px;
            height: 135px;
            object-fit: cover;
            border: 3px solid #D4AF37;
            border-radius: 8px;
        }

        .sin-foto {
            width: 135px;
            height: 135px;
            margin: auto;
            background: #E5E7EB;
            border: 3px solid #D4AF37;
            text-align: center;
            line-height: 135px;
            color: #6B7280;
        }

        .nombre {
            font-size: 19px;
            font-weight: bold;
            color: #0B1220;
            margin-bottom: 8px;
        }

        .numero-control {
            color: #B8860B;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .estado {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .estado-activo {
            background: #DCFCE7;
            color: #166534;
            border: 1px solid #86EFAC;
        }

        .estado-inactivo {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }

        .seccion-titulo {
            background: #0B1220;
            color: #F4C430;
            padding: 9px 12px;
            margin-top: 17px;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-datos td,
        .tabla-datos th {
            border: 1px solid #D1D5DB;
            padding: 9px 10px;
        }

        .tabla-datos th {
            background: #E5E7EB;
            color: #111827;
            text-align: left;
            font-weight: bold;
        }

        .tabla-datos td:first-child {
            width: 32%;
            background: #F8FAFC;
            font-weight: bold;
            color: #374151;
        }

        .tabla-documentos {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-documentos th,
        .tabla-documentos td {
            border: 1px solid #D1D5DB;
            padding: 9px 10px;
        }

        .tabla-documentos th {
            background: #E5E7EB;
            text-align: left;
        }

        .entregado {
            color: #15803D;
            font-weight: bold;
        }

        .sin-documentos {
            color: #6B7280;
            text-align: center;
        }

        .firmas {
            width: 100%;
            border-collapse: collapse;
            margin-top: 45px;
        }

        .firmas td {
            border: none;
            width: 50%;
            text-align: center;
            padding: 0 25px;
        }

        .linea-firma {
            border-top: 1px solid #111827;
            padding-top: 7px;
            font-weight: bold;
        }

        .pie {
            margin-top: 22px;
            border-top: 1px solid #D1D5DB;
            padding-top: 8px;
            color: #6B7280;
            font-size: 9px;
            text-align: center;
        }

    </style>

</head>

<body>

    {{-- ENCABEZADO --}}
    <table class="encabezado">

        <tr>

            <td class="marca">

                GTRI

            </td>

            <td class="titulo-contenedor">

                <div class="titulo">

                    FICHA TÉCNICA DE INGRESO

                </div>

                <div class="subtitulo">

                    Expediente general del empleado · Recursos Humanos

                </div>

            </td>

        </tr>

    </table>


    {{-- PERFIL --}}
    <table class="perfil">

        <tr>

            <td class="foto-contenedor">

                @if ($empleado->foto)

                    <img
                        src="{{ public_path(
                            'fotos_empleados/' .
                            $empleado->foto
                        ) }}"
                        class="foto"
                    >

                @else

                    <div class="sin-foto">

                        SIN FOTO

                    </div>

                @endif

            </td>

            <td>

                <div class="nombre">

                    {{ $empleado->nombre }}

                    {{ $empleado->apellido_paterno }}

                    {{ $empleado->apellido_materno }}

                </div>

                <div class="numero-control">

                    {{ $empleado->numero_control }}

                </div>

                <div style="margin-bottom: 6px;">

                    <strong>Puesto:</strong>

                    {{ $empleado->puesto }}

                </div>

                <div style="margin-bottom: 10px;">

                    <strong>Rango:</strong>

                    {{ $empleado->rango }}

                </div>

                @if ($empleado->estado === 'activo')

                    <span class="estado estado-activo">

                        Activo

                    </span>

                @else

                    <span class="estado estado-inactivo">

                        Inactivo

                    </span>

                @endif

            </td>

        </tr>

    </table>


    {{-- INFORMACIÓN PERSONAL --}}
    <div class="seccion-titulo">

        Información personal y documental

    </div>

    <table class="tabla-datos">

        <tr>
            <td>No. de control</td>
            <td>{{ $empleado->numero_control }}</td>
        </tr>

        <tr>
            <td>Nombre completo</td>
            <td>
                {{ $empleado->nombre }}
                {{ $empleado->apellido_paterno }}
                {{ $empleado->apellido_materno }}
            </td>
        </tr>

        <tr>
            <td>CURP</td>
            <td>{{ $empleado->curp }}</td>
        </tr>

        <tr>
            <td>RFC</td>
            <td>{{ $empleado->rfc }}</td>
        </tr>

        <tr>
            <td>NSS</td>
            <td>{{ $empleado->nss }}</td>
        </tr>

        <tr>
            <td>Tipo de sangre</td>
            <td>{{ $empleado->tipo_sangre }}</td>
        </tr>

        <tr>
            <td>Estado</td>
            <td>{{ ucfirst($empleado->estado) }}</td>
        </tr>

    </table>


    {{-- INFORMACIÓN LABORAL --}}
    <div class="seccion-titulo">

        Información laboral

    </div>

    <table class="tabla-datos">

        <tr>
            <td>Puesto</td>
            <td>{{ $empleado->puesto }}</td>
        </tr>

        <tr>
            <td>Rango</td>
            <td>{{ $empleado->rango }}</td>
        </tr>

        <tr>
            <td>Fecha de ingreso</td>
            <td>{{ $empleado->fecha_ingreso }}</td>
        </tr>

        <tr>
            <td>Antigüedad</td>
            <td>{{ $empleado->antiguedad() }}</td>
        </tr>

        <tr>
            <td>Salario base</td>
            <td>
                ${{ number_format($empleado->salario_base, 2) }}
            </td>
        </tr>

    </table>


    {{-- CONTACTO --}}
    <div class="seccion-titulo">

        Información de contacto

    </div>

    <table class="tabla-datos">

        <tr>
            <td>Teléfono</td>
            <td>{{ $empleado->telefono }}</td>
        </tr>

        <tr>
            <td>Correo electrónico</td>
            <td>{{ $empleado->correo }}</td>
        </tr>

        <tr>
            <td>Dirección</td>
            <td>{{ $empleado->direccion }}</td>
        </tr>

        <tr>
            <td>Contacto de emergencia</td>
            <td>{{ $empleado->contacto_emergencia }}</td>
        </tr>

        <tr>
            <td>Teléfono de emergencia</td>
            <td>{{ $empleado->telefono_emergencia }}</td>
        </tr>

    </table>


    {{-- DOCUMENTACIÓN RH --}}
    <div class="seccion-titulo">

        Documentación RH entregada

    </div>

    <table class="tabla-documentos">

        <thead>

            <tr>

                <th>Documento</th>

                <th style="width: 25%;">Estado</th>

            </tr>

        </thead>

        <tbody>

            @forelse ($empleado->documentos as $documento)

                <tr>

                    <td>

                        {{ $documento->nombre }}

                    </td>

                    <td class="entregado">

                        ENTREGADO

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="2"
                        class="sin-documentos"
                    >

                        No hay documentos registrados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- FIRMAS --}}
    <table class="firmas">

        <tr>

            <td>

                <div class="linea-firma">

                    Empleado

                </div>

            </td>

            <td>

                <div class="linea-firma">

                    Recursos Humanos

                </div>

            </td>

        </tr>

    </table>


    <div class="pie">

        GTRI S.A. de C.V. · Documento generado por el sistema de Recursos Humanos

    </div>

</body>

</html>