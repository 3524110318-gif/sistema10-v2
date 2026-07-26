<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\RepseArchivo;
use App\Models\RH\Empleado;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Illuminate\Support\Facades\Auth;
use App\Models\Operaciones\Cliente;

class CarpetaFlashController extends Controller
{
    public function index()
    {
        $query = RepseArchivo::with([
            'empleado',
            'cliente',
        ])
            ->where(function ($query) {

                $query
                    ->whereNull('empleado_id')
                    ->orWhereHas(
                        'empleado',
                        function ($empleado) {

                            $empleado->where(
                                'estado',
                                'activo'
                            );

                        }
                    );

            });


        if (request()->filled('cliente_id')) {

            $query->where(
                'cliente_id',
                request('cliente_id')
            );

        }


        if (request()->filled('periodo')) {

            $query->where(
                'periodo',
                request('periodo')
            );

        }


        $archivos = $query->get();


        $archivosDisponibles = $archivos
            ->filter(function ($archivo) {

                return $archivo->archivo &&
                    File::exists(
                        storage_path(
                            'app/public/' .
                            $archivo->archivo
                        )
                    );

            });


        $totalArchivos =
            $archivosDisponibles->count();


        $totalEmpleados =
            $archivosDisponibles
                ->whereNotNull('empleado_id')
                ->pluck('empleado_id')
                ->unique()
                ->count();


        $totalClientes =
            $archivosDisponibles
                ->pluck('cliente_id')
                ->unique()
                ->count();


        $totalPeriodos =
            $archivosDisponibles
                ->pluck('periodo')
                ->unique()
                ->count();


        $clientes = Cliente::orderBy(
            'razon_social'
        )->get();


        $periodos = RepseArchivo::select(
                'periodo'
            )
            ->distinct()
            ->orderByDesc('periodo')
            ->pluck('periodo');

        $documentos = $archivosDisponibles
            ->sortBy([
                'cliente.razon_social',
                'periodo',
                'empleado.nombre',
                'tipo',
            ]);

        return view(
            'gerencia.carpeta-flash.index',
            compact(
                'totalArchivos',
                'totalEmpleados',
                'totalClientes',
                'totalPeriodos',
                'clientes',
                'periodos',
                'documentos'
            )
        );
    }

    public function descargar()
    {
        $archivos = RepseArchivo::with([
            'empleado',
            'cliente',
        ])
            ->where(function ($query) {

                $query
                    ->whereNull('empleado_id')
                    ->orWhereHas(
                        'empleado',
                        function ($empleado) {

                            $empleado->where(
                                'estado',
                                'activo'
                            );

                        }
                    );

            })
            ->get();

        $directorioTemporal = storage_path(
            'app/temp'
        );

        if (!File::exists($directorioTemporal)) {

            File::makeDirectory(
                $directorioTemporal,
                0755,
                true
            );

        }

        $nombreZip =
            'carpeta_inspeccion_flash_' .
            now()->format('Y_m_d_His') .
            '.zip';

        $rutaZip =
            $directorioTemporal .
            DIRECTORY_SEPARATOR .
            $nombreZip;

        $zip = new ZipArchive();

        if (
            $zip->open(
                $rutaZip,
                ZipArchive::CREATE |
                ZipArchive::OVERWRITE
            ) !== true
        ) {

            return redirect()
                ->route(
                    'gerencia.carpeta-flash.index'
                )
                ->with(
                    'error',
                    'No fue posible crear la carpeta de inspección.'
                );

        }

        $totalAgregados = 0;

        $usuario =
            Auth::user()?->name
            ?? 'Usuario no identificado';

        $contenidoInformativo =
            "CARPETA DE INSPECCIÓN FLASH\n" .
            "GTRI\n\n" .
            "Fecha de generación: " .
            now()->format('d/m/Y H:i:s') .
            "\n" .
            "Generada por: " .
            $usuario .
            "\n\n" .
            "Esta carpeta contiene la documentación REPSE " .
            "disponible del personal activo.\n" .
            "Los archivos están organizados por cliente, " .
            "periodo y empleado.\n";

        $zip->addFromString(
            'LEEME.txt',
            $contenidoInformativo
        );

        foreach ($archivos as $archivo) {

            if (!$archivo->archivo) {
                continue;
            }

            $rutaFisica = storage_path(
                'app/public/' .
                $archivo->archivo
            );

            if (!File::exists($rutaFisica)) {
                continue;
            }

            $cliente = $this->limpiarNombre(
                $archivo->cliente->razon_social
                    ?? 'Cliente_' .
                    $archivo->cliente_id
            );

            $periodo = $this->limpiarNombre(
                $archivo->periodo
                    ?? 'Sin_periodo'
            );

            if ($archivo->empleado) {

                $nombreEmpleado = trim(
                    $archivo->empleado->nombre .
                    ' ' .
                    ($archivo->empleado
                        ->apellido_paterno ?? '') .
                    ' ' .
                    ($archivo->empleado
                        ->apellido_materno ?? '')
                );

                $empleado = $this->limpiarNombre(
                    $nombreEmpleado
                );

            } else {

                $empleado = 'Documentos_generales';

            }

            $tipoDocumento =
                $this->nombreDocumento(
                    $archivo->tipo
                );

            $extension = File::extension(
                $rutaFisica
            );

            if ($archivo->empleado) {

                $nombreBaseArchivo =
                    $periodo .
                    '_' .
                    $empleado .
                    '_' .
                    $tipoDocumento;

            } else {

                $nombreBaseArchivo =
                    $periodo .
                    '_' .
                    $cliente .
                    '_' .
                    $tipoDocumento;

            }

            $nombreArchivo =
                $nombreBaseArchivo .
                '_' .
                $archivo->id;

            if ($extension) {

                $nombreArchivo .=
                    '.' .
                    strtolower($extension);

            }

            $rutaDentroDelZip =
                $cliente .
                '/' .
                $periodo .
                '/' .
                $empleado .
                '/' .
                $nombreArchivo;

            $contador = 1;

            while ($zip->locateName($rutaDentroDelZip) !== false) {

                $nombreSinExtension = pathinfo(
                    $nombreArchivo,
                    PATHINFO_FILENAME
                );

                $extensionArchivo = pathinfo(
                    $nombreArchivo,
                    PATHINFO_EXTENSION
                );

                $nombreAlternativo =
                    $nombreSinExtension .
                    '_' .
                    $contador;

                if ($extensionArchivo) {

                    $nombreAlternativo .=
                        '.' .
                        $extensionArchivo;

                }

                $rutaDentroDelZip =
                    $cliente .
                    '/' .
                    $periodo .
                    '/' .
                    $empleado .
                    '/' .
                    $nombreAlternativo;

                $contador++;
            }

            $zip->addFile(
                $rutaFisica,
                $rutaDentroDelZip
            );

            $totalAgregados++;
        }

        $zip->close();

        if ($totalAgregados === 0) {

            if (File::exists($rutaZip)) {

                File::delete($rutaZip);

            }

            return redirect()
                ->route(
                    'gerencia.carpeta-flash.index'
                )
                ->with(
                    'error',
                    'No existen archivos disponibles del personal activo para descargar.'
                );

        }

        return response()
            ->download(
                $rutaZip,
                $nombreZip
            )
            ->deleteFileAfterSend(true);
    }

    private function limpiarNombre(?string $nombre): string 
    {

        $nombre = trim(
            $nombre ?: 'Sin_nombre'
        );

        $nombre = preg_replace(
            '/[\/\\\\:*?"<>|]/',
            '',
            $nombre
        );

        $nombre = preg_replace(
            '/\s+/',
            '_',
            $nombre
        );

        return $nombre ?: 'Sin_nombre';
    }

    private function nombreDocumento(string $tipo): string 
    {

        return match ($tipo) {

            'alta_imss' =>
                'Alta IMSS',

            'nomina_pdf' =>
                'Nómina PDF',

            'nomina_xml' =>
                'Nómina XML',

            'constancia_sat' =>
                'Constancia SAT',

            'pago_sua' =>
                'Pago SUA',

            default =>
                ucfirst(
                    str_replace(
                        '_',
                        ' ',
                        $tipo
                    )
                ),

        };

    }
}