<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operaciones\Supervision;
use App\Models\Operaciones\Asignacion;
use Illuminate\Support\Facades\Storage;

class SupervisionController extends Controller
{
    public function index()
    {
        $supervisiones = Supervision::with([
            'asignacion.plaza.servicio',
            'asignacion.empleado',
            'incidencia'
        ])->latest()->get();

        return view(
            'operaciones.supervisiones.index',
            compact('supervisiones')
        );
    }

    public function create()
    {
        $asignaciones = Asignacion::with([
            'plaza.servicio',
            'empleado'
        ])
        ->where('estado', 'activa')
        ->get();

        return view(
            'operaciones.supervisiones.create',
            compact('asignaciones')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'asignacion_id' =>
                'required|exists:asignacions,id',

            'fecha_supervision' =>
                'required|date|before_or_equal:today',

            'resultado' =>
                'required|in:correcto,incidencia,ausente',

            'observaciones' =>
                'nullable|string|max:1000',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ],[

            'asignacion_id.required' =>
                'Seleccione una asignación.',

            'asignacion_id.exists' =>
                'La asignación seleccionada no existe.',

            'fecha_supervision.required' =>
                'Seleccione una fecha.',

            'fecha_supervision.before_or_equal' =>
                'La fecha de supervisión no puede ser futura.',

            'resultado.required' =>
                'Seleccione un resultado.',

            'resultado.in' =>
                'Seleccione un resultado válido.',

        ]);

        if (
            $request->resultado != 'correcto'
        )
        {
            $request->validate([

                'observaciones' =>
                    'required',

            ],[

                'observaciones.required' =>
                    'Debe escribir las observaciones cuando el resultado sea Incidencia o Ausente.',

            ]);
        }

        $existe = Supervision::where(
            'asignacion_id',
            $request->asignacion_id
        )
        ->where(
            'fecha_supervision',
            $request->fecha_supervision
        )
        ->exists();

        if ($existe)
        {
            return back()
                ->withErrors([

                    'asignacion_id' =>
                        'Esta asignación ya fue supervisada en esa fecha.'

                ])
                ->withInput();
        }

        $foto = null;

        if ($request->hasFile('foto'))
        {
            $foto = $request
                ->file('foto')
                ->store(
                    'supervisiones',
                    'public'
                );
        }

        Supervision::create([

            'asignacion_id' =>
                $request->asignacion_id,

            'fecha_supervision' =>
                $request->fecha_supervision,

            'resultado' =>
                $request->resultado,

            'observaciones' =>
                $request->observaciones,

            'foto' =>
                $foto,

        ]);

        return redirect()
            ->route(
                'operaciones.supervisiones.index'
            )
            ->with(
                'success',
                'Supervisión registrada correctamente.'
            );
    }

    public function show(Supervision $supervision)
    {
        $supervision->load([
            'asignacion.empleado',
            'asignacion.plaza.servicio',
            'incidencia',
            'evidencias',
        ]);

        return view(
            'operaciones.supervisiones.show',
            compact('supervision')
        );
    }

    public function edit(Supervision $supervision)
    {
        $asignaciones = Asignacion::with([
            'plaza.servicio',
            'empleado'
        ])->get();

        return view(
            'operaciones.supervisiones.edit',
            compact(
                'supervision',
                'asignaciones'
            )
        );
    }

    public function update(Request $request,Supervision $supervision)
    {
        $request->validate([

            'asignacion_id' =>
                'required|exists:asignacions,id',

            'fecha_supervision' =>
                'required|date|before_or_equal:today',

            'resultado' =>
                'required|in:correcto,incidencia,ausente',

            'observaciones' =>
                'nullable|string|max:1000',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ],[

            'fecha_supervision.before_or_equal' =>
                'La fecha de supervisión no puede ser futura.',

        ]);

        if ($request->resultado != 'correcto')
        {
            $request->validate([

                'observaciones' =>
                    'required',

            ],[

                'observaciones.required' =>
                    'Debe escribir las observaciones cuando el resultado sea Incidencia o Ausente.',

            ]);
        }

        $foto = $supervision->foto;

        if ($request->hasFile('foto'))
        {
            if (
                $supervision->foto &&
                Storage::disk('public')->exists($supervision->foto)
            )
            {
                Storage::disk('public')->delete(
                    $supervision->foto
                );
            }

            $foto = $request
                ->file('foto')
                ->store(
                    'supervisiones',
                    'public'
                );
        }

        $supervision->update([

            'asignacion_id' =>
                $request->asignacion_id,

            'fecha_supervision' =>
                $request->fecha_supervision,

            'resultado' =>
                $request->resultado,

            'observaciones' =>
                $request->observaciones,

            'foto' =>
                $foto,

        ]);

        return redirect()
            ->route(
                'operaciones.supervisiones.index'
            )
            ->with(
                'success',
                'Supervisión actualizada correctamente.'
            );
    }
}
