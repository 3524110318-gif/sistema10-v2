<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operaciones\Evidencia;
use App\Models\Operaciones\Supervision;
use Illuminate\Support\Facades\Storage;

class EvidenciaController extends Controller
{
    public function index()
    {
        $evidencias = Evidencia::with([
            'supervision.asignacion.empleado',
            'supervision.asignacion.plaza.servicio',
        ])->latest()->get();

        return view(
            'operaciones.evidencias.index',
            compact('evidencias')
        );
    }

    public function create()
    {
        $supervisiones = Supervision::with([
            'asignacion.empleado',
            'asignacion.plaza'
        ])
        ->latest()
        ->get();

        return view(
            'operaciones.evidencias.create',
            compact('supervisiones')
        );
    }

    public function store(Request $request)
    {
        $rutaFoto = null;

        if (
            $request->hasFile('foto')
        ) {

            $rutaFoto =
                $request
                ->file('foto')
                ->store(
                    'evidencias',
                    'public'
                );
        }

        Evidencia::create([

            'supervision_id' =>
                $request->supervision_id,

            'titulo' =>
                $request->titulo,

            'foto' =>
                $rutaFoto,

            'descripcion' =>
                $request->descripcion,

        ]);

        return redirect()
            ->route(
                'operaciones.evidencias.index'
            );
    }

    public function show( Evidencia $evidencia)
    {
        $evidencia->load([

            'supervision.asignacion.empleado',

            'supervision.asignacion.plaza.servicio',

        ]);

        return view(
            'operaciones.evidencias.show',
            compact('evidencia')
        );
    }

    public function edit(Evidencia $evidencia)
    {
        $supervisiones = Supervision::with([

            'asignacion.empleado',

            'asignacion.plaza.servicio',

        ])->get();

        return view(

            'operaciones.evidencias.edit',

            compact(

                'evidencia',

                'supervisiones'

            )

        );
    }

    public function update(Request $request,Evidencia $evidencia)
    {
        $request->validate([

            'supervision_id' =>
                'required|exists:supervisions,id',

            'titulo' =>
                'required|string|max:255',

            'descripcion' =>
                'nullable|string|max:1000',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $foto = $evidencia->foto;

        if($request->hasFile('foto'))
        {
            if(
                $evidencia->foto &&
                Storage::disk('public')->exists(
                    $evidencia->foto
                )
            ){
                Storage::disk('public')->delete(
                    $evidencia->foto
                );
            }

            $foto = $request
                ->file('foto')
                ->store(
                    'evidencias',
                    'public'
                );
        }

        $evidencia->update([

            'supervision_id' =>
                $request->supervision_id,

            'titulo' =>
                $request->titulo,

            'descripcion' =>
                $request->descripcion,

            'foto' =>
                $foto,

        ]);

        return redirect()
            ->route(
                'operaciones.evidencias.index'
            )
            ->with(
                'success',
                'Evidencia actualizada correctamente.'
            );
    }
}
