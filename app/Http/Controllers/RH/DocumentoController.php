<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Documento;
use App\Models\RH\Empleado;

class DocumentoController extends Controller
{
    public function store(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $documentoExistente = Documento::where('empleado_id',$empleado->id)
            ->where('nombre',$request->nombre)
            ->first();
        if ($documentoExistente) {

            $documentoExistente->update([
                'entregado' => true,
            ]);

        } else {

            Documento::create([
                'empleado_id' => $empleado->id,
                'nombre' => $request->nombre,
                'entregado' => true,
            ]);

        }

        return redirect()
            ->route('rh.empleados.show', $empleado->id)
            ->with('success','Documento marcado como entregado');
    }

    public function pendiente( Request $request, Empleado $empleado)
    {
        Documento::where(
            'empleado_id',
            $empleado->id
        )
        ->where(
            'nombre',
            $request->nombre
        )
        ->delete();

        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Documento marcado como pendiente'
            );
    }
}
