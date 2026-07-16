<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operaciones\Vehiculo;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::latest()
            ->get();

        return view(
            'operaciones.vehiculos.index',
            compact('vehiculos')
        );
    }

    public function create()
    {
        return view(
            'operaciones.vehiculos.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'unidad' => 'required',

            'placas' => 'required|unique:vehiculos,placas',

            'marca' => 'required',

            'modelo' => 'required',

            'anio' => 'required',

            'kilometraje_actual' => 'required'
        ], [

            'placas.unique' =>
                'Las placas ya están registradas.',

            'placas.required' =>
                'Las placas son obligatorias.',

        ]);

        Vehiculo::create([

            'unidad' =>
                $request->unidad,

            'placas' =>
                $request->placas,

            'marca' =>
                $request->marca,

            'modelo' =>
                $request->modelo,

            'anio' =>
                $request->anio,

            'kilometraje_actual' =>
                $request->kilometraje_actual,

            'estado' =>
                'activo',

        ]);

        return redirect()
            ->route(
                'operaciones.vehiculos.index'
            );
    }

    public function edit(Vehiculo $vehiculo)
    {
        return view(
            'operaciones.vehiculos.edit',
            compact('vehiculo')
        );
    }

    public function update(Request $request,Vehiculo $vehiculo)
    {
        $vehiculo->update([

            'unidad' =>
                $request->unidad,

            'placas' =>
                $request->placas,

            'marca' =>
                $request->marca,

            'modelo' =>
                $request->modelo,

            'anio' =>
                $request->anio,

            'kilometraje_actual' =>
                $request->kilometraje_actual,

            'estado' =>
                $request->estado,

        ]);

        return redirect()
            ->route(
                'operaciones.vehiculos.index'
            );
    }
}
