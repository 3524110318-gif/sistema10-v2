<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\Factura;
use App\Models\Administracion\DetalleFactura;
use App\Models\Administracion\LogActividad;
use App\Models\Operaciones\Cliente;
use App\Models\Operaciones\Contrato;
use App\Models\Operaciones\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Mostrar listado de facturas.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $facturas = Factura::with([
            'cliente',
            'contrato',
        ]);

        if ($buscar) {

            $facturas->where(function ($query) use ($buscar) {

                $query->where(
                    'folio',
                    'like',
                    "%{$buscar}%"
                );

            })
            ->orWhereHas(
                'cliente',
                function ($query) use ($buscar)
                {
                    $query->where(
                        'razon_social',
                        'like',
                        "%{$buscar}%"
                    );
                }
            );

        }

        $facturas = $facturas
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'administracion.facturas.index',
            compact(
                'facturas'
            )
        );
    }

    /**
     * Mostrar formulario para crear factura.
     */
    public function create()
    {
        $clientes = Cliente::where(
            'estado',
            'activo'
        )
        ->orderBy(
            'razon_social'
        )
        ->get();

        $contratos = Contrato::where(
            'estado',
            'activo'
        )
        ->orderBy(
            'numero_contrato'
        )
        ->get();

        $servicios = Servicio::where(
            'estado',
            'activo'
        )
        ->withCount([

            'plazas as plazas_contratadas',

            'plazas as plazas_cubiertas' => function ($query) {

                $query->where(
                    'estado',
                    'cubierta'
                );

            },

            'plazas as plazas_vacantes' => function ($query) {

                $query->where(
                    'estado',
                    'vacante'
                );

            },

        ])
        ->orderBy(
            'nombre'
        )
        ->get();

        return view(
            'administracion.facturas.create',
            compact(
                'clientes',
                'contratos',
                'servicios'
            )
        );
    }

        /**
     * Guardar una factura.
     */
    public function store(Request $request)
    {
        $request->validate([

            'cliente_id' => [
                'required',
                'exists:clientes,id'
            ],

            'contrato_id' => [
                'required',
                'exists:contratos,id'
            ],

            'fecha_factura' => [
                'required',
                'date'
            ],

            'periodo_inicio' => [
                'required',
                'date'
            ],

            'periodo_fin' => [
                'required',
                'date'
            ],

            'estado' => [
                'required',
                'in:borrador,emitida,cancelada'
            ],

            'observaciones' => [
                'nullable',
                'string'
            ],

            'servicio_id' => [
                'required',
                'array'
            ],

            'servicio_id.*' => [
                'exists:servicios,id'
            ],

        ]);

        DB::transaction(function () use ($request) {

            $folio = $this->generarFolio();

            $factura = Factura::create([

                'cliente_id' => $request->cliente_id,

                'contrato_id' => $request->contrato_id,

                'folio' => $folio,

                'fecha_factura' => $request->fecha_factura,

                'periodo_inicio' => $request->periodo_inicio,

                'periodo_fin' => $request->periodo_fin,

                'subtotal' => 0,

                'iva' => 0,

                'total' => 0,

                'estado' => $request->estado,

                'observaciones' => $request->observaciones,

            ]);

            $subtotalFactura = 0;

            foreach ($request->servicio_id as $i => $servicioId) {

                $precio = str_replace(

                    ',',

                    '',

                    $request->precio_unitario[$i]

                );

                $servicio = Servicio::withCount([

                    'plazas as plazas_contratadas',

                    'plazas as plazas_cubiertas' => function ($query) {

                        $query->where(
                            'estado',
                            'cubierta'
                        );

                    },

                ])->findOrFail($servicioId);

                $plazasContratadas =
                    $servicio->plazas_contratadas;

                $plazasCubiertas =
                    $servicio->plazas_cubiertas;

                $subtotal =
                    $plazasContratadas
                    *
                    $precio;

                DetalleFactura::create([

                    'factura_id' =>
                        $factura->id,

                    'servicio_id' =>
                        $servicioId,

                    'plazas_contratadas' =>
                        $plazasContratadas,

                    'plazas_cubiertas' =>
                        $plazasCubiertas,

                    'precio_unitario' =>
                        $precio,

                    'subtotal' =>
                        $subtotal,

                    'observaciones' =>
                        $request->detalle_observaciones[$i]
                        ??
                        null,

                ]);

                $subtotalFactura += $subtotal;

            }

            $iva = $subtotalFactura * 0.16;

            $total = $subtotalFactura + $iva;

            $factura->update([

                'subtotal' => $subtotalFactura,

                'iva' => $iva,

                'total' => $total,

            ]);

            LogActividad::create([

                'usuario' => Auth::user()->rol,

                'accion' =>

                    'Generó la factura '

                    .

                    $folio,

            ]);

        });

        return redirect()

            ->route('administracion.facturas.index')

            ->with(

                'success',

                'Factura registrada correctamente.'

            );
    }

    /**
     * Generar folio automático.
     */
    private function generarFolio(): string
    {
        $ultimo = Factura::max('id') + 1;

        return 'FAC-' . str_pad(

            $ultimo,

            5,

            '0',

            STR_PAD_LEFT

        );
    }

        /**
     * Mostrar una factura.
     */
    public function show(Factura $factura)
    {
        $factura->load([

            'cliente',

            'contrato',

            'detalles.servicio',

        ]);

        return view(

            'administracion.facturas.show',

            compact(

                'factura'

            )

        );
    }

    /**
     * Mostrar formulario para editar.
     */
    public function edit(Factura $factura)
    {
        $factura->load(

            'detalles'

        );

        $clientes = Cliente::where(
            'estado',
            'activo'
        )
        ->orderBy(
            'razon_social'
        )
        ->get();

        $contratos = Contrato::where(
            'estado',
            'activo'
        )
        ->orderBy(
            'numero_contrato'
        )
        ->get();

        $servicios = Servicio::where(
            'estado',
            'activo'
        )
        ->orderBy(
            'nombre'
        )
        ->get();

        return view(

            'administracion.facturas.edit',

            compact(

                'factura',

                'clientes',

                'contratos',

                'servicios'

            )

        );
    }

    /**
     * Actualizar factura.
     */
    public function update(Request $request, Factura $factura)
    {
        $request->validate([

            'cliente_id' => [
                'required',
                'exists:clientes,id'
            ],

            'contrato_id' => [
                'required',
                'exists:contratos,id'
            ],

            'fecha_factura' => [
                'required',
                'date'
            ],

            'periodo_inicio' => [
                'required',
                'date'
            ],

            'periodo_fin' => [
                'required',
                'date'
            ],

            'estado' => [
                'required',
                'in:borrador,emitida,cancelada'
            ],

            'servicio_id' => [
                'required',
                'array'
            ],

        ]);

        DB::transaction(function () use (

            $request,

            $factura

        ) {

            $factura->update([

                'cliente_id' => $request->cliente_id,

                'contrato_id' => $request->contrato_id,

                'fecha_factura' => $request->fecha_factura,

                'periodo_inicio' => $request->periodo_inicio,

                'periodo_fin' => $request->periodo_fin,

                'estado' => $request->estado,

                'observaciones' => $request->observaciones,

            ]);

            $factura
                ->detalles()
                ->delete();

            $subtotalFactura = 0;

            foreach (

                $request->servicio_id

                as

                $i => $servicioId

            ) {
                $servicio = Servicio::withCount([

                'plazas as plazas_contratadas',

                'plazas as plazas_cubiertas' => function ($query) {

                    $query->where(
                        'estado',
                        'cubierta'
                    );

                },

            ])->findOrFail($servicioId);

            $plazasContratadas =
                $servicio->plazas_contratadas;

            $plazasCubiertas =
                $servicio->plazas_cubiertas;

            $precio = str_replace(
                ',',
                '',
                $request->precio_unitario[$i]
            );

            $subtotal =
                $plazasContratadas
                *
                $precio;

            DetalleFactura::create([

                'factura_id' =>
                    $factura->id,

                'servicio_id' =>
                    $servicioId,

                'plazas_contratadas' =>
                    $plazasContratadas,

                'plazas_cubiertas' =>
                    $plazasCubiertas,

                'precio_unitario' =>
                    $precio,

                'subtotal' =>
                    $subtotal,

                'observaciones' =>
                    $request->detalle_observaciones[$i]
                    ??
                    null,

            ]);

                $subtotalFactura += $subtotal;

            }

            $iva =

                $subtotalFactura

                *

                0.16;

            $factura->update([

                'subtotal' =>

                    $subtotalFactura,

                'iva' =>

                    $iva,

                'total' =>

                    $subtotalFactura

                    +

                    $iva,

            ]);

            LogActividad::create([

                'usuario' =>

                    Auth::user()->rol,

                'accion' =>

                    'Actualizó la factura '

                    .

                    $factura->folio,

            ]);

        });

        return redirect()

            ->route(

                'administracion.facturas.index'

            )

            ->with(

                'success',

                'Factura actualizada correctamente.'

            );
    }

        /**
     * Cancelar una factura.
     */
    public function destroy(Factura $factura)
    {
        $factura->update([

            'estado' => 'cancelada',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>

                'Canceló la factura '

                .

                $factura->folio,

        ]);

        return redirect()

            ->route(
                'administracion.facturas.index'
            )

            ->with(

                'success',

                'Factura cancelada correctamente.'

            );
    }
}
