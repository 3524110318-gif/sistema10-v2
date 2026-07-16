<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $clientes = Cliente::when(
            $buscar,
            function ($query) use ($buscar) {

                $query->where(
                    'razon_social',
                    'like',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'rfc',
                    'like',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'representante',
                    'like',
                    "%{$buscar}%"
                );

            }
        )
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view(
            'operaciones.clientes.index',
            compact(
                'clientes',
                'buscar'
            )
        );
    }

    public function create()
    {
        return view(
            'operaciones.clientes.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'razon_social' =>
                'required|string|max:255',

            'rfc' =>
                'required|string|max:13|unique:clientes,rfc',

            'representante' =>
                'nullable|string|max:255',

            'telefono' =>
                'nullable|string|max:20',

            'correo' =>
                'nullable|email|max:255',

            'direccion' =>
                'nullable|string|max:1000',

        ],[

            'razon_social.required' =>
                'La razón social es obligatoria.',

            'rfc.required' =>
                'El RFC es obligatorio.',

            'rfc.unique' =>
                'Este RFC ya se encuentra registrado.',

            'correo.email' =>
                'Ingrese un correo válido.',

        ]);

        Cliente::create([

            'razon_social' =>
                $request->razon_social,

            'rfc' =>
                strtoupper(
                    $request->rfc
                ),

            'representante' =>
                $request->representante,

            'telefono' =>
                $request->telefono,

            'correo' =>
                $request->correo,

            'direccion' =>
                $request->direccion,

            'estado' =>
                'activo',

        ]);

        return redirect()
            ->route(
                'operaciones.clientes.index'
            )
            ->with(
                'success',
                'Cliente registrado correctamente.'
            );
    }

    public function show(Cliente $cliente)
    {
        $cliente->load(
            'contratos'
        );

        return view(
            'operaciones.clientes.show',
            compact(
                'cliente'
            )
        );
    }

    public function edit(Cliente $cliente)
    {
        return view(
            'operaciones.clientes.edit',
            compact(
                'cliente'
            )
        );
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([

            'razon_social' =>
                'required|string|max:255',

            'rfc' =>
                'required|string|max:13|unique:clientes,rfc,' .
                $cliente->id,

            'representante' =>
                'nullable|string|max:255',

            'telefono' =>
                'nullable|string|max:20',

            'correo' =>
                'nullable|email|max:255',

            'direccion' =>
                'nullable|string|max:1000',

            'estado' =>
                'required|in:activo,inactivo',

        ]);

        $cliente->update([

            'razon_social' =>
                $request->razon_social,

            'rfc' =>
                strtoupper(
                    $request->rfc
                ),

            'representante' =>
                $request->representante,

            'telefono' =>
                $request->telefono,

            'correo' =>
                $request->correo,

            'direccion' =>
                $request->direccion,

            'estado' =>
                $request->estado,

        ]);

        return redirect()
            ->route(
                'operaciones.clientes.index'
            )
            ->with(
                'success',
                'Cliente actualizado correctamente.'
            );
    }

    public function destroy(Cliente $cliente)
    {
        if($cliente->contratos()->exists())
        {
            return redirect()
                ->route(
                    'operaciones.clientes.index'
                )
                ->with(
                    'error',
                    'No se puede eliminar el cliente porque tiene contratos registrados.'
                );
        }

        $cliente->delete();

        return redirect()
            ->route(
                'operaciones.clientes.index'
            )
            ->with(
                'success',
                'Cliente eliminado correctamente.'
            );
    }
}
