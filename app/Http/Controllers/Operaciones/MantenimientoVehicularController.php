<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Operaciones\Vehiculo;
use App\Models\Operaciones\MantenimientoVehicular;

class MantenimientoVehicularController extends Controller
{
    public function index()
    {
        $mantenimientos =
            MantenimientoVehicular::with(
                'vehiculo'
            )
            ->latest()
            ->get();

        return view(
            'operaciones.mantenimientos.index',
            compact(
                'mantenimientos'
            )
        );
    }

    public function create()
    {
        $vehiculos =
            Vehiculo::all();

        return view(
            'operaciones.mantenimientos.create',
            compact(
                'vehiculos'
            )
        );
    }

    public function store(Request $request)
    {
        MantenimientoVehicular::create(
            [
            'vehiculo_id' =>
                $request->vehiculo_id,

            'fecha' =>
                $request->fecha,

            'kilometraje' =>
                $request->kilometraje,

            'tipo' =>
                $request->tipo,

            'observaciones' =>
                $request->observaciones,

            'proximo_mantenimiento' =>
                $request->kilometraje + 2800,
            ]
        );

        $vehiculo = Vehiculo::find(
            $request->vehiculo_id
        );

        $vehiculo->update([

            'kilometraje_actual' =>
                $request->kilometraje
            ]
        );

        return redirect()
            ->route(
                'operaciones.mantenimientos.index'
            );
    }

    public function edit(MantenimientoVehicular $mantenimiento)
    {
        $vehiculos =
            Vehiculo::all();

        return view(
            'operaciones.mantenimientos.edit',
            compact(
                'mantenimiento',
                'vehiculos'
            )
        );
    }

    public function update(Request $request,MantenimientoVehicular $mantenimiento)
    {
        $mantenimiento->update([

            'vehiculo_id' =>
                $request->vehiculo_id,

            'fecha' =>
                $request->fecha,

            'kilometraje' =>
                $request->kilometraje,

            'tipo' =>
                $request->tipo,

            'observaciones' =>
                $request->observaciones,

            'proximo_mantenimiento' =>
                $request->kilometraje + 2800,

        ]);

        $vehiculo = Vehiculo::find(
            $request->vehiculo_id
        );

        $vehiculo->update([

            'kilometraje_actual' =>
                $request->kilometraje

        ]);

        return redirect()
            ->route(
                'operaciones.mantenimientos.index'
            );
    }
}
