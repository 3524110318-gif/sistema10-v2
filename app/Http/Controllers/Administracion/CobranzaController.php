<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\Cobranza;
use App\Models\Administracion\Factura;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;

class CobranzaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $cobranzas = Cobranza::with(
            'factura.cliente'
        )

        ->when(

            $buscar,

            function ($query) use ($buscar) {

                $query->whereHas(

                    'factura',

                    function ($q) use ($buscar) {

                        $q->where(
                            'folio',
                            'like',
                            "%{$buscar}%"
                        );

                    }

                );

            }

        )

        ->latest()

        ->paginate(10);

        return view(

            'administracion.cobranzas.index',

            compact(

                'cobranzas',

                'buscar'

            )

        );
    }

    public function create()
    {
        $facturas = Factura::doesntHave(
            'cobranza'
        )

        ->where(

            'estado',

            'emitida'

        )

        ->orderBy(

            'folio'

        )

        ->get();

        return view(

            'administracion.cobranzas.create',

            compact(

                'facturas'

            )

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'factura_id' => 'required|exists:facturas,id',

            'fecha_vencimiento' => 'required|date',

            'estado' => 'required|in:pendiente,revision,pagada,vencida',

            'fecha_pago' => 'nullable|required_if:estado,pagada|date',

            'referencia_pago' => 'nullable|string|max:255',

            'observaciones' => 'nullable|string',

        ]);

        $factura = Factura::findOrFail(
            $request->factura_id
        );

        Cobranza::create([

            'factura_id' => $factura->id,

            'fecha_vencimiento' => $request->fecha_vencimiento,

            'fecha_pago' => $request->fecha_pago,

            'monto' => $factura->total,

            'estado' => $request->estado,

            'referencia_pago' => $request->referencia_pago,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Creó una cobranza de la factura '.$factura->folio,

        ]);

        return redirect()

            ->route(
                'administracion.cobranzas.index'
            )

            ->with(
                'success',
                'Cobranza registrada correctamente.'
            );
    }

    public function show(Cobranza $cobranza)
    {
        $cobranza->load(

            'factura.cliente',

            'factura.contrato'

        );

        return view(

            'administracion.cobranzas.show',

            compact(

                'cobranza'

            )

        );
    }

    public function edit(Cobranza $cobranza)
    {
        $facturas = Factura::orderBy(
            'folio'
        )->get();

        return view(

            'administracion.cobranzas.edit',

            compact(

                'cobranza',

                'facturas'

            )

        );
    }

    public function update(Request $request,Cobranza $cobranza)
    {
        $request->validate([

            'factura_id' => 'required|exists:facturas,id',

            'fecha_vencimiento' => 'required|date',

            'estado' => 'required|in:pendiente,revision,pagada,vencida',

            'fecha_pago' => 'nullable|required_if:estado,pagada|date',

            'referencia_pago' => 'nullable|string|max:255',

            'observaciones' => 'nullable|string',

        ]);

        $factura = Factura::findOrFail(
            $request->factura_id
        );

        $cobranza->update([

            'factura_id' => $factura->id,

            'fecha_vencimiento' => $request->fecha_vencimiento,

            'fecha_pago' => $request->fecha_pago,

            'monto' => $factura->total,

            'estado' => $request->estado,

            'referencia_pago' => $request->referencia_pago,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->name,

            'accion' => 'Actualizó la cobranza de la factura '.$factura->folio,

        ]);

        return redirect()

            ->route(
                'administracion.cobranzas.index'
            )

            ->with(
                'success',
                'Cobranza actualizada correctamente.'
            );
    }

    public function destroy(Cobranza $cobranza)
    {
        $folio = $cobranza
            ->factura
            ->folio;

        $cobranza->delete();

        LogActividad::create([

            'usuario' => Auth::user()->name,

            'accion' => 'Eliminó la cobranza de la factura '.$folio,

        ]);

        return redirect()

            ->route(
                'administracion.cobranzas.index'
            )

            ->with(
                'success',
                'Cobranza eliminada correctamente.'
            );
    }
}
