<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\RH\Prospecto;
use Illuminate\Http\Request;
use App\Models\RH\Empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\LogActividad;
use Illuminate\Support\Facades\DB;

class ProspectoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim(
            $request->input('buscar', '')
        );

        $prospectos = Prospecto::query()
            ->when(
                $buscar !== '',
                function ($consulta) use ($buscar) {

                    $consulta->where(
                        function ($query) use ($buscar) {

                            $query
                                ->where(
                                    'nombre',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'apellido_paterno',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'apellido_materno',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'correo',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'puesto_solicitado',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'estado',
                                    'like',
                                    '%' . $buscar . '%'
                                );

                        }
                    );

                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'rh.reclutamiento.index',
            compact(
                'prospectos',
                'buscar'
            )
        );
    }

    public function create()
    {
        return view(
            'rh.reclutamiento.create'
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            [
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

                'telefono' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'correo' => [
                    'nullable',
                    'email',
                    'max:150',
                    'unique:prospectos,correo',
                ],

                'puesto_solicitado' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'fecha_entrevista' => [
                    'nullable',
                    'date',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre es obligatorio.',

                'apellido_paterno.required' =>
                    'El apellido paterno es obligatorio.',

                'correo.email' =>
                    'El correo electrónico no tiene un formato válido.',

                'correo.unique' =>
                    'Ya existe un prospecto registrado con este correo.',

                'observaciones.max' =>
                    'Las observaciones no deben superar los 1,000 caracteres.',
            ]
        );


        $datos['nombre'] = trim(
            $datos['nombre']
        );

        $datos['apellido_paterno'] = trim(
            $datos['apellido_paterno']
        );

        $datos['apellido_materno'] =
            ! empty($datos['apellido_materno'])
                ? trim($datos['apellido_materno'])
                : null;


        $datos['telefono'] =
            ! empty($datos['telefono'])
                ? preg_replace(
                    '/\D/',
                    '',
                    $datos['telefono']
                )
                : null;


        $datos['correo'] =
            ! empty($datos['correo'])
                ? strtolower(
                    trim($datos['correo'])
                )
                : null;


        $datos['puesto_solicitado'] =
            ! empty($datos['puesto_solicitado'])
                ? trim($datos['puesto_solicitado'])
                : null;


        $datos['estado'] = 'pendiente';


        $prospecto = Prospecto::create(
            $datos
        );


        LogActividad::create([

            'usuario' => Auth::user()->rol,

            'accion' =>
                'Registró prospecto ' .
                $prospecto->nombre . ' ' .
                $prospecto->apellido_paterno,

        ]);


        return redirect()
            ->route('rh.prospectos.index')
            ->with(
                'success',
                'Prospecto registrado correctamente.'
            );
    }

    public function entrevistar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'entrevistado'
        ]);

        return back();
    }

    public function aprobar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'aprobado'
        ]);

        return back();
    }

    public function rechazar($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->update([
            'estado' => 'rechazado'
        ]);

        return back();
    }

    public function contratar($id)
    {
        $prospecto = Prospecto::findOrFail($id);


        if ($prospecto->estado !== 'aprobado') {

            return back()->with(
                'error',
                'Solamente pueden contratarse prospectos aprobados.'
            );

        }


        if (! $this->haySlotsDisponibles()) {

            return back()->with(
                'error',
                'No existen espacios disponibles para contratar un nuevo empleado.'
            );

        }


        $telefono = preg_replace(
            '/\D+/',
            '',
            $prospecto->telefono ?? ''
        );


        if (strlen($telefono) !== 10) {

            return back()->with(
                'error',
                'El teléfono del prospecto debe contener exactamente 10 dígitos.'
            );

        }


        $empleado = DB::transaction(function () use (
            $prospecto,
            $telefono
        ) {

            $empleado = Empleado::create([

                'numero_control' =>
                    $this->generarNumeroControl(),

                'nombre' =>
                    $prospecto->nombre,

                'apellido_paterno' =>
                    $prospecto->apellido_paterno,

                'apellido_materno' =>
                    $prospecto->apellido_materno,

                'telefono' =>
                    $telefono,

                'correo' =>
                    $prospecto->correo,

                'puesto' =>
                    $prospecto->puesto_solicitado,

                'fecha_ingreso' =>
                    now()->format('Y-m-d'),

                'estado' =>
                    'activo',

            ]);


            $prospecto->update([
                'estado' => 'contratado',
            ]);


            LogActividad::create([

                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Contrató al prospecto ' .
                    $prospecto->nombre .
                    ' y creó al empleado ' .
                    $empleado->numero_control,

            ]);


            return $empleado;

        });


        return redirect()
            ->route(
                'rh.empleados.edit',
                $empleado->id
            )
            ->with(
                'success',
                'Prospecto contratado correctamente. Completa ahora el expediente del empleado.'
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
