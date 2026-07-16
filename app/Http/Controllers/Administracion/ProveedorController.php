<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\Administracion\Proveedor;
use App\Models\Administracion\LogActividad;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $proveedores = Proveedor::query();

        if ($buscar) {

            $proveedores->where(
                'razon_social',
                'like',
                "%{$buscar}%"
            );

        }

        $proveedores = $proveedores
            ->orderBy('razon_social')
            ->paginate(10);

        $totalProveedores = Proveedor::count();

        return view(
            'administracion.proveedores.index',
            compact(
                'proveedores',
                'totalProveedores'
            )
        );
    }

    public function create()
    {
        return view(
            'administracion.proveedores.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'razon_social' => 'required|max:255',

            'rfc' => 'required|max:13|unique:proveedores,rfc',

            'nombre_contacto' => 'required|max:255',

            'telefono' => 'required|max:20',

            'correo' => 'nullable|email|max:255',

            'direccion' => 'required|max:255',

            'ciudad' => 'required|max:100',

            'codigo_postal' => 'required|max:10',

            'observaciones' => 'nullable|max:500',

        ]);

        $proveedor = Proveedor::create([

            'razon_social' => $request->razon_social,

            'rfc' => $request->rfc,

            'nombre_contacto' => $request->nombre_contacto,

            'telefono' => $request->telefono,

            'correo' => $request->correo,

            'direccion' => $request->direccion,

            'ciudad' => $request->ciudad,

            'codigo_postal' => $request->codigo_postal,

            'estado' => 'activo',

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Registró el proveedor ' . $proveedor->razon_social,

        ]);

        return redirect()
            ->route('administracion.proveedores.index')
            ->with(
                'success',
                'Proveedor registrado correctamente.'
            );
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Proveedor $proveedor)
    {
        return view(
            'administracion.proveedores.edit',
            compact('proveedor')
        );
    }

    public function update(
        Request $request,
        Proveedor $proveedor
    ) {

        $request->validate([

            'razon_social' => 'required|max:255',

            'rfc' => [

                'required',

                'max:13',

                Rule::unique(
                    'proveedores',
                    'rfc'
                )->ignore($proveedor->id),

            ],

            'nombre_contacto' => 'required|max:255',

            'telefono' => 'required|max:20',

            'correo' => 'nullable|email|max:255',

            'direccion' => 'required|max:255',

            'ciudad' => 'required|max:100',

            'codigo_postal' => 'required|max:10',

            'observaciones' => 'nullable|max:500',

        ]);

        $proveedor->update([

            'razon_social' => $request->razon_social,

            'rfc' => $request->rfc,

            'nombre_contacto' => $request->nombre_contacto,

            'telefono' => $request->telefono,

            'correo' => $request->correo,

            'direccion' => $request->direccion,

            'ciudad' => $request->ciudad,

            'codigo_postal' => $request->codigo_postal,

            'observaciones' => $request->observaciones,

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Actualizó el proveedor ' . $proveedor->razon_social,

        ]);

        return redirect()
            ->route('administracion.proveedores.index')
            ->with(
                'success',
                'Proveedor actualizado correctamente.'
            );
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->update([

            'estado' => $proveedor->estado == 'activo'
                ? 'inactivo'
                : 'activo',

        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Cambió el estado del proveedor ' . $proveedor->razon_social,

        ]);

        return redirect()
            ->route('administracion.proveedores.index')
            ->with(
                'success',
                'Estado del proveedor actualizado correctamente.'
            );
    }
}
