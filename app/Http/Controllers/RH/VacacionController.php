<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use App\Models\RH\Vacacion;

class VacacionController extends Controller
{
    public function index()
    {

        $vacaciones = Vacacion::with('empleado')
            ->latest()
            ->get();
        return view(
            'rh.vacaciones.index',
            compact('vacaciones')
        );
    }

    public function create()
    {

        $empleados = Empleado::orderBy('nombre')
            ->get();

        return view(
            'rh.vacaciones.create',
            compact('empleados')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'dias' => 'required|integer',
        ]);

        Vacacion::create([
            'empleado_id' => $request->empleado_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'dias' => $request->dias,
            'estado' => 'pendiente',
            'observaciones' => $request->observaciones,
        ]);


        return redirect()
        ->route('rh.vacaciones.index')
        ->with('success','Solicitud registrada');
    }

    public function aprobar(Vacacion $vacacion)
    {
        $vacacion->update([
            'estado' => 'aprobada',
        ]);

        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Vacaciones aprobadas'
            );
    }

    public function rechazar(Vacacion $vacacion)
    {
        $vacacion->update([
            'estado' => 'rechazada',
        ]);

        return redirect()
            ->route('rh.vacaciones.index')
            ->with(
                'success',
                'Vacaciones rechazadas'
            );
    }
}
