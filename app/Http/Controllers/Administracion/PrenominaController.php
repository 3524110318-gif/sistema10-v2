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

            'periodo_inicio' =>
                'required|date',

            'periodo_fin' =>
                'required|date|after_or_equal:periodo_inicio',

            'estatus' =>
                'required|in:abierta,cerrada,autorizada',

            'observaciones' =>
                'nullable|string',

            'empleado_id' =>
                'required|array|min:1',

            'empleado_id.*' =>
                'required|exists:empleados,id',

            'salario_base.*' =>
                'required|numeric|min:0',

            'dias_laborados.*' =>
                'required|integer|min:0',

            'dias_incapacidad.*' =>
                'required|integer|min:0',

            'folio_imss.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'percepciones.*' =>
                'required|numeric|min:0',

            'deducciones.*' =>
                'required|numeric|min:0',

            'ajustes.*' =>
                'required|numeric',

            'horas_extra.*' =>
                'required|numeric|min:0',

            'justificacion.*' => [
                'nullable',
                'string',
            ],

        ]);

        foreach (
            $request->empleado_id
            as $i => $empleadoId
        ) {

            /*
            FOLIO IMSS OBLIGATORIO SI EXISTE INCAPACIDAD
            */

            if (
                ($request->dias_incapacidad[$i] ?? 0) > 0
                &&
                empty($request->folio_imss[$i])
            ) {

                return back()
                    ->withInput()
                    ->withErrors([

                        "folio_imss.$i" =>
                            'El folio IMSS es obligatorio cuando existen días de incapacidad.',

                    ]);
            }

            /*
            JUSTIFICACIÓN OBLIGATORIA SI EXISTE AJUSTE MANUAL
            */

            if (
                (float) ($request->ajustes[$i] ?? 0) != 0
                &&
                empty($request->justificacion[$i])
            ) {

                return back()
                    ->withInput()
                    ->withErrors([

                        "justificacion.$i" =>
                            'La justificación es obligatoria cuando se realiza un ajuste manual.',

                    ]);
            }

        }

        $prenomina = Prenomina::create([

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'estatus' => $request->estatus,

            'observaciones' => $request->observaciones,

        ]);

        foreach ($request->empleado_id as $i => $empleadoId) {

            $salario = (float) $request->salario_base[$i];

            $percepciones = (float) $request->percepciones[$i];

            $deducciones = (float) $request->deducciones[$i];

            $ajustes = (float) $request->ajustes[$i];

            $horasExtra = (float) $request->horas_extra[$i];

            $diasLaborados = (int) $request->dias_laborados[$i];

            $diasIncapacidad = (int) $request->dias_incapacidad[$i];


            /*
            |--------------------------------------------------------------------------
            | CÁLCULO DE SALARIO PAGABLE
            |--------------------------------------------------------------------------
            |
            | Los días con incapacidad IMSS se consideran en $0.
            |
            */

            $diasPagables = max(
                0,
                $diasLaborados - $diasIncapacidad
            );

            $salarioDiario = $diasLaborados > 0
                ? $salario / $diasLaborados
                : 0;

            $salarioPagable =
                $salarioDiario * $diasPagables;


            /*
            |--------------------------------------------------------------------------
            | TOTAL NETO
            |--------------------------------------------------------------------------
            */

            $total =
                $salarioPagable
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

                'salario_base' => $salarioPagable,

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

            'usuario' => Auth::user()->rol,

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

        foreach (
            $request->empleado_id
            as $i => $empleadoId
        ) {

            if (
                ($request->dias_incapacidad[$i] ?? 0) > 0
                &&
                empty($request->folio_imss[$i])
            ) {

                return back()
                    ->withInput()
                    ->withErrors([

                        "folio_imss.$i" =>
                            'El folio IMSS es obligatorio cuando existen días de incapacidad.',

                    ]);
            }

            if (
                (float) ($request->ajustes[$i] ?? 0) != 0
                &&
                empty($request->justificacion[$i])
            ) {

                return back()
                    ->withInput()
                    ->withErrors([

                        "justificacion.$i" =>
                            'La justificación es obligatoria cuando se realiza un ajuste manual.',

                    ]);
            }

        }

        $prenomina->update([

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'estatus' => $request->estatus,

            'observaciones' => $request->observaciones,

        ]);

        $prenomina->detalles()->delete();

        foreach ($request->empleado_id as $i => $empleadoId) {

            $salario = (float) $request->salario_base[$i];

            $percepciones = (float) $request->percepciones[$i];

            $deducciones = (float) $request->deducciones[$i];

            $ajustes = (float) $request->ajustes[$i];

            $horasExtra = (float) $request->horas_extra[$i];

            $diasLaborados = (int) $request->dias_laborados[$i];

            $diasIncapacidad = (int) $request->dias_incapacidad[$i];

            $diasPagables = max(
                0,
                $diasLaborados - $diasIncapacidad
            );

            $salarioDiario = $diasLaborados > 0
                ? $salario / $diasLaborados
                : 0;

            $salarioPagable =
                $salarioDiario * $diasPagables;

            $total =
                $salarioPagable
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

                'salario_base' => $salarioPagable,

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
