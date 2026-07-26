<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\Compra;
use App\Models\Administracion\Proveedor;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\LogActividad;
use App\Models\Administracion\Producto;
use App\Models\Administracion\DetalleCompra;
use App\Models\Administracion\MovimientoInventario;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Mostrar listado de compras.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $compras = Compra::with('proveedor');

        if ($buscar) {

            $compras->where(
                'folio',
                'like',
                "%{$buscar}%"
            );

        }

        $compras = $compras
            ->orderByDesc('id')
            ->paginate(10);

        $totalCompras = Compra::count();

        return view(
            'administracion.compras.index',
            compact(
                'compras',
                'totalCompras'
            )
        );
    }

    /**
     * Mostrar formulario.
     */
    public function create()
    {
        $proveedores = Proveedor::where(
            'estado',
            'activo'
        )
        ->orderBy('razon_social')
        ->get();

        $productos = Producto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.compras.create',
            compact(
                'proveedores',
                'productos'
            )
        );
    }

    /**
     * Guardar compra.
     */
    public function store(Request $request)
    {
        $request->validate([

            'proveedor_id' => [
                'required',
                'exists:proveedores,id',
            ],

            'fecha_compra' => [
                'required',
                'date',
            ],

            'estado' => [
                'required',
                'in:pendiente,recibida,cancelada',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],

            'producto_id' => [
                'required',
                'array',
                'min:1',
            ],

            'producto_id.*' => [
                'required',
                'exists:productos,id',
            ],

            'cantidad' => [
                'required',
                'array',
            ],

            'cantidad.*' => [
                'required',
                'integer',
                'min:1',
            ],

            'precio_unitario' => [
                'required',
                'array',
            ],

            'precio_unitario.*' => [
                'required',
                'numeric',
                'min:0',
            ],

        ]);

        DB::transaction(function () use ($request) {

            $ultimoId =
                Compra::max('id') + 1;

            $folio =
                'COMP-' .
                str_pad(
                    $ultimoId,
                    5,
                    '0',
                    STR_PAD_LEFT
                );

            $compra = Compra::create([

                'proveedor_id' =>
                    $request->proveedor_id,

                'folio' =>
                    $folio,

                'fecha_compra' =>
                    $request->fecha_compra,

                'subtotal' =>
                    0,

                'iva' =>
                    0,

                'total' =>
                    0,

                'estado' =>
                    $request->estado,

                'observaciones' =>
                    $request->observaciones,

                'user_id' =>
                    Auth::id(),

            ]);

            $subtotalCompra = 0;


            foreach (
                $request->producto_id
                as $i => $productoId
            ) {

                $cantidad =
                    (int) $request->cantidad[$i];

                $precioUnitario =
                    (float) $request->precio_unitario[$i];

                $subtotal =
                    $cantidad * $precioUnitario;


                DetalleCompra::create([

                    'compra_id' =>
                        $compra->id,

                    'producto_id' =>
                        $productoId,

                    'cantidad' =>
                        $cantidad,

                    'precio_unitario' =>
                        $precioUnitario,

                    'subtotal' =>
                        $subtotal,

                ]);


                $subtotalCompra +=
                    $subtotal;


                /*
                |--------------------------------------------------------------------------
                | ENTRADA AUTOMÁTICA A INVENTARIO
                |--------------------------------------------------------------------------
                */

                if (
                    $request->estado === 'recibida'
                ) {

                    $producto =
                        Producto::findOrFail(
                            $productoId
                        );

                    $stockAnterior =
                        $producto->stock_actual;

                    $stockNuevo =
                        $stockAnterior
                        +
                        $cantidad;


                    $producto->update([

                        'stock_actual' =>
                            $stockNuevo,

                    ]);


                    MovimientoInventario::create([

                        'producto_id' =>
                            $producto->id,

                        'tipo_movimiento' =>
                            'entrada',

                        'cantidad' =>
                            $cantidad,

                        'stock_anterior' =>
                            $stockAnterior,

                        'stock_nuevo' =>
                            $stockNuevo,

                        'fecha_movimiento' =>
                            now(),

                        'user_id' =>
                            Auth::id(),

                        'referencia' =>
                            $folio,

                        'motivo' =>
                            'Recepción de compra',

                        'observaciones' =>
                            $request->observaciones,

                        'origen' =>
                            'Compras',

                    ]);

                }

            }


            $iva =
                $subtotalCompra * 0.16;

            $total =
                $subtotalCompra + $iva;


            $compra->update([

                'subtotal' =>
                    $subtotalCompra,

                'iva' =>
                    $iva,

                'total' =>
                    $total,

            ]);


            LogActividad::create([

                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Creó la compra '
                    .
                    $compra->folio,

            ]);

        });


        return redirect()

            ->route(
                'administracion.compras.index'
            )

            ->with(
                'success',
                'Compra registrada correctamente.'
            );
    }

    /**
     * Mostrar compra.
     */
    public function show(Compra $compra)
    {
        $compra->load(
            'proveedor',
            'usuario',
            'detalles.producto'
        );

        return view(
            'administracion.compras.show',
            compact(
                'compra'
            )
        );
    }

    /**
     * Formulario de edición.
     */
    public function edit(Compra $compra)
    {
        $compra->load('detalles.producto');

        $proveedores = Proveedor::where(
            'estado',
            'activo'
        )
        ->orderBy('razon_social')
        ->get();

        $productos = Producto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.compras.edit',
            compact(
                'compra',
                'proveedores',
                'productos'
            )
        );
    }

    /**
     * Actualizar compra.
     */
    public function update(Request $request, Compra $compra)
{
    $request->validate([

        'proveedor_id' => [
            'required',
            'exists:proveedores,id',
        ],

        'fecha_compra' => [
            'required',
            'date',
        ],

        'estado' => [
            'required',
            'in:pendiente,recibida,cancelada',
        ],

        'observaciones' => [
            'nullable',
            'string',
        ],

        'producto_id' => [
            'required',
            'array',
            'min:1',
        ],

        'producto_id.*' => [
            'required',
            'exists:productos,id',
        ],

        'cantidad' => [
            'required',
            'array',
        ],

        'cantidad.*' => [
            'required',
            'integer',
            'min:1',
        ],

        'precio_unitario' => [
            'required',
            'array',
        ],

        'precio_unitario.*' => [
            'required',
            'numeric',
            'min:0',
        ],

    ]);


    if (
        $compra->estado === 'recibida'
        &&
        $request->estado !== 'recibida'
    ) {

        return back()
            ->withInput()
            ->withErrors([

                'estado' =>
                    'Una compra recibida no puede cambiarse a pendiente o cancelada porque ya afectó el inventario.',

            ]);

    }


    DB::transaction(function () use (
        $request,
        $compra
    ) {

        $estadoAnterior =
            $compra->estado;

        $subtotalCompra = 0;

        $detallesNuevos = [];


        foreach (
            $request->producto_id
            as $i => $productoId
        ) {

            $cantidad =
                (int) $request->cantidad[$i];

            $precioUnitario =
                (float) $request->precio_unitario[$i];

            $subtotal =
                $cantidad * $precioUnitario;

            $subtotalCompra +=
                $subtotal;


            $detallesNuevos[] = [

                'producto_id' =>
                    $productoId,

                'cantidad' =>
                    $cantidad,

                'precio_unitario' =>
                    $precioUnitario,

                'subtotal' =>
                    $subtotal,

            ];

        }


        $iva =
            $subtotalCompra * 0.16;

        $total =
            $subtotalCompra + $iva;


        $compra->update([

            'proveedor_id' =>
                $request->proveedor_id,

            'fecha_compra' =>
                $request->fecha_compra,

            'subtotal' =>
                $subtotalCompra,

            'iva' =>
                $iva,

            'total' =>
                $total,

            'estado' =>
                $request->estado,

            'observaciones' =>
                $request->observaciones,

        ]);


        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR DETALLES DE LA COMPRA
        |--------------------------------------------------------------------------
        */

        $compra->detalles()->delete();


        foreach (
            $detallesNuevos
            as $detalle
        ) {

            $compra->detalles()->create(
                $detalle
            );

        }


        /*
        |--------------------------------------------------------------------------
        | ENTRADA A INVENTARIO
        |--------------------------------------------------------------------------
        |
        | Solo cuando cambia:
        |
        | pendiente -> recibida
        |
        */

        if (
            $estadoAnterior !== 'recibida'
            &&
            $request->estado === 'recibida'
        ) {

            foreach (
                $detallesNuevos
                as $detalle
            ) {

                $producto =
                    Producto::findOrFail(
                        $detalle['producto_id']
                    );

                $stockAnterior =
                    $producto->stock_actual;

                $stockNuevo =
                    $stockAnterior
                    +
                    $detalle['cantidad'];


                $producto->update([

                    'stock_actual' =>
                        $stockNuevo,

                ]);


                MovimientoInventario::create([

                    'producto_id' =>
                        $producto->id,

                    'tipo_movimiento' =>
                        'entrada',

                    'cantidad' =>
                        $detalle['cantidad'],

                    'stock_anterior' =>
                        $stockAnterior,

                    'stock_nuevo' =>
                        $stockNuevo,

                    'fecha_movimiento' =>
                        now(),

                    'user_id' =>
                        Auth::id(),

                    'referencia' =>
                        $compra->folio,

                    'motivo' =>
                        'Recepción de compra',

                    'observaciones' =>
                        $request->observaciones,

                    'origen' =>
                        'Compras',

                ]);

            }

        }


        LogActividad::create([

            'usuario' =>
                Auth::user()->rol,

            'accion' =>
                'Actualizó la compra '
                .
                $compra->folio,

        ]);

    });


    return redirect()
        ->route(
            'administracion.compras.index'
        )
        ->with(
            'success',
            'Compra actualizada correctamente.'
        );
}

    /**
     * Cancelar compra.
     */
    public function destroy(Compra $compra)
    {
        $compra->update([

            'estado' => 'cancelada',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Canceló la compra ' . $compra->folio,

        ]);

        return redirect()
            ->route('administracion.compras.index')
            ->with(
                'success',
                'Compra cancelada correctamente.'
            );
    }
}
