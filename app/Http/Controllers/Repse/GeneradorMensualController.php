<?php

namespace App\Http\Controllers\Repse;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Cliente;
use Illuminate\Http\Request;
use App\Models\Operaciones\Asignacion;
use App\Models\Administracion\Prenomina;
use Carbon\Carbon;
use ZipArchive;
use App\Models\RepseArchivo;

class GeneradorMensualController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy(
            'razon_social'
        )->get();

        return view(
            'repse.generador.index',
            compact('clientes')
        );
    }

    public function generar(Request $request)
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'mes' =>
                'required|date_format:Y-m',

        ]);

        $datos = $this->obtenerDatosGenerador(
            $request->cliente_id,
            $request->mes
        );

        return view(
            'repse.generador.resultado',
            $datos
        );
    }

    public function descargar(Request $request)
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'mes' =>
                'required|date_format:Y-m',

        ]);


        /*
        |--------------------------------------------------------------------------
        | PERIODO
        |--------------------------------------------------------------------------
        */

        $inicioMes = Carbon::createFromFormat(
            'Y-m',
            $request->mes
        )->startOfMonth();

        $finMes = $inicioMes
            ->copy()
            ->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | CLIENTE
        |--------------------------------------------------------------------------
        */

        $cliente = Cliente::findOrFail(
            $request->cliente_id
        );


        /*
        |--------------------------------------------------------------------------
        | ARCHIVOS REPSE DEL CLIENTE Y PERIODO
        |--------------------------------------------------------------------------
        */

        $archivosRepse = RepseArchivo::where(
            'cliente_id',
            $request->cliente_id
        )
        ->where(
            'periodo',
            $request->mes
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | ASIGNACIONES DEL CLIENTE EN EL PERIODO
        |--------------------------------------------------------------------------
        */

        $asignaciones = Asignacion::with([

            'empleado.repse',

            'plaza.servicio.contrato.cliente',

        ])
        ->whereHas(
            'plaza.servicio.contrato',
            function ($query) use ($request) {

                $query->where(
                    'cliente_id',
                    $request->cliente_id
                );

            }
        )
        ->whereDate(
            'fecha_inicio',
            '<=',
            $finMes
        )
        ->where(
            function ($query) use ($inicioMes) {

                $query
                    ->whereNull('fecha_fin')
                    ->orWhereDate(
                        'fecha_fin',
                        '>=',
                        $inicioMes
                    );

            }
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | EMPLEADOS ÚNICOS
        |--------------------------------------------------------------------------
        */

        $empleados = $asignaciones
            ->pluck('empleado')
            ->filter()
            ->unique('id')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PRENÓMINAS DEL PERIODO
        |--------------------------------------------------------------------------
        */

        $prenominas = Prenomina::with(
            'detalles.empleado'
        )
        ->whereDate(
            'periodo_inicio',
            '<=',
            $finMes
        )
        ->whereDate(
            'periodo_fin',
            '>=',
            $inicioMes
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | NOMBRE DEL ZIP
        |--------------------------------------------------------------------------
        */

        $nombreSeguroCliente = preg_replace(
            '/[^A-Za-z0-9_-]/',
            '_',
            $cliente->razon_social
        );

        $nombreZip =
            'REPSE_' .
            $nombreSeguroCliente .
            '_' .
            $request->mes .
            '.zip';


        /*
        |--------------------------------------------------------------------------
        | CARPETA TEMPORAL
        |--------------------------------------------------------------------------
        */

        $carpetaTemporal = storage_path(
            'app/temp_repse_' . uniqid()
        );

        if (!is_dir($carpetaTemporal)) {

            mkdir(
                $carpetaTemporal,
                0775,
                true
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CREAR CSV DE CONTROL
        |--------------------------------------------------------------------------
        */

        $rutaCsv =
            $carpetaTemporal .
            '/control_repse.csv';

        $archivoCsv = fopen(
            $rutaCsv,
            'w'
        );


        fputcsv(
            $archivoCsv,
            [
                'No. Control',
                'Empleado',
                'REPSE',
                'Alta IMSS cargada',
                'Nómina PDF cargada',
                'Nómina XML cargada',
                'Constancia SAT cargada',
                'Pago SUA cargado',
                'Prenómina en sistema',
                'Cédula SSP',
                'RFC Validado',
                'Paquete',
                'Faltantes',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | LLENAR CSV
        |--------------------------------------------------------------------------
        */

        foreach ($empleados as $empleado) {

            $repse =
                $empleado->repse;


            /*
            | PRENÓMINA
            */

            $tienePrenomina =
                $prenominas->contains(
                    function ($prenomina) use ($empleado) {

                        return $prenomina
                            ->detalles
                            ->contains(
                                'empleado_id',
                                $empleado->id
                            );

                    }
                );


            /*
            | RFC VALIDADO
            */

            $rfcValidado =
                $repse &&
                $repse->rfc_constancia &&
                strtoupper(
                    trim(
                        $repse->rfc_constancia
                    )
                ) ===
                strtoupper(
                    trim(
                        $empleado->rfc
                    )
                );


            /*
            | FALTANTES
            */

            $faltantes = [];


            if (
                !$repse ||
                !$repse->alta_imss
            ) {

                $faltantes[] =
                    'Alta IMSS';

            }


            if (!$tienePrenomina) {

                $faltantes[] =
                    'Prenómina';

            }


            if (
                !$repse ||
                !$repse->constancia_fiscal
            ) {

                $faltantes[] =
                    'Constancia SAT';

            }


            if (!$rfcValidado) {

                $faltantes[] =
                    'RFC no validado';

            }


            if (
                !$repse ||
                !$repse->cedula_ssp ||
                !in_array(
                    $repse->estadoVigenciaCedula(),
                    [
                        'vigente',
                        'por_vencer',
                    ]
                )
            ) {

                $faltantes[] =
                    'Cédula SSP no válida';

            }


            $paqueteListo =
                count($faltantes) === 0;


            /*
            | FILA CSV
            */

            $archivosEmpleado =
                $archivosRepse->where(
                    'empleado_id',
                    $empleado->id
                );

            $altaImssCargada =
                $archivosEmpleado
                    ->where(
                        'tipo',
                        'alta_imss'
                    )
                    ->isNotEmpty();

            $nominaPdfCargada =
                $archivosEmpleado
                    ->where(
                        'tipo',
                        'nomina_pdf'
                    )
                    ->isNotEmpty();

            $nominaXmlCargada =
                $archivosEmpleado
                    ->where(
                        'tipo',
                        'nomina_xml'
                    )
                    ->isNotEmpty();

            $constanciaSatCargada =
                $archivosEmpleado
                    ->where(
                        'tipo',
                        'constancia_sat'
                    )
                    ->isNotEmpty();

            $pagoSuaCargado =
                $archivosRepse
                    ->where(
                        'tipo',
                        'pago_sua'
                    )
                    ->isNotEmpty();


            $faltantes = [];

            if (!$altaImssCargada) {
                $faltantes[] = 'Alta IMSS';
            }

            if (!$nominaPdfCargada) {
                $faltantes[] = 'Nómina PDF';
            }

            if (!$nominaXmlCargada) {
                $faltantes[] = 'Nómina XML';
            }

            if (!$constanciaSatCargada) {
                $faltantes[] = 'Constancia SAT';
            }

            if (!$pagoSuaCargado) {
                $faltantes[] = 'Pago SUA';
            }

            if (!$tienePrenomina) {
                $faltantes[] = 'Prenómina no disponible en sistema';
            }

            if (!$rfcValidado) {
                $faltantes[] = 'RFC no validado';
            }

            if (
                !$repse ||
                !$repse->cedula_ssp ||
                !in_array(
                    $repse->estadoVigenciaCedula(),
                    [
                        'vigente',
                        'por_vencer',
                    ]
                )
            ) {
                $faltantes[] = 'Cédula SSP no válida';
            }


            $paqueteListo =
                count($faltantes) === 0;


            fputcsv(
                $archivoCsv,
                [

                    $empleado->numero_control,

                    trim(
                        $empleado->nombre .
                        ' ' .
                        $empleado->apellido_paterno .
                        ' ' .
                        $empleado->apellido_materno
                    ),

                    $repse &&
                    $repse->cumpleRequisitos()
                        ? 'Cumple'
                        : 'Bloqueado',

                    $altaImssCargada
                        ? 'Sí'
                        : 'No',

                    $nominaPdfCargada
                        ? 'Sí'
                        : 'No',

                    $nominaXmlCargada
                        ? 'Sí'
                        : 'No',

                    $constanciaSatCargada
                        ? 'Sí'
                        : 'No',

                    $pagoSuaCargado
                        ? 'Sí'
                        : 'No',

                    $tienePrenomina
                        ? 'Disponible'
                        : 'No disponible',

                    $repse &&
                    $repse->cedula_ssp
                        ? $repse->estadoVigenciaCedula()
                        : 'No entregada',

                    $rfcValidado
                        ? 'Sí'
                        : 'No',

                    $paqueteListo
                        ? 'Completo'
                        : 'Incompleto',

                    implode(
                        ', ',
                        $faltantes
                    ),

                ]
            );

        }


        fclose(
            $archivoCsv
        );


        /*
        |--------------------------------------------------------------------------
        | CREAR ZIP
        |--------------------------------------------------------------------------
        */

        $rutaZip =
            $carpetaTemporal .
            '/' .
            $nombreZip;

        $zip =
            new ZipArchive();


        $resultado = $zip->open(

            $rutaZip,

            ZipArchive::CREATE |
            ZipArchive::OVERWRITE

        );


        if ($resultado !== true) {

            return back()->with(
                'error',
                'No fue posible crear el archivo ZIP.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AGREGAR CSV
        |--------------------------------------------------------------------------
        */

        $zip->addFile(

            $rutaCsv,

            'control_repse.csv'

        );


        /*
        |--------------------------------------------------------------------------
        | CARPETA SUA
        |--------------------------------------------------------------------------
        */

        $zip->addEmptyDir(
            'SUA'
        );


        /*
        |--------------------------------------------------------------------------
        | EMPLEADOS Y SUS ARCHIVOS
        |--------------------------------------------------------------------------
        */

        foreach ($empleados as $empleado) {


            /*
            | NOMBRE DE CARPETA
            */

            $nombreEmpleado =
                preg_replace(
                    '/[^A-Za-z0-9_-]/',
                    '_',
                    trim(
                        $empleado->numero_control .
                        '_' .
                        $empleado->nombre .
                        '_' .
                        $empleado->apellido_paterno
                    )
                );


            $carpetaEmpleado =

                'empleados/' .

                $nombreEmpleado .

                '/';


            /*
            | CREAR CARPETAS
            */

            $zip->addEmptyDir(
                $carpetaEmpleado
            );

            $zip->addEmptyDir(
                $carpetaEmpleado .
                'IMSS'
            );

            $zip->addEmptyDir(
                $carpetaEmpleado .
                'NOMINA'
            );

            $zip->addEmptyDir(
                $carpetaEmpleado .
                'SAT'
            );


            /*
            |--------------------------------------------------------------------------
            | ARCHIVOS DEL EMPLEADO
            |--------------------------------------------------------------------------
            */

            $archivosEmpleado =
                $archivosRepse->where(
                    'empleado_id',
                    $empleado->id
                );


            foreach (
                $archivosEmpleado
                as $archivoRepse
            ) {

                $rutaFisica =
                    storage_path(
                        'app/public/' .
                        $archivoRepse->archivo
                    );


                if (
                    !file_exists(
                        $rutaFisica
                    )
                ) {

                    continue;

                }


                $nombreArchivo =
                    basename(
                        $archivoRepse->archivo
                    );


                switch (
                    $archivoRepse->tipo
                ) {


                    /*
                    | ALTA IMSS
                    */

                    case 'alta_imss':

                        $zip->addFile(

                            $rutaFisica,

                            $carpetaEmpleado .
                            'IMSS/' .
                            $nombreArchivo

                        );

                        break;


                    /*
                    | NÓMINA
                    */

                    case 'nomina_pdf':

                    case 'nomina_xml':

                        $zip->addFile(

                            $rutaFisica,

                            $carpetaEmpleado .
                            'NOMINA/' .
                            $nombreArchivo

                        );

                        break;


                    /*
                    | CONSTANCIA SAT
                    */

                    case 'constancia_sat':

                        $zip->addFile(

                            $rutaFisica,

                            $carpetaEmpleado .
                            'SAT/' .
                            $nombreArchivo

                        );

                        break;

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | ARCHIVOS SUA
        |--------------------------------------------------------------------------
        */

        $archivosSua =
            $archivosRepse->where(
                'tipo',
                'pago_sua'
            );


        foreach (
            $archivosSua
            as $archivoSua
        ) {

            $rutaFisica =
                storage_path(
                    'app/public/' .
                    $archivoSua->archivo
                );


            if (
                !file_exists(
                    $rutaFisica
                )
            ) {

                continue;

            }


            $zip->addFile(

                $rutaFisica,

                'SUA/' .
                basename(
                    $archivoSua->archivo
                )

            );

        }


        /*
        |--------------------------------------------------------------------------
        | CERRAR ZIP
        |--------------------------------------------------------------------------
        */

        $zip->close();


        /*
        |--------------------------------------------------------------------------
        | DESCARGAR ZIP
        |--------------------------------------------------------------------------
        */

        return response()
            ->download(
                $rutaZip,
                $nombreZip
            )
            ->deleteFileAfterSend(
                true
            );
    }

    public function resultado(Request $request)
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'mes' =>
                'required|date_format:Y-m',

        ]);

        $datos = $this->obtenerDatosGenerador(
            $request->cliente_id,
            $request->mes
        );

        return view(
            'repse.generador.resultado',
            $datos
        );
    }

    private function obtenerDatosGenerador(int $clienteId, string $mes): array
    {
        $inicioMes = Carbon::createFromFormat(
            'Y-m',
            $mes
        )->startOfMonth();

        $finMes = $inicioMes
            ->copy()
            ->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | CLIENTE
        |--------------------------------------------------------------------------
        */

        $cliente = Cliente::findOrFail(
            $clienteId
        );


        /*
        |--------------------------------------------------------------------------
        | ARCHIVOS REPSE
        |--------------------------------------------------------------------------
        */

        $archivosRepse = RepseArchivo::where(
            'cliente_id',
            $clienteId
        )
        ->where(
            'periodo',
            $mes
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | ASIGNACIONES DEL PERIODO
        |--------------------------------------------------------------------------
        */

        $asignaciones = Asignacion::with([
            'empleado.repse',
            'plaza.servicio.contrato.cliente',
        ])
        ->whereHas(
            'plaza.servicio.contrato',
            function ($query) use ($clienteId) {

                $query->where(
                    'cliente_id',
                    $clienteId
                );

            }
        )
        ->whereDate(
            'fecha_inicio',
            '<=',
            $finMes
        )
        ->where(function ($query) use ($inicioMes) {

            $query
                ->whereNull('fecha_fin')
                ->orWhereDate(
                    'fecha_fin',
                    '>=',
                    $inicioMes
                );

        })
        ->get();


        /*
        |--------------------------------------------------------------------------
        | EMPLEADOS
        |--------------------------------------------------------------------------
        */

        $empleados = $asignaciones
            ->pluck('empleado')
            ->filter()
            ->unique('id')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PRENÓMINAS
        |--------------------------------------------------------------------------
        */

        $prenominas = Prenomina::with(
            'detalles.empleado'
        )
        ->whereDate(
            'periodo_inicio',
            '<=',
            $finMes
        )
        ->whereDate(
            'periodo_fin',
            '>=',
            $inicioMes
        )
        ->get();


        /*
        |--------------------------------------------------------------------------
        | PREPARAR DATOS DE CADA EMPLEADO
        |--------------------------------------------------------------------------
        */

        $empleados->each(
            function ($empleado) use (
                $prenominas,
                $archivosRepse
            ) {

                /*
                | PRENÓMINA
                */

                $empleado->tiene_prenomina =
                    $prenominas->contains(
                        function ($prenomina) use ($empleado) {

                            return $prenomina
                                ->detalles
                                ->contains(
                                    'empleado_id',
                                    $empleado->id
                                );

                        }
                    );


                /*
                | DOCUMENTACIÓN REPSE
                */

                $empleado->documentacion_repse = [

                    'alta_imss' =>
                        (bool) optional(
                            $empleado->repse
                        )->alta_imss,

                    'constancia_sat' =>
                        (bool) optional(
                            $empleado->repse
                        )->constancia_fiscal,

                    'rfc_validado' =>
                        $empleado->repse &&
                        $empleado->repse->rfc_constancia &&
                        strtoupper(
                            trim(
                                $empleado
                                    ->repse
                                    ->rfc_constancia
                            )
                        ) ===
                        strtoupper(
                            trim(
                                $empleado->rfc
                            )
                        ),

                ];


                /*
                | ARCHIVOS MENSUALES REALES
                */

                $archivosEmpleado =
                    $archivosRepse->where(
                        'empleado_id',
                        $empleado->id
                    );

                $empleado->archivos_mensuales = [

                    'alta_imss' =>
                        $archivosEmpleado
                            ->where(
                                'tipo',
                                'alta_imss'
                            )
                            ->isNotEmpty(),

                    'nomina_pdf' =>
                        $archivosEmpleado
                            ->where(
                                'tipo',
                                'nomina_pdf'
                            )
                            ->isNotEmpty(),

                    'nomina_xml' =>
                        $archivosEmpleado
                            ->where(
                                'tipo',
                                'nomina_xml'
                            )
                            ->isNotEmpty(),

                    'constancia_sat' =>
                        $archivosEmpleado
                            ->where(
                                'tipo',
                                'constancia_sat'
                            )
                            ->isNotEmpty(),

                ];


                /*
                | FALTANTES
                */

                $faltantes = [];


                /*
                |--------------------------------------------------------------------------
                | ARCHIVOS REALES OBLIGATORIOS POR EMPLEADO
                |--------------------------------------------------------------------------
                */

                if (
                    !$empleado
                        ->archivos_mensuales['alta_imss']
                ) {
                    $faltantes[] =
                        'Alta IMSS';
                }

                if (
                    !$empleado
                        ->archivos_mensuales['nomina_pdf']
                ) {
                    $faltantes[] =
                        'Nómina PDF';
                }

                if (
                    !$empleado
                        ->archivos_mensuales['nomina_xml']
                ) {
                    $faltantes[] =
                        'Nómina XML';
                }

                if (
                    !$empleado
                        ->archivos_mensuales['constancia_sat']
                ) {
                    $faltantes[] =
                        'Constancia SAT';
                }


                /*
                |--------------------------------------------------------------------------
                | VALIDACIONES REPSE
                |--------------------------------------------------------------------------
                */

                if (
                    !$empleado->tiene_prenomina
                ) {
                    $faltantes[] =
                        'Prenómina no disponible en sistema';
                }

                if (
                    !$empleado
                        ->documentacion_repse['rfc_validado']
                ) {
                    $faltantes[] =
                        'RFC de Constancia Fiscal no validado';
                }


                $empleado->faltantes_paquete_repse =
                    $faltantes;

                $empleado->paquete_repse_listo =
                    count($faltantes) === 0;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | PAGO SUA GENERAL
        |--------------------------------------------------------------------------
        */

        $tienePagoSua = $archivosRepse
            ->where(
                'tipo',
                'pago_sua'
            )
            ->isNotEmpty();

        $hayGuardias =
            $empleados->isNotEmpty();


        $paqueteGeneralListo =
            $hayGuardias &&
            $tienePagoSua &&
            $empleados->every(
                function ($empleado) {

                    return
                        $empleado->paquete_repse_listo;

                }
            );


        return compact(
            'cliente',
            'empleados',
            'prenominas',
            'archivosRepse',
            'inicioMes',
            'finMes',
            'tienePagoSua',
            'hayGuardias',
            'paqueteGeneralListo'
        );
    }
}