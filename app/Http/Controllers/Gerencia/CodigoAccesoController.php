<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\Gerencia\CodigoAcceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodigoAccesoController extends Controller
{
    public function index()
    {
        $modulos = [

            'rh',

            'operaciones',

            'administracion',

            'comercial',

            'repse',

            'gerencia',

        ];

        foreach ($modulos as $modulo) {

            CodigoAcceso::firstOrCreate(

                [

                    'modulo' => $modulo,

                ],

                [

                    'codigo' => random_int(
                        100000,
                        999999
                    ),

                    'estado' => 'activo',

                    'fecha_generacion' => now(),

                    'usuario_id' => Auth::id(),

                ]

            );

        }
        
        $codigos = CodigoAcceso::orderBy(
            'modulo'
        )->paginate(10);

        return view(
            'gerencia.codigos.index',
            compact('codigos')
        );
    }

    public function create()
    {
        return view(
            'gerencia.codigos.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'modulo' => 'required|unique:codigo_accesos,modulo',

        ]);

        CodigoAcceso::create([

            'modulo' => $request->modulo,

            'codigo' => random_int(
                100000,
                999999
            ),

            'estado' => 'activo',

            'fecha_generacion' => now(),

            'usuario_id' => Auth::id(),

        ]);

        return redirect()
            ->route('gerencia.codigos.index')
            ->with(
                'success',
                'Código generado correctamente.'
            );
    }

    public function edit(CodigoAcceso $codigo)
    {
        return view(
            'gerencia.codigos.edit',
            compact('codigo')
        );
    }

    public function update(Request $request,CodigoAcceso $codigo)
    {
        $request->validate([

            'modulo' =>
                'required|unique:codigo_accesos,modulo,' .
                $codigo->id,

            'estado' =>
                'required|in:activo,inactivo',

        ]);

        $codigo->update([

            'modulo' => $request->modulo,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('gerencia.codigos.index')
            ->with(
                'success',
                'Código actualizado correctamente.'
            );
    }

    public function regenerar(CodigoAcceso $codigo)
    {
        $codigo->update([

            'codigo' => random_int(
                100000,
                999999
            ),

            'fecha_generacion' => now(),

            'usuario_id' => Auth::id(),

        ]);

        return redirect()
            ->route('gerencia.codigos.index')
            ->with(
                'success',
                'Código regenerado correctamente.'
            );
    }

    public function destroy(CodigoAcceso $codigo)
    {
        $codigo->delete();

        return redirect()
            ->route('gerencia.codigos.index')
            ->with(
                'success',
                'Código eliminado correctamente.'
            );
    }
}