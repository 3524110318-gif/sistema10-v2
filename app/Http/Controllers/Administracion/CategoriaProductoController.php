<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administracion\CategoriaProducto;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoriaProductoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $categorias = CategoriaProducto::query();

        if ($buscar) {
            $categorias->where(
                'nombre',
                'like',
                "%{$buscar}%"
            );
        }

        $categorias = $categorias
            ->orderBy('nombre')
            ->paginate(10);

        $totalCategorias = CategoriaProducto::count();

        return view(
            'administracion.categorias.index',
            compact(
                'categorias',
                'totalCategorias'
            )
        );
    }

    public function create()
    {
        return view(
            'administracion.categorias.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                'unique:categorias_productos,nombre',
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        $categoria = CategoriaProducto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => 'activo',
        ]);

        LogActividad::create([
            'usuario' => Auth::user()->rol,
            'accion' => 'Creó la categoría ' . $categoria->nombre,
        ]);

        return redirect()
            ->route('administracion.categorias.index')
            ->with(
                'success',
                'Categoría registrada correctamente.'
            );
    }

    public function edit(CategoriaProducto $categoria)
    {
        return view(
            'administracion.categorias.edit',
            compact('categoria')
        );
    }

    public function update(Request $request, CategoriaProducto $categoria)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique(
                    'categorias_productos',
                    'nombre'
                )->ignore($categoria->id),
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        LogActividad::create([
            'usuario' => Auth::user()->rol,
            'accion' => 'Actualizó la categoría ' . $categoria->nombre,
        ]);

        return redirect()
            ->route('administracion.categorias.index')
            ->with(
                'success',
                'Categoría actualizada correctamente.'
            );
    }

    public function destroy(CategoriaProducto $categoria)
    {
        $categoria->update([
            'estado' => $categoria->estado == 'activo'
                ? 'inactivo'
                : 'activo'
        ]);

        LogActividad::create([
            'usuario' => Auth::user()->rol,
            'accion' => 'Cambió el estado de la categoría ' . $categoria->nombre,
        ]);

        return redirect()
            ->route('administracion.categorias.index')
            ->with(
                'success',
                'Estado de la categoría actualizado correctamente.'
            );
    }
}
