<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\Empleado;
use App\Models\RH\Vigencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ActividadService;


class VigenciaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTADO GENERAL
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $consulta = Vigencia::query()
            ->with('empleado');


        /*
        |--------------------------------------------------------------------------
        | BÚSQUEDA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('buscar')) {

            $buscar = trim(
                $request->buscar
            );

            $consulta->where(function ($query) use ($buscar) {

                $query
                    ->where(
                        'documento',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhereHas(
                        'empleado',
                        function ($empleado) use ($buscar) {

                            $empleado
                                ->where(
                                    'numero_control',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'nombre',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'apellido_paterno',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'apellido_materno',
                                    'like',
                                    "%{$buscar}%"
                                );

                        }
                    );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | PAGINACIÓN
        |--------------------------------------------------------------------------
        */

        $vigencias = $consulta
            ->orderBy(
                'fecha_vencimiento'
            )
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | INDICADORES
        |--------------------------------------------------------------------------
        */

        $hoy = today();

        $limite = today()
            ->addDays(30);

        $totalVigencias = Vigencia::count();

        $vigentes = Vigencia::whereDate(
            'fecha_vencimiento',
            '>',
            $limite
        )->count();

        $proximasAVencer = Vigencia::whereDate(
            'fecha_vencimiento',
            '>=',
            $hoy
        )
            ->whereDate(
                'fecha_vencimiento',
                '<=',
                $limite
            )
            ->count();

        $vencidas = Vigencia::whereDate(
            'fecha_vencimiento',
            '<',
            $hoy
        )->count();


        return view(
            'rh.vigencias.index',
            compact(
                'vigencias',
                'totalVigencias',
                'vigentes',
                'proximasAVencer',
                'vencidas'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULARIO DE REGISTRO
    |--------------------------------------------------------------------------
    */

    public function create($empleadoId)
    {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar vigencias para un empleado inactivo.'
                );

        }

        return view(
            'rh.vigencias.create',
            compact('empleado')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        $empleadoId
    ) {
        $empleado = Empleado::findOrFail(
            $empleadoId
        );

        if ($empleado->estado !== 'activo') {

            return redirect()
                ->route(
                    'rh.empleados.show',
                    $empleado->id
                )
                ->with(
                    'error',
                    'No puedes registrar vigencias para un empleado inactivo.'
                );

        }


        $datos = $request->validate(
            [
                'documento' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'otro_documento' => [
                    'nullable',
                    'required_if:documento,Otro',
                    'string',
                    'max:150',
                ],

                'fecha_vencimiento' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'evidencia' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120',
                ],
            ],
            [
                'documento.required' =>
                    'Debes seleccionar un documento.',

                'otro_documento.required_if' =>
                    'Debes escribir el nombre del documento.',

                'otro_documento.max' =>
                    'El nombre del documento no debe superar los 150 caracteres.',

                'fecha_vencimiento.required' =>
                    'La fecha de vencimiento es obligatoria.',

                'fecha_vencimiento.after_or_equal' =>
                    'La fecha de vencimiento no puede ser anterior al día de hoy.',

                'evidencia.mimes' =>
                    'La evidencia debe ser PDF, JPG, JPEG o PNG.',

                'evidencia.max' =>
                    'La evidencia no debe superar los 5 MB.',
            ]
        );


        $documento = $this->obtenerDocumento(
            $datos
        );


        $duplicado = Vigencia::where(
            'empleado_id',
            $empleado->id
        )
            ->where(
                'documento',
                $documento
            )
            ->whereDate(
                'fecha_vencimiento',
                $datos['fecha_vencimiento']
            )
            ->exists();


        if ($duplicado) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Esta vigencia ya fue registrada.'
                );

        }


        $rutaEvidencia = null;

        if ($request->hasFile('evidencia')) {

            $rutaEvidencia = $request
                ->file('evidencia')
                ->store(
                    'vigencias',
                    'public'
                );

        }


        try {

            DB::transaction(function () use (
                $empleado,
                $documento,
                $datos,
                $rutaEvidencia
            ) {

                $vigencia = Vigencia::create([
                    'empleado_id' =>
                        $empleado->id,

                    'documento' =>
                        $documento,

                    'fecha_vencimiento' =>
                        $datos['fecha_vencimiento'],

                    'evidencia' =>
                        $rutaEvidencia,
                ]);


                ActividadService::registrar(

                    'Registró la vigencia "'
                    . $vigencia->documento
                    . '" para el empleado '
                    . $empleado->numero_control,

                    null,

                    [

                        'id' =>
                            $vigencia->id,

                        'empleado_id' =>
                            $empleado->id,

                        'numero_control' =>
                            $empleado->numero_control,

                        'documento' =>
                            $vigencia->documento,

                        'fecha_emision' =>
                            $vigencia->fecha_emision,

                        'fecha_vencimiento' =>
                            $vigencia->fecha_vencimiento,

                        'estado' =>
                            $vigencia->estado,

                    ]

                );

            });

        } catch (\Throwable $error) {

            if (
                $rutaEvidencia &&
                Storage::disk('public')->exists(
                    $rutaEvidencia
                )
            ) {

                Storage::disk('public')->delete(
                    $rutaEvidencia
                );

            }

            throw $error;

        }


        return redirect()
            ->route(
                'rh.empleados.show',
                $empleado->id
            )
            ->with(
                'success',
                'Vigencia registrada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULARIO DE EDICIÓN
    |--------------------------------------------------------------------------
    */

    public function edit(Vigencia $vigencia)
    {
        $vigencia->load('empleado');

        return view(
            'rh.vigencias.edit',
            compact('vigencia')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Vigencia $vigencia
    ) {
        $vigencia->load('empleado');

        $datos = $request->validate(
            [
                'documento' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'otro_documento' => [
                    'nullable',
                    'required_if:documento,Otro',
                    'string',
                    'max:150',
                ],

                'fecha_vencimiento' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'evidencia' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120',
                ],
            ],
            [
                'documento.required' =>
                    'Debes seleccionar un documento.',

                'otro_documento.required_if' =>
                    'Debes escribir el nombre del documento.',

                'otro_documento.max' =>
                    'El nombre del documento no debe superar los 150 caracteres.',

                'fecha_vencimiento.required' =>
                    'La fecha de vencimiento es obligatoria.',

                'fecha_vencimiento.after_or_equal' =>
                    'La fecha de vencimiento no puede ser anterior al día de hoy.',

                'evidencia.mimes' =>
                    'La evidencia debe ser PDF, JPG, JPEG o PNG.',

                'evidencia.max' =>
                    'La evidencia no debe superar los 5 MB.',
            ]
        );


        $documento = $this->obtenerDocumento(
            $datos
        );


        /*
        |--------------------------------------------------------------------------
        | DUPLICADOS, IGNORANDO EL REGISTRO ACTUAL
        |--------------------------------------------------------------------------
        */

        $duplicado = Vigencia::where(
            'empleado_id',
            $vigencia->empleado_id
        )
            ->where(
                'documento',
                $documento
            )
            ->whereDate(
                'fecha_vencimiento',
                $datos['fecha_vencimiento']
            )
            ->where(
                'id',
                '!=',
                $vigencia->id
            )
            ->exists();


        if ($duplicado) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ya existe otra vigencia con el mismo documento y fecha.'
                );

        }


        $evidenciaAnterior =
            $vigencia->evidencia;

        $nuevaEvidencia = null;


        if ($request->hasFile('evidencia')) {

            $nuevaEvidencia = $request
                ->file('evidencia')
                ->store(
                    'vigencias',
                    'public'
                );

        }


        try {

            DB::transaction(function () use (
                $vigencia,
                $documento,
                $datos,
                $nuevaEvidencia
            ) {

                $vigencia->update([
                    'documento' =>
                        $documento,

                    'fecha_vencimiento' =>
                        $datos['fecha_vencimiento'],

                    'evidencia' =>
                        $nuevaEvidencia
                            ?? $vigencia->evidencia,
                ]);


                LogActividad::create([
                    'usuario' =>
                        Auth::user()->rol,

                    'accion' =>
                        'Actualizó la vigencia "' .
                        $vigencia->documento .
                        '" del empleado ' .
                        $vigencia->empleado->numero_control .
                        '.',
                ]);

            });


            /*
            |--------------------------------------------------------------------------
            | ELIMINAR EVIDENCIA ANTERIOR
            |--------------------------------------------------------------------------
            */

            if (
                $nuevaEvidencia &&
                $evidenciaAnterior &&
                $evidenciaAnterior !== $nuevaEvidencia &&
                Storage::disk('public')->exists(
                    $evidenciaAnterior
                )
            ) {

                Storage::disk('public')->delete(
                    $evidenciaAnterior
                );

            }

        } catch (\Throwable $error) {

            /*
            |--------------------------------------------------------------------------
            | ELIMINAR ARCHIVO NUEVO SI FALLA LA OPERACIÓN
            |--------------------------------------------------------------------------
            */

            if (
                $nuevaEvidencia &&
                Storage::disk('public')->exists(
                    $nuevaEvidencia
                )
            ) {

                Storage::disk('public')->delete(
                    $nuevaEvidencia
                );

            }

            throw $error;

        }


        return redirect()
            ->route('rh.vigencias.index')
            ->with(
                'success',
                'Vigencia actualizada correctamente.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZAR DOCUMENTO
    |--------------------------------------------------------------------------
    */

    private function obtenerDocumento(
        array $datos
    ): string {
        $documento = $datos['documento'] === 'Otro'
            ? trim($datos['otro_documento'] ?? '')
            : trim($datos['documento']);

        return preg_replace(
            '/\s+/',
            ' ',
            $documento
        );
    }
}