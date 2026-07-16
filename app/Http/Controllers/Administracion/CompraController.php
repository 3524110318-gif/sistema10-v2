<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\Compra;
use App\Models\Administracion\Proveedor;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\LogActividad;

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

        return view(
            'administracion.compras.create',
            compact(
                'proveedores'
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

        ]);

        $ultimoId = Compra::max('id') + 1;

        $folio = 'COMP-' . str_pad(
            $ultimoId,
            5,
            '0',
            STR_PAD_LEFT
        );

        $compra = Compra::create([

            'proveedor_id' => $request->proveedor_id,

            'folio' => $folio,

            'fecha_compra' => $request->fecha_compra,

            'subtotal' => 0,

            'iva' => 0,

            'total' => 0,

            'estado' => $request->estado,

            'observaciones' => $request->observaciones,

            'user_id' => Auth::id(),

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Creó la compra ' . $compra->folio,

        ]);

        return redirect()
            ->route('administracion.compras.index')
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
            'usuario'
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
        $proveedores = Proveedor::where(
            'estado',
            'activo'
        )
        ->orderBy('razon_social')
        ->get();

        return view(
            'administracion.compras.edit',
            compact(
                'compra',
                'proveedores'
            )
        );
    }

    /**
     * Actualizar compra.
     */
    public function update(
        Request $request,
        Compra $compra
    )
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

        ]);

        $compra->update([

            'proveedor_id' => $request->proveedor_id,

            'fecha_compra' => $request->fecha_compra,

            'estado' => $request->estado,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Actualizó la compra ' . $compra->folio,

        ]);

        return redirect()
            ->route('administracion.compras.index')
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
