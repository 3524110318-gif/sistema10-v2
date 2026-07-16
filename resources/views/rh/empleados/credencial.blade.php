<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>Credencial GTRI</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            padding:40px;
        }

        .credencial{

            width:340px;

            border-radius:15px;

            overflow:hidden;

            border:2px solid #0F172A;

            background:white;

            box-shadow:0 0 15px rgba(0,0,0,.15);

        }

        .header{

            background:#0F172A;

            color:white;

            text-align:center;

            padding:15px;

            font-size:22px;

            font-weight:bold;

        }

        .contenido{

            padding:20px;

            text-align:center;

        }

        .foto{

            width:120px;

            height:120px;

            border-radius:10px;

            border:2px solid #ddd;

            object-fit:cover;

        }

        .nombre{

            font-size:20px;

            font-weight:bold;

            margin-top:15px;

        }

        .control{

            color:#2563EB;

            font-weight:bold;

            margin-top:5px;

        }

        .puesto{

            margin-top:10px;

            font-size:16px;

        }

        .estado{

            margin-top:15px;

            display:inline-block;

            background:#16A34A;

            color:white;

            padding:6px 12px;

            border-radius:20px;

            font-weight:bold;

        }

    </style>

</head>

<body>

<div class="credencial">

    <div class="header">

        GTRI RH

    </div>

    <div class="contenido">

        @if($empleado->foto)

            <img
                src="{{ public_path(
                    'fotos_empleados/' .
                    $empleado->foto
                ) }}"
                class="foto"
            >

        @endif

        <div class="nombre">

            {{ $empleado->nombre }}

            {{ $empleado->apellido_paterno }}

        </div>

        <div class="control">

            {{ $empleado->numero_control }}

        </div>

        <div class="puesto">

            {{ $empleado->puesto }}

        </div>

        <div style="margin-top:5px; color:#666;">

            {{ $empleado->rango }}

        </div>

        <div class="estado">

            {{ strtoupper($empleado->estado) }}

        </div>

        <div
            style="
                margin-top:20px;
                font-size:11px;
                color:#666;
            "
        >

            GTRI S.A. DE C.V.

        </div>

    </div>

</div>

</body>

</html>
