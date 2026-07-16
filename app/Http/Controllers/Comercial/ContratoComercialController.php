<?php

namespace App\Http\Controllers\Comercial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial\ContratoComercial;
use App\Models\Comercial\ClienteComercial;
use Illuminate\Support\Facades\Storage;

class ContratoComercialController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $contratos = ContratoComercial::with('cliente')

        ->when(

            $buscar,

            function ($query) use ($buscar) {

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

            'comercial.contratos.index',

            compact(

                'contratos',

                'buscar'

            )

        );
    }

    public function create()
    {
        $clientes = ClienteComercial::orderBy(

            'razon_social'

        )->get();

        return view(

            'comercial.contratos.create',

            compact(

                'clientes'

            )

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'cliente_comercial_id' => 'required|exists:clientes_comerciales,id',

            'folio' => 'required|unique:contratos_comerciales',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after:fecha_inicio',

            'tarifa' => 'required|numeric|min:0',

            'numero_plazas' => 'required|integer|min:1',

            'indexacion_anual' => 'required|numeric|min:0',

            'pdf_consignas' => 'required|mimes:pdf|max:5120',

            'estado' => 'required|in:borrador,pendiente,activo,finalizado,cancelado',

            'observaciones' => 'nullable|string',

        ]);

        $pdf = $request->file('pdf_consignas')->store(
            'contratos',
            'public'
        );

        ContratoComercial::create([

            'cliente_comercial_id' => $request->cliente_comercial_id,

            'folio' => $request->folio,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'tarifa' => $request->tarifa,

            'numero_plazas' => $request->numero_plazas,

            'indexacion_anual' => $request->indexacion_anual,

            'pdf_consignas' => $pdf,

            'estado' => $request->estado,

            'observaciones' => $request->observaciones,

        ]);

        return redirect()

            ->route('comercial.contratos.index')

            ->with(
                'success',
                'Contrato registrado correctamente.'
            );
    }

    public function edit(ContratoComercial $contrato)
    {
        $clientes = ClienteComercial::orderBy(

            'razon_social'

        )->get();

        return view(

            'comercial.contratos.edit',

            compact(

                'contrato',

                'clientes'

            )

        );
    }

    public function update(Request $request, ContratoComercial $contrato)
    {
        $request->validate([

            'cliente_comercial_id' => 'required|exists:clientes_comerciales,id',

            'folio' => 'required|unique:contratos_comerciales,folio,' . $contrato->id,

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after:fecha_inicio',

            'tarifa' => 'required|numeric|min:0',

            'numero_plazas' => 'required|integer|min:1',

            'indexacion_anual' => 'required|numeric|min:0',

            'pdf_consignas' => 'nullable|mimes:pdf|max:5120',

            'estado' => 'required|in:borrador,pendiente,activo,finalizado,cancelado',

            'observaciones' => 'nullable|string',

        ]);

        if ($request->hasFile('pdf_consignas')) {

            $pdf = $request->file('pdf_consignas')->store(
                'contratos',
                'public'
            );

            $contrato->pdf_consignas = $pdf;
        }

        $contrato->cliente_comercial_id = $request->cliente_comercial_id;

        $contrato->folio = $request->folio;

        $contrato->fecha_inicio = $request->fecha_inicio;

        $contrato->fecha_fin = $request->fecha_fin;

        $contrato->tarifa = $request->tarifa;

        $contrato->numero_plazas = $request->numero_plazas;

        $contrato->indexacion_anual = $request->indexacion_anual;

        $contrato->estado = $request->estado;

        $contrato->observaciones = $request->observaciones;

        $contrato->save();

        return redirect()

            ->route('comercial.contratos.index')

            ->with(
                'success',
                'Contrato actualizado correctamente.'
            );
    }

    public function destroy(ContratoComercial $contrato)
    {
        $contrato->delete();

        return redirect()

            ->route(

                'comercial.contratos.index'

            )

            ->with(

                'success',

                'Contrato eliminado correctamente.'

            );
    }
}