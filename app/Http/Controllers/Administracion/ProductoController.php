<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\Producto;
use App\Models\Administracion\CategoriaProducto;
use App\Models\Administracion\LogActividad;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $productos = Producto::with('categoria')
            ->withSum(
                'entregasUniforme as cantidad_en_uso',
                'cantidad'
            )
            ->withCount([

                'activos as activos_en_bodega' => function ($query) {

                    $query->where(
                        'estado',
                        'disponible'
                    );

                },

                'activos as activos_en_uso' => function ($query) {

                    $query->where(
                        'estado',
                        'asignado'
                    );

                },

            ]);

        if ($buscar) {

            $productos->where(function ($query) use ($buscar) {

                $query->where(
                    'nombre',
                    'like',
                    "%{$buscar}%"
                )
                ->orWhere(
                    'codigo',
                    'like',
                    "%{$buscar}%"
                );

            });

        }

        $productos = $productos
            ->orderBy('nombre')
            ->paginate(10);

        $totalProductos = Producto::count();

        $productosStockCritico = Producto::where(
            'estado',
            'activo'
        )
        ->whereColumn(
            'stock_actual',
            '<=',
            'stock_minimo'
        )
        ->count();

        return view(
            'administracion.productos.index',
            compact(
                'productos',
                'totalProductos',
                'productosStockCritico'
            )
        );
    }

    public function create()
    {
        $categorias = CategoriaProducto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.productos.create',
            compact('categorias')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'categoria_producto_id' => 'required|exists:categorias_productos,id',

            'codigo' => 'required|max:100|unique:productos,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable|max:500',

            'unidad_medida' => 'required',

            'stock_minimo' => 'required|integer|min:0',

            'precio_compra' => 'required|numeric|min:0',

            'tipo_producto' => 'required|in:consumible,activo',

            'stock_maximo' => 'nullable|integer|min:0',

            'precio_promedio' => 'nullable|numeric|min:0',

        ]);

        $producto = Producto::create([

            'categoria_producto_id' => $request->categoria_producto_id,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'unidad_medida' => $request->unidad_medida,

            'stock_actual' => 0,

            'stock_minimo' => $request->stock_minimo,

            'precio_compra' => $request->precio_compra,

            'estado' => 'activo',

            'tipo_producto' => $request->tipo_producto,

            'stock_maximo' =>
                $request->stock_maximo,

            'precio_promedio' =>
                $request->precio_promedio ?? $request->precio_compra,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Creó el producto ' . $producto->nombre,

        ]);

        return redirect()
            ->route('administracion.productos.index')
            ->with(
                'success',
                'Producto registrado correctamente.'
            );
    }

    public function show(Producto $producto)
    {
        $producto->load('categoria');

        $cantidadEnUso = $producto
            ->entregasUniforme()
            ->sum('cantidad');

        $activosEnBodega = $producto
            ->activos()
            ->where('estado', 'disponible')
            ->count();

        $activosEnUso = $producto
            ->activos()
            ->where('estado', 'asignado')
            ->count();

        if ($producto->tipo_producto === 'activo') {

            $enBodega = $activosEnBodega;

            $enUso = $activosEnUso;

            $total = $activosEnBodega
                + $activosEnUso;

        } else {

            $enBodega = $producto->stock_actual;

            $enUso = $cantidadEnUso;

            $total = $producto->stock_actual
                + $cantidadEnUso;

        }

        return view(
            'administracion.productos.show',
            compact(
                'producto',
                'enBodega',
                'enUso',
                'total'
            )
        );
    }

    public function edit(Producto $producto)
    {
        $categorias = CategoriaProducto::where(
            'estado',
            'activo'
        )
        ->orderBy('nombre')
        ->get();

        return view(
            'administracion.productos.edit',
            compact(
                'producto',
                'categorias'
            )
        );
    }

    public function update(Request $request,Producto $producto) 
    {
        $request->validate([

            'categoria_producto_id' => 'required|exists:categorias_productos,id',

            'codigo' => [
                'required',
                'max:100',
                Rule::unique(
                    'productos',
                    'codigo'
                )->ignore($producto->id),
            ],

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable|max:500',

            'unidad_medida' => 'required',

            'stock_minimo' => 'required|integer|min:0',

            'precio_compra' => 'required|numeric|min:0',

            'tipo_producto' => 'required|in:consumible,activo',

            'stock_maximo' => 'nullable|integer|min:0',

            'precio_promedio' => 'nullable|numeric|min:0',

        ]);

        $producto->update([

            'categoria_producto_id' => $request->categoria_producto_id,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'unidad_medida' => $request->unidad_medida,

            'stock_minimo' => $request->stock_minimo,

            'precio_compra' => $request->precio_compra,

            'tipo_producto' => $request->tipo_producto,

            'stock_maximo' =>
                $request->stock_maximo,

            'precio_promedio' =>
                $request->precio_promedio ?? $request->precio_compra,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Actualizó el producto ' . $producto->nombre,

        ]);

        return redirect()
            ->route('administracion.productos.index')
            ->with(
                'success',
                'Producto actualizado correctamente.'
            );
    }

    public function destroy(Producto $producto)
    {
        $producto->update([

            'estado' => $producto->estado == 'activo'
                ? 'inactivo'
                : 'activo',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Cambió el estado del producto ' . $producto->nombre,

        ]);

        return redirect()
            ->route('administracion.productos.index')
            ->with(
                'success',
                'Estado del producto actualizado correctamente.'
            );
    }

}
