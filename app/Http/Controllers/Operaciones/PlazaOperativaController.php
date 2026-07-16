<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\Operaciones\Servicio;
use Illuminate\Http\Request;

class PlazaOperativaController extends Controller
{
    public function index()
    {
        $plazas = PlazaOperativa::with(
            'servicio'
        )->latest()->get();

        return view(
            'operaciones.plazas.index',
            compact('plazas')
        );
    }

    public function create()
    {
        $servicios = Servicio::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.plazas.create',
            compact('servicios')
        );
    }

    public function store(
        Request $request
    )
    {
        PlazaOperativa::create([

        'servicio_id' =>
            $request->servicio_id,

        'nombre_plaza' =>
            $request->nombre_plaza,

        'turno' =>
            $request->turno,

        'hora_entrada' =>
            $request->hora_entrada,

        'hora_salida' =>
            $request->hora_salida,

        'estado' =>
            'vacante',

    ]);
        return redirect()
            ->route(
                'operaciones.plazas.index'
            );
    }
}
