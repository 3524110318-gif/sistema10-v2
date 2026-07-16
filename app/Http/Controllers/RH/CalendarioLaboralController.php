<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\CalendarioLaboral;

class CalendarioLaboralController extends Controller
{
    public function index()
    {
        $dias = CalendarioLaboral::orderBy(
            'fecha',
            'desc'
        )->get();

        return view(
            'rh.calendario.index',
            compact('dias')
        );
    }

    public function create()
    {
        return view('rh.calendario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'tipo' => 'required',
        ]);

        CalendarioLaboral::create([
            'fecha' => $request->fecha,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('rh.calendario.index')
            ->with(
                'success',
                'Día registrado correctamente'
            );
    }
}
