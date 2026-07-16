<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial\ClienteComercial;

class ClienteComercialController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $clientes = ClienteComercial::when(

            $buscar,

            function ($query) use ($buscar) {

                $query

                    ->where(
                        'razon_social',
                        'like',
                        "%{$buscar}%"
                    )

                    ->orWhere(
                        'rfc',
                        'like',
                        "%{$buscar}%"
                    );

            }

        )

        ->latest()

        ->paginate(10);

        return view(

            'comercial.clientes.index',

            compact(

                'clientes',

                'buscar'

            )

        );
    }

    public function create()
    {
        return view(

            'comercial.clientes.create'

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'razon_social' => 'required|max:255',

            'rfc' => 'required|max:13|unique:clientes_comerciales,rfc',

            'representante_legal' => 'required|max:255',

            'telefono' => 'required|max:20',

            'correo' => 'required|email',

            'domicilio_fiscal' => 'required',

            'estatus' => 'required|in:activo,inactivo',

        ]);

        ClienteComercial::create(

            $request->all()

        );

        return redirect()

            ->route(
                'comercial.clientes.index'
            )

            ->with(
                'success',
                'Cliente registrado correctamente.'
            );
    }

    public function show(ClienteComercial $cliente)
    {
        return view(

            'comercial.clientes.show',

            compact(
                'cliente'
            )

        );
    }

    public function edit(ClienteComercial $cliente)
    {
        return view(

            'comercial.clientes.edit',

            compact(
                'cliente'
            )

        );
    }

    public function update(Request $request, ClienteComercial $cliente)
    {
        $request->validate([

            'razon_social' => 'required|max:255',

            'rfc' => 'required|max:13|unique:clientes_comerciales,rfc,' . $cliente->id,

            'representante_legal' => 'required|max:255',

            'telefono' => 'required|max:20',

            'correo' => 'required|email',

            'domicilio_fiscal' => 'required',

            'estatus' => 'required|in:activo,inactivo',

        ]);

        $cliente->update(

            $request->all()

        );

        return redirect()

            ->route(
                'comercial.clientes.index'
            )

            ->with(
                'success',
                'Cliente actualizado correctamente.'
            );
    }

    public function destroy(ClienteComercial $cliente)
    {
        $cliente->delete();

        return redirect()

            ->route(
                'comercial.clientes.index'
            )

            ->with(
                'success',
                'Cliente eliminado correctamente.'
            );
    }
}