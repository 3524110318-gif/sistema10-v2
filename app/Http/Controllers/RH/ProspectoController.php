<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Prospecto;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\LogActividad;

class ProspectoController extends Controller
{
    public function index()
    {
        $prospectos = Prospecto::latest()
            ->paginate(10);

        return view(
            'rh.reclutamiento.index',
            compact('prospectos')
        );
    }

    public function create()
    {
        return view(
            'rh.reclutamiento.create'
        );
    }

    public function store(Request $request)
    {
        Prospecto::create([

            'nombre' => $request->nombre,

            'apellido_paterno' =>
                $request->apellido_paterno,

            'apellido_materno' =>
                $request->apellido_materno,

            'telefono' =>
                $request->telefono,

            'correo' =>
                $request->correo,

            'puesto_solicitado' =>
                $request->puesto_solicitado,

            'fecha_entrevista' =>
                $request->fecha_entrevista,

            'estado' =>
                'pendiente',

            'observaciones' =>
                $request->observaciones,

        ]);

        return redirect()

            ->route(
                'rh.prospectos.index'
            )

            ->with(
                'success',
                'Prospecto registrado'
            );
    }

    public function entrevistar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'entrevistado'
        ]);

        return back();
    }

    public function aprobar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'aprobado'
        ]);

        return back();
    }

    public function rechazar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'rechazado'
        ]);

        return back();
    }

    public function contratar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $totalEmpleados = Empleado::count() + 1;

        $numeroControl = 'GTRI' .
            str_pad(
                $totalEmpleados,
                4,
                '0',
                STR_PAD_LEFT
            );

        Empleado::create([

            'numero_control' => $numeroControl,

            'nombre' => $prospecto->nombre,

            'apellido_paterno' =>
                $prospecto->apellido_paterno,

            'apellido_materno' =>
                $prospecto->apellido_materno,

            'telefono' =>
                $prospecto->telefono,

            'correo' =>
                $prospecto->correo,

            'puesto' =>
                $prospecto->puesto_solicitado,

            'estado' => 'activo',

        ]);

        $prospecto->update([
            'estado' => 'contratado'
        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>
                'Contrató prospecto ' .
                $prospecto->nombre,

        ]);

        return redirect()

            ->route('rh.empleados')

            ->with(
                'success',
                'Prospecto contratado'
            );
    }
}
