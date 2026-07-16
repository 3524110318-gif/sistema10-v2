<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use App\Models\RH\Incidencia;

class IncidenciaController extends Controller
{
     public function index()
    {
        $incidencias = Incidencia::with('empleado')
            ->latest()
            ->get();

        return view('rh.incidencias.index', compact('incidencias'));
    }

    public function create()
    {

        $empleados = Empleado::orderBy('nombre')
            ->get();

        return view('rh.incidencias.create',compact('empleados'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'empleado_id' => 'required',
            'tipo' => 'required',
            'fecha' => 'required|date',
        ]);

        Incidencia::create([
            'empleado_id' => $request->empleado_id,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);


        return redirect()
            ->route('rh.incidencias.index')
            ->with('success','Incidencia registrada');
    }

    public function justificar(Incidencia $incidencia)
    {
        $incidencia->update([
            'estado' => 'justificada',
        ]);

        return redirect()
            ->route('rh.incidencias.index')
            ->with('success','Incidencia justificada');
    }

    public function injustificar(Incidencia $incidencia)
    {
        $incidencia->update([
            'estado' => 'injustificada',
        ]);

        return redirect()
            ->route('rh.incidencias.index')
            ->with('success','Incidencia injustificada');
    }
}
