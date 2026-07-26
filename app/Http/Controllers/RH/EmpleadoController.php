<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
        $datos = $this->validarEmpleado($request);

        if (! $this->haySlotsDisponibles()) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Se alcanzó el límite de 1,000 empleados activos. Debe liberarse un slot antes de registrar uno nuevo.'
                );

        }
        $datos['numero_control'] = $this->generarNumeroControl();
        $datos['estado'] = 'activo';

        $datos['foto'] = null;

        if ($request->hasFile('foto')) {

            $nombreFoto = time() . '.' . $request->foto->extension();

            $request->foto->move(
                public_path('fotos_empleados'),
                $nombreFoto
            );

            $datos['foto'] = $nombreFoto;

        }

        DB::transaction(function () use ($datos) {

            $empleado = Empleado::create($datos);

            LogActividad::create([

                'usuario' => Auth::user()->rol,

                'accion' => 'Creó empleado ' .
                    $empleado->numero_control,

            ]);

        });

        return redirect()
            ->route('rh.empleados')
            ->with(
                'success',
                'Empleado creado correctamente.'
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
        $empleado = Empleado::findOrFail($id);

        $datos = $this->validarEmpleado(
            $request,
            $empleado->id
        );

        $datos['foto'] = $this->subirFoto(
            $request,
            $empleado->foto
        );

        DB::transaction(function () use (
            $empleado,
            $datos
        ) {

            $empleado->update($datos);

            LogActividad::create([

                'usuario' => Auth::user()->rol,

                'accion' =>
                    'Actualizó empleado ' .
                    $empleado->numero_control,

            ]);

        });

        return redirect()
            ->route('rh.empleados')
            ->with(
                'success',
                'Empleado actualizado correctamente.'
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

        if ($empleado->estado === 'activo') {

            return back()->with(
                'error',
                'El empleado ya se encuentra activo.'
            );

        }

        if (! $this->haySlotsDisponibles()) {

            return back()->with(
                'error',
                'No existen slots disponibles para reactivar este empleado.'
            );

        }

        $this->cambiarEstado(
            $empleado->id,
            'activo'
        );

        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>
                'Reactivó al empleado ' .
                $empleado->numero_control,

        ]);

        return redirect()
            ->route('rh.empleados')
            ->with(
                'success',
                'Empleado reactivado correctamente.'
            );
    }

    private function validarEmpleado(Request $request, ?int $empleadoId = null): array 
    {

        $request->merge([

            'telefono' => $request->filled('telefono')
                ? str_replace(
                    [' ', '-'],
                    '',
                    trim($request->telefono)
                )
                : null,

            'telefono_emergencia' => $request->filled('telefono_emergencia')
                ? str_replace(
                    [' ', '-'],
                    '',
                    trim($request->telefono_emergencia)
                )
                : null,

            'salario_base' => $request->filled('salario_base')
                ? str_replace(
                    ['$', ',', ' '],
                    '',
                    $request->salario_base
                )
                : null,

            'curp' => $request->filled('curp')
                ? strtoupper(
                    trim($request->curp)
                )
                : null,

            'rfc' => $request->filled('rfc')
                ? strtoupper(
                    trim($request->rfc)
                )
                : null,

            'nss' => $request->filled('nss')
                ? trim($request->nss)
                : null,

        ]);

        return $request->validate([

            'nombre' => [
                'required',
                'string',
                'max:100',
            ],

            'apellido_paterno' => [
                'required',
                'string',
                'max:100',
            ],

            'apellido_materno' => [
                'nullable',
                'string',
                'max:100',
            ],

            'curp' => [
                'required',
                'string',
                'size:18',
                Rule::unique(
                    'empleados',
                    'curp'
                )->ignore($empleadoId),
            ],

            'rfc' => [
                'required',
                'string',
                'min:12',
                'max:13',
                Rule::unique(
                    'empleados',
                    'rfc'
                )->ignore($empleadoId),
            ],

            'nss' => [
                'required',
                'string',
                'size:11',
                Rule::unique(
                    'empleados',
                    'nss'
                )->ignore($empleadoId),
            ],

            'telefono' => [
                'required',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:150',
                Rule::unique(
                    'empleados',
                    'correo'
                )->ignore($empleadoId),
            ],

            'tipo_sangre' => [
                'required',
                'string',
                'max:5',
            ],

            'puesto' => [
                'required',
                'string',
                'max:100',
            ],

            'rango' => [
                'required',
                'string',
                'max:100',
            ],

            'salario_base' => [
                'required',
                'numeric',
                'min:0',
            ],

            'fecha_nacimiento' => [
                'required',
                'date',
                'before:today',
            ],

            'fecha_ingreso' => [
                'required',
                'date',
            ],

            'direccion' => [
                'required',
                'string',
                'max:255',
            ],

            'contacto_emergencia' => [
                'required',
                'string',
                'max:100',
            ],

            'telefono_emergencia' => [
                'required',
                'string',
                'max:20',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ], [

            'nombre.required' =>
                'El nombre es obligatorio.',

            'apellido_paterno.required' =>
                'El apellido paterno es obligatorio.',

            'curp.required' =>
                'La CURP es obligatoria.',

            'curp.size' =>
                'La CURP debe contener exactamente 18 caracteres.',

            'curp.unique' =>
                'La CURP ya está registrada en otro empleado.',

            'rfc.required' =>
                'El RFC es obligatorio.',

            'rfc.min' =>
                'El RFC debe contener al menos 12 caracteres.',

            'rfc.max' =>
                'El RFC no debe superar los 13 caracteres.',

            'rfc.unique' =>
                'El RFC ya está registrado en otro empleado.',

            'nss.required' =>
                'El NSS es obligatorio.',

            'nss.size' =>
                'El NSS debe contener exactamente 11 caracteres.',

            'nss.unique' =>
                'El NSS ya está registrado en otro empleado.',

            'telefono.required' =>
                'El teléfono es obligatorio.',

            'correo.email' =>
                'El correo no tiene un formato válido.',

            'correo.unique' =>
                'El correo ya está registrado en otro empleado.',

            'tipo_sangre.required' =>
                'El tipo de sangre es obligatorio.',

            'puesto.required' =>
                'El puesto es obligatorio.',

            'rango.required' =>
                'El rango es obligatorio.',

            'salario_base.required' =>
                'El salario base es obligatorio.',

            'salario_base.numeric' =>
                'El salario base debe ser numérico.',

            'salario_base.min' =>
                'El salario base no puede ser negativo.',

            'fecha_nacimiento.required' =>
                'La fecha de nacimiento es obligatoria.',

            'fecha_nacimiento.before' =>
                'La fecha de nacimiento debe ser anterior al día de hoy.',

            'fecha_ingreso.required' =>
                'La fecha de ingreso es obligatoria.',

            'direccion.required' =>
                'La dirección es obligatoria.',

            'contacto_emergencia.required' =>
                'El contacto de emergencia es obligatorio.',

            'telefono_emergencia.required' =>
                'El teléfono de emergencia es obligatorio.',

            'foto.image' =>
                'El archivo seleccionado debe ser una imagen.',

            'foto.mimes' =>
                'La fotografía debe ser JPG, JPEG, PNG o WEBP.',

            'foto.max' =>
                'La fotografía no debe superar los 2 MB.',

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

    private function generarNumeroControl(): string
    {
        $ultimoEmpleado = Empleado::where(
            'numero_control',
            'like',
            'GTRI%'
        )
            ->orderByDesc('numero_control')
            ->first();

        if (!$ultimoEmpleado) {

            $siguienteNumero = 1;

        } else {

            $ultimoNumero = (int) str_replace(
                'GTRI',
                '',
                $ultimoEmpleado->numero_control
            );

            $siguienteNumero = $ultimoNumero + 1;

        }

        return 'GTRI' . str_pad(
            $siguienteNumero,
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    private function haySlotsDisponibles(): bool
    {
        return Empleado::where(
            'estado',
            'activo'
        )->count() < 1000;
    }
}
