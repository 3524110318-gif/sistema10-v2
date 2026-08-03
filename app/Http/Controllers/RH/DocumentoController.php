<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Documento;
use App\Models\RH\Empleado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Services\ActividadService;

class DocumentoController extends Controller
{
    /**
     * Marcar documento como entregado.
     */
    public function store(
        Request $request,
        Empleado $empleado
    ): JsonResponse|RedirectResponse {

        $datos = $this->validarDocumento(
            $request
        );

        $documentoExistente = Documento::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'nombre',
                $datos['nombre']
            )
            ->first();

        if (
            $documentoExistente
            && $documentoExistente->entregado
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => true,
                    'message' =>
                        'El documento ya estaba marcado como entregado.',
                ]);

            }

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'info',
                    'El documento ya estaba marcado como entregado.'
                );
        }

        DB::transaction(function () use (
            $datos,
            $empleado
        ) {

            Documento::updateOrCreate(
                [
                    'empleado_id' =>
                        $empleado->id,

                    'nombre' =>
                        $datos['nombre'],
                ],
                [
                    'entregado' => true,
                ]
            );

            ActividadService::registrar(

                'Marcó como entregado el documento "'
                . $datos['nombre']
                . '" del empleado '
                . $empleado->numero_control,

                null,

                [

                    'empleado_id' =>
                        $empleado->id,

                    'numero_control' =>
                        $empleado->numero_control,

                    'documento' =>
                        $datos['nombre'],

                    'estado' =>
                        'entregado',

                ]

            );

        });

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Documento marcado como entregado.',
            ]);

        }

        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Documento marcado como entregado.'
            );
    }

    /**
     * Marcar documento como pendiente.
     */
    public function pendiente(
        Request $request,
        Empleado $empleado
    ): JsonResponse|RedirectResponse {

        $datos = $this->validarDocumento(
            $request
        );

        $documento = Documento::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'nombre',
                $datos['nombre']
            )
            ->first();

        if (! $documento) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => true,
                    'message' =>
                        'El documento ya estaba marcado como pendiente.',
                ]);

            }

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'info',
                    'El documento ya estaba marcado como pendiente.'
                );
        }

        DB::transaction(function () use (
            $documento,
            $datos,
            $empleado
        ) {

            $documento->delete();

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Marcó como pendiente el documento "' .
                    $datos['nombre'] .
                    '" del empleado ' .
                    $empleado->numero_control,
            ]);

        });

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' =>
                    'Documento marcado como pendiente.',
            ]);

        }

        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Documento marcado como pendiente.'
            );
    }

    /**
     * Validar documento autorizado para RH.
     */
    private function validarDocumento(
        Request $request
    ): array {

        return $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    Rule::in(
                        Empleado::DOCUMENTOS_RH
                    ),
                ],
            ],
            [
                'nombre.required' =>
                    'Debes seleccionar un documento.',

                'nombre.string' =>
                    'El nombre del documento no es válido.',

                'nombre.in' =>
                    'El documento seleccionado no pertenece al expediente autorizado de RH.',
            ]
        );
    }
}