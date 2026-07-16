<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Contrato;
use App\Models\Operaciones\Cliente;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $contratos = Contrato::with('cliente')

            ->when(
                $buscar,
                function ($query) use ($buscar) {

                    $query->where(
                        'numero_contrato',
                        'like',
                        "%{$buscar}%"
                    )

                    ->orWhereHas(
                        'cliente',
                        function ($q) use ($buscar) {

                            $q->where(
                                'razon_social',
                                'like',
                                "%{$buscar}%"
                            );

                        }
                    );

                }
            )

            ->latest()

            ->paginate(10)

            ->withQueryString();

        return view(
            'operaciones.contratos.index',
            compact(
                'contratos',
                'buscar'
            )
        );
    }

    public function create()
    {
        $clientes = Cliente::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.contratos.create',
            compact(
                'clientes'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'numero_contrato' =>
                'required|max:255|unique:contratos,numero_contrato',

            'fecha_inicio' =>
                'required|date',

            'fecha_fin' =>
                'nullable|date|after_or_equal:fecha_inicio',

            'observaciones' =>
                'nullable|max:1000',

        ],[

            'fecha_fin.after_or_equal' =>
                'La fecha final no puede ser menor que la fecha inicial.',

            'numero_contrato.unique' =>
                'Ese número de contrato ya existe.',

        ]);

        Contrato::create([

            'cliente_id' =>
                $request->cliente_id,

            'numero_contrato' =>
                strtoupper(
                    $request->numero_contrato
                ),

            'fecha_inicio' =>
                $request->fecha_inicio,

            'fecha_fin' =>
                $request->fecha_fin,

            'estado' =>
                'activo',

            'observaciones' =>
                $request->observaciones,

        ]);

        return redirect()

            ->route(
                'operaciones.contratos.index'
            )

            ->with(
                'success',
                'Contrato registrado correctamente.'
            );
    }

    public function show(
        Contrato $contrato
    )
    {
        $contrato->load([

            'cliente',

            'servicios',

        ]);

        return view(
            'operaciones.contratos.show',
            compact(
                'contrato'
            )
        );
    }

    public function edit(
        Contrato $contrato
    )
    {
        $clientes = Cliente::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.contratos.edit',
            compact(
                'contrato',
                'clientes'
            )
        );
    }

    public function update(
        Request $request,
        Contrato $contrato
    )
    {
        $request->validate([

            'cliente_id' =>
                'required|exists:clientes,id',

            'numero_contrato' =>
                'required|max:255|unique:contratos,numero_contrato,' .
                $contrato->id,

            'fecha_inicio' =>
                'required|date',

            'fecha_fin' =>
                'nullable|date|after_or_equal:fecha_inicio',

            'estado' =>
                'required|in:borrador,activo,vencido,cancelado',

            'observaciones' =>
                'nullable|max:1000',

        ]);

        $contrato->update([

            'cliente_id' =>
                $request->cliente_id,

            'numero_contrato' =>
                strtoupper(
                    $request->numero_contrato
                ),

            'fecha_inicio' =>
                $request->fecha_inicio,

            'fecha_fin' =>
                $request->fecha_fin,

            'estado' =>
                $request->estado,

            'observaciones' =>
                $request->observaciones,

        ]);

        return redirect()

            ->route(
                'operaciones.contratos.index'
            )

            ->with(
                'success',
                'Contrato actualizado correctamente.'
            );
    }

    public function destroy(
        Contrato $contrato
    )
    {
        if(
            $contrato
                ->servicios()
                ->exists()
        )
        {
            return redirect()

                ->route(
                    'operaciones.contratos.index'
                )

                ->with(
                    'error',
                    'No puede eliminar este contrato porque tiene servicios registrados.'
                );
        }

        $contrato->delete();

        return redirect()

            ->route(
                'operaciones.contratos.index'
            )

            ->with(
                'success',
                'Contrato eliminado correctamente.'
            );
    }
}
