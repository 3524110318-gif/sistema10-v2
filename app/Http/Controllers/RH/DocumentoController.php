<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Documento;
use App\Models\RH\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DocumentoController extends Controller
{
    public function store(
        Request $request,
        Empleado $empleado
    ) {
        $datos = $this->validarDocumento($request);

        DB::transaction(function () use (
            $datos,
            $empleado
        ) {

            Documento::updateOrCreate(
                [
                    'empleado_id' => $empleado->id,
                    'nombre' => $datos['nombre'],
                ],
                [
                    'entregado' => true,
                ]
            );

            LogActividad::create([
                'usuario' => Auth::user()->rol,
                'accion' =>
                    'Marcó como entregado el documento "' .
                    $datos['nombre'] .
                    '" del empleado ' .
                    $empleado->numero_control,
            ]);

        });

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

    public function pendiente(
        Request $request,
        Empleado $empleado
    ) {
        $datos = $this->validarDocumento($request);

        DB::transaction(function () use (
            $datos,
            $empleado
        ) {

            Documento::where(
                'empleado_id',
                $empleado->id
            )
                ->where(
                    'nombre',
                    $datos['nombre']
                )
                ->delete();

            LogActividad::create([
                'usuario' => Auth::user()->rol,
                'accion' =>
                    'Marcó como pendiente el documento "' .
                    $datos['nombre'] .
                    '" del empleado ' .
                    $empleado->numero_control,
            ]);

        });

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