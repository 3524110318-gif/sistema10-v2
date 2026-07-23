<?php

namespace App\Http\Controllers\Repse;

use App\Http\Controllers\Controller;
use App\Models\RepseArchivo;
use Illuminate\Http\Request;

class RepseArchivoController extends Controller
{
    public function guardarArchivo(Request $request)
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'empleado_id' =>
                'nullable|exists:empleados,id',

            'periodo' =>
                'required|date_format:Y-m',

            'tipo' => [
                'required',
                'in:alta_imss,nomina_pdf,nomina_xml,constancia_sat,pago_sua',
            ],

            'archivo' =>
                'required|file|max:10240',

        ]);


        if (
            $request->tipo !== 'pago_sua' &&
            !$request->empleado_id
        ) {
            return back()
                ->withErrors([
                    'empleado_id' =>
                        'Debe seleccionar un empleado para este tipo de documento.'
                ])
                ->withInput();
        }


        $empleadoId =
            $request->tipo === 'pago_sua'
                ? null
                : $request->empleado_id;


        $archivoExistente = RepseArchivo::where(
            'cliente_id',
            $request->cliente_id
        )
        ->where(
            'periodo',
            $request->periodo
        )
        ->where(
            'tipo',
            $request->tipo
        )
        ->where(
            'empleado_id',
            $empleadoId
        )
        ->first();


        $archivo = $request
            ->file('archivo')
            ->store(
                'repse/mensual/' .
                $request->periodo,
                'public'
            );


        if ($archivoExistente) {

            $rutaAnterior = storage_path(
                'app/public/' .
                $archivoExistente->archivo
            );

            if (
                $archivoExistente->archivo &&
                file_exists($rutaAnterior)
            ) {
                unlink($rutaAnterior);
            }

            $archivoExistente->update([

                'archivo' => $archivo,

            ]);

        } else {

            RepseArchivo::create([

                'empleado_id' =>
                    $empleadoId,

                'cliente_id' =>
                    $request->cliente_id,

                'periodo' =>
                    $request->periodo,

                'tipo' =>
                    $request->tipo,

                'archivo' =>
                    $archivo,

            ]);

        }


        return redirect()
            ->route(
                'repse.generador.resultado',
                [
                    'cliente_id' =>
                        $request->cliente_id,

                    'mes' =>
                        $request->periodo,
                ]
            )
            ->with(
                'success',
                'Archivo REPSE guardado correctamente.'
            );
    }

    public function eliminarArchivo(RepseArchivo $archivo)
    {
        $rutaFisica = storage_path(
            'app/public/' .
            $archivo->archivo
        );

        if (
            $archivo->archivo &&
            file_exists($rutaFisica)
        ) {
            unlink($rutaFisica);
        }

        $clienteId = $archivo->cliente_id;

        $periodo = $archivo->periodo;

        $archivo->delete();

        return redirect()
            ->route(
                'repse.generador.resultado',
                [
                    'cliente_id' => $clienteId,
                    'mes' => $periodo,
                ]
            )
            ->with(
                'success',
                'Archivo eliminado correctamente.'
            );
    }
}