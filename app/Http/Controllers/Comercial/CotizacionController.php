<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial\Cotizacion;
use App\Models\Comercial\ProspectoComercial;

class CotizacionController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $cotizaciones = Cotizacion::with('prospecto')

        ->when(

            $buscar,

            function($query) use($buscar){

                $query->where(

                    'folio',

                    'like',

                    "%{$buscar}%"

                );

            }

        )

        ->latest()

        ->paginate(10);

        return view(

            'comercial.cotizaciones.index',

            compact(

                'cotizaciones',

                'buscar'

            )

        );
    }

    public function create()
    {
        $prospectos = ProspectoComercial::orderBy(

            'razon_social'

        )->get();

        return view(

            'comercial.cotizaciones.create',

            compact(

                'prospectos'

            )

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'prospecto_comercial_id'=>'required|exists:prospectos_comerciales,id',

            'folio'=>'required|unique:cotizaciones',

            'fecha'=>'required|date',

            'monto'=>'required|numeric|min:0',

            'numero_plazas'=>'required|integer|min:1',

            'vigencia_dias'=>'required|integer|min:1',

            'estatus'=>'required|in:pendiente,aceptada,rechazada,cancelada',

            'observaciones'=>'nullable|string',

        ]);

        Cotizacion::create(

            $request->all()

        );

        return redirect()

            ->route(

                'comercial.cotizaciones.index'

            )

            ->with(

                'success',

                'Cotización registrada correctamente.'

            );
    }

    public function show(Cotizacion $cotizacione)
    {
        //
    }

    public function edit(Cotizacion $cotizacione)
    {
        $prospectos = ProspectoComercial::orderBy(

            'razon_social'

        )->get();

        return view(

            'comercial.cotizaciones.edit',

            [

                'cotizacion'=>$cotizacione,

                'prospectos'=>$prospectos

            ]

        );
    }

    public function update(Request $request,Cotizacion $cotizacione)
    {
        $request->validate([

            'prospecto_comercial_id'=>'required|exists:prospectos_comerciales,id',

            'folio'=>'required|unique:cotizaciones,folio,' . $cotizacione->id,

            'fecha'=>'required|date',

            'monto'=>'required|numeric|min:0',

            'numero_plazas'=>'required|integer|min:1',

            'vigencia_dias'=>'required|integer|min:1',

            'estatus'=>'required|in:pendiente,aceptada,rechazada,cancelada',

            'observaciones'=>'nullable|string',

        ]);

        $cotizacione->update(

            $request->all()

        );

        return redirect()

            ->route(

                'comercial.cotizaciones.index'

            )

            ->with(

                'success',

                'Cotización actualizada correctamente.'

            );
    }

    public function destroy(Cotizacion $cotizacione)
    {
        $cotizacione->delete();

        return redirect()

            ->route(

                'comercial.cotizaciones.index'

            )

            ->with(

                'success',

                'Cotización eliminada correctamente.'

            );
    }
}