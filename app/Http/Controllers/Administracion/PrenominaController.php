<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\Prenomina;
use App\Models\Administracion\PrenominaDetalle;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Empleado;

class PrenominaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $prenominas = Prenomina::when(

            $buscar,

            function ($query) use ($buscar) {

                $query->where(

                    'estatus',

                    'like',

                    "%{$buscar}%"

                );

            }

        )

        ->latest()

        ->paginate(10);

        return view(

            'administracion.prenominas.index',

            compact(

                'prenominas',

                'buscar'

            )

        );
    }

    public function create()
    {
        $empleados = Empleado::where(

            'estado',

            'activo'

        )

        ->orderBy(

            'nombre'

        )

        ->get();

        return view(

            'administracion.prenominas.create',

            compact(

                'empleados'

            )

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'periodo_inicio' => 'required|date',

            'periodo_fin' => 'required|date|after_or_equal:periodo_inicio',

            'estatus' => 'required',

            'observaciones' => 'nullable|string',

            'empleado_id' => 'required|array',

            'empleado_id.*' => 'exists:empleados,id',

        ]);

        $prenomina = Prenomina::create([

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'estatus' => $request->estatus,

            'observaciones' => $request->observaciones,

        ]);

        foreach ($request->empleado_id as $i => $empleadoId) {

            $salario = $request->salario_base[$i];

            $percepciones = $request->percepciones[$i];

            $deducciones = $request->deducciones[$i];

            $ajustes = $request->ajustes[$i];

            $horasExtra = $request->horas_extra[$i];

            $total =

                $salario

                +

                $percepciones

                +

                $horasExtra

                +

                $ajustes

                -

                $deducciones;

            PrenominaDetalle::create([

                'prenomina_id' => $prenomina->id,

                'empleado_id' => $empleadoId,

                'salario_base' => $salario,

                'dias_laborados' => $request->dias_laborados[$i],

                'dias_incapacidad' => $request->dias_incapacidad[$i],

                'folio_imss' => $request->folio_imss[$i] ?: null,

                'percepciones' => $percepciones,

                'deducciones' => $deducciones,

                'ajustes' => $ajustes,

                'horas_extra' => $horasExtra,

                'justificacion' => $request->justificacion[$i] ?: null,

                'total_neto' => $total,

            ]);

        }

        LogActividad::create([

            'usuario' => Auth::user()->name,

            'accion' => 'Creó una prenómina',

        ]);

        return redirect()

            ->route(

                'administracion.prenominas.index'

            )

            ->with(

                'success',

                'Prenómina registrada correctamente.'

            );
    }

    public function edit(Prenomina $prenomina)
    {
        $prenomina->load(

            'detalles'

        );

        $empleados = Empleado::where(

            'estado',

            'activo'

        )

        ->orderBy(

            'nombre'

        )

        ->get();

        return view(

            'administracion.prenominas.edit',

            compact(

                'prenomina',

                'empleados'

            )

        );
    }

    public function update(Request $request,Prenomina $prenomina)
    {
        $request->validate([

            'periodo_inicio' => 'required|date',

            'periodo_fin' => 'required|date|after_or_equal:periodo_inicio',

            'estatus' => 'required',

            'observaciones' => 'nullable|string',

        ]);

        $prenomina->update([

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'estatus' => $request->estatus,

            'observaciones' => $request->observaciones,

        ]);

        $prenomina->detalles()->delete();

        foreach ($request->empleado_id as $i => $empleadoId) {

            $salario = $request->salario_base[$i];

            $percepciones = $request->percepciones[$i];

            $deducciones = $request->deducciones[$i];

            $ajustes = $request->ajustes[$i];

            $horasExtra = $request->horas_extra[$i];

            $total =

                $salario

                +

                $percepciones

                +

                $horasExtra

                +

                $ajustes

                -

                $deducciones;

            PrenominaDetalle::create([

                'prenomina_id' => $prenomina->id,

                'empleado_id' => $empleadoId,

                'salario_base' => $salario,

                'dias_laborados' => $request->dias_laborados[$i],

                'dias_incapacidad' => $request->dias_incapacidad[$i],

                'folio_imss' => $request->folio_imss[$i] ?: null,

                'percepciones' => $percepciones,

                'deducciones' => $deducciones,

                'ajustes' => $ajustes,

                'horas_extra' => $horasExtra,

                'justificacion' => $request->justificacion[$i] ?: null,

                'total_neto' => $total,

            ]);

        }

        LogActividad::create([

            'usuario' => Auth::user()->name,

            'accion' => 'Actualizó una prenómina',

        ]);

        return redirect()

            ->route(
                'administracion.prenominas.index'
            )

            ->with(
                'success',
                'Prenómina actualizada correctamente.'
            );
    }

    public function destroy(Prenomina $prenomina)
    {
        $prenomina->delete();

        LogActividad::create([

            'usuario' => Auth::user()->name,

            'accion' => 'Eliminó una prenómina',

        ]);

        return redirect()

            ->route(
                'administracion.prenominas.index'
            )

            ->with(
                'success',
                'Prenómina eliminada correctamente.'
            );
    }

}
