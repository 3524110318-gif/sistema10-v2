<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $empleados = Empleado::where(
            'estado',
            'activo'
        );
        if ($buscar) {
            $empleados->where(
                'numero_control',
                'like',
                "%{$buscar}%"
            );
        }
        $empleados = $empleados->paginate(10);
        return view(
            'rh.empleados.index',
            compact('empleados')
        );
    }


    public function create()
    {
        return view('rh.empleados.create');
    }

    public function store(Request $request)
    {
        $this->validarEmpleado($request);

        $totalEmpleados = Empleado::count() + 1;
        $numeroControl = 'GTRI' . str_pad($totalEmpleados, 4, '0', STR_PAD_LEFT);
        $nombreFoto = null;
        if ($request->hasFile('foto')) {
            $nombreFoto = time() . '.' .
                $request->foto->extension();
            $request->foto->move(
                public_path('fotos_empleados'),
                $nombreFoto
            );
        }
        Empleado::create([
            'numero_control' => $numeroControl,
            'foto' => $nombreFoto,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'curp' => $request->curp,
            'rfc' => $request->rfc,
            'nss' => $request->nss,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'tipo_sangre' => $request->tipo_sangre,
            'puesto' => $request->puesto,
            'rango' => $request->rango,
            'salario_base' => $request->salario_base,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => 'activo',
            'direccion' => $request->direccion,
            'contacto_emergencia' => $request->contacto_emergencia,
            'telefono_emergencia' => $request->telefono_emergencia,
        ]);

        LogActividad::create([
            'usuario' => Auth::user()->rol,
            'accion' => 'Creó empleado ' . $numeroControl,
        ]);

        return redirect()
        ->route('rh.empleados')
        ->with(
            'success',
            'Empleado creado correctamente'
        );
    }


    public function show($id)
    {
        $empleado = Empleado::with([
            'documentos',
            'vacacionesEmpleado',
            'incidencias'
        ])->findOrFail($id);

        $documentos = $empleado->documentos;

        $documentosCompletos = $documentos->count();

        $totalDocumentos = count(
            Empleado::DOCUMENTOS_RH
        );

        $porcentajeDocumentos = round(
            (
                $documentosCompletos
                /
                $totalDocumentos
            ) * 100
        );

        return view(
            'rh.empleados.show',
            [
                'empleado' => $empleado,
                'documentos' => $documentos,
                'documentosRH' => Empleado::DOCUMENTOS_RH,
                'porcentajeDocumentos' => $porcentajeDocumentos,

                'vacaciones' => $empleado
                    ->vacacionesEmpleado
                    ->sortByDesc('fecha_inicio'),

                'incidencias' => $empleado
                    ->incidencias
                    ->sortByDesc('fecha'),

                'uniformes' => $empleado
                    ->uniformes
                    ->sortByDesc('fecha_entrega'),

                'vigencias' => $empleado
                    ->vigencias
                    ->sortBy('fecha_vencimiento'),

                'capacitaciones' => $empleado
                    ->capacitaciones
                    ->sortByDesc('fecha_capacitacion'),
            ]
        );
    }

    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view(
            'rh.empleados.edit',
            compact('empleado')
        );
    }


    public function update(Request $request, $id)
    {
        $this->validarEmpleado($request);
        $empleado = Empleado::findOrFail($id);
        $nombreFoto = $this->subirFoto(
            $request,
            $empleado->foto
        );
        $empleado->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'curp' => $request->curp,
            'rfc' => $request->rfc,
            'nss' => $request->nss,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'tipo_sangre' => $request->tipo_sangre,
            'puesto' => $request->puesto,
            'rango' => $request->rango,
            'salario_base' => $request->salario_base,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'direccion' => $request->direccion,
            'contacto_emergencia' => $request->contacto_emergencia,
            'telefono_emergencia' => $request->telefono_emergencia,
            'foto' => $nombreFoto,
        ]);

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Actualizó empleado ' .

                $empleado->numero_control,

        ]);
        return redirect()
        ->route('rh.empleados')
        ->with(
            'success',
            'Empleado actualizado correctamente'
        );
    }

    public function baja($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->cambiarEstado(
            $id,
            'inactivo'
        );

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Dio de baja empleado ' .

                $empleado->numero_control,

        ]);

        return redirect()
            ->route('rh.empleados')
            ->with(
                'success',
                'Empleado dado de baja correctamente'
            );
    }

    public function inactivos()
    {
        $empleados = Empleado::where(
            'estado','inactivo'
        )->get();
        return view(
            'rh.empleados.inactivos',
            compact('empleados')
        );
    }

    public function reactivar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $this->cambiarEstado($id,'activo');

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Reactivó empleado ' .

                $empleado->numero_control,

        ]);
        return redirect()
        ->route('rh.empleados.inactivos')
        ->with(
            'success',
            'Empleado reactivado correctamente'
        );
    }

    private function validarEmpleado($request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'apellido_paterno' => 'required|max:100',
            'apellido_materno' => 'required|max:100',
            'curp' => 'required|size:18',
            'rfc' => 'required|min:12|max:13',
            'nss' => 'required|digits:11',
            'telefono' => 'required|digits:10',
            'correo' => 'required|email',
            'tipo_sangre' => 'required|max:5',
            'puesto' => 'required|max:100',
            'rango' => 'required|max:100',
            'salario_base' => 'required|numeric|min:1',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'direccion' => 'required|max:255',
            'contacto_emergencia' => 'required|max:100',
            'telefono_emergencia' => 'required|digits:10',
        ]);
    }

    private function subirFoto($request, $fotoActual = null)
    {
        if ($request->hasFile('foto')) {
            $nombreFoto = time() . '.' .
                $request->foto->extension();
            $request->foto->move(
                public_path('fotos_empleados'),
                $nombreFoto
            );
            return $nombreFoto;
        }
        return $fotoActual;
    }

    private function cambiarEstado($id, $estado)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->update([
            'estado' => $estado
        ]);
    }

    public function fichaTecnica($id)
    {
        $empleado = Empleado::with('documentos')->findOrFail($id);
        $pdf = Pdf::loadView(

            'rh.empleados.ficha',

            compact('empleado')

        );
        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Generó ficha técnica de ' .

                $empleado->numero_control,

        ]);

        return $pdf->stream(

            'ficha-tecnica.pdf'

        );
    }

    public function credencial($id)
    {
        $empleado = Empleado::findOrFail($id);

            $pdf = Pdf::loadView(
            'rh.empleados.credencial',
            compact('empleado')
        );
        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' => 'Generó credencial de ' .

                $empleado->numero_control,

        ]);

        return $pdf->stream(
            'credencial.pdf'
        );
    }
}
