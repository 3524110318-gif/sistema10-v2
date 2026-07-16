<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial\ProspectoComercial;

class ProspectoComercialController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $prospectos = ProspectoComercial::when(

            $buscar,

            function ($query) use ($buscar) {

                $query

                    ->where(
                        'razon_social',
                        'like',
                        "%{$buscar}%"
                    )

                    ->orWhere(
                        'contacto',
                        'like',
                        "%{$buscar}%"
                    );

            }

        )

        ->latest()

        ->paginate(10);

        return view(

            'comercial.prospectos.index',

            compact(

                'prospectos',

                'buscar'

            )

        );
    }

    public function create()
    {
        return view(

            'comercial.prospectos.create'

        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'telefono' => 'required|digits_between:10,15',
            'correo' => 'required|email|max:255',
            'rfc' => 'required|string|size:13|unique:prospectos_comerciales,rfc',
            'tarifa' => 'required|numeric|min:0',
            'numero_plazas' => 'required|integer|min:1',
            'estatus' => 'required|in:nuevo,seguimiento,cotizacion,ganado,perdido',
            'direccion' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        ProspectoComercial::create($validated);

        return redirect()
            ->route('comercial.prospectos.index')
            ->with('success', 'Prospecto comercial registrado correctamente.');
    }

    public function edit(ProspectoComercial $prospecto)
    {
        return view(

            'comercial.prospectos.edit',

            compact(
                'prospecto'
            )

        );
    }

    public function update(Request $request, ProspectoComercial $prospecto)
    {
        $validated = validator(
            $request->all(),
            [

                'razon_social' => 'required|string|max:255',

                'contacto' => 'required|string|max:255',

                'telefono' => 'required|digits_between:10,15',

                'correo' => 'required|email|max:255',

                'rfc' => 'required|string|size:13|unique:prospectos_comerciales,rfc,' . $prospecto->id,

                'tarifa' => 'required|numeric|min:0',

                'numero_plazas' => 'required|integer|min:1',

                'estatus' => 'required|in:nuevo,seguimiento,cotizacion,ganado,perdido',

                'direccion' => 'required|string',

                'observaciones' => 'nullable|string',

            ]
        );

        if ($validated->fails()) {

            return back()
                ->withErrors($validated)
                ->withInput();

        }

        $prospecto->update(

            $validated->validated()

        );

        return redirect()
            ->route('comercial.prospectos.index')
            ->with(
                'success',
                'Prospecto comercial actualizado correctamente.'
            );
    }

    public function destroy(ProspectoComercial $prospecto)
    {
        $prospecto->delete();

        return redirect()

            ->route(
                'comercial.prospectos.index'
            )

            ->with(
                'success',
                'Prospecto comercial eliminado correctamente.'
            );
    }
}