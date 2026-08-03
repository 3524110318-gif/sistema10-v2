<?php

namespace App\Http\Controllers\RH;

use App\Http\Controllers\Controller;
use App\Models\Administracion\LogActividad;
use App\Models\RH\CalendarioLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Services\ActividadService;

class CalendarioLaboralController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim(
            $request->input('buscar', '')
        );

        $dias = CalendarioLaboral::query()
            ->when(
                $buscar !== '',
                function ($consulta) use ($buscar) {

                    $consulta->where(
                        function ($query) use ($buscar) {

                            $query
                                ->where(
                                    'fecha',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'tipo',
                                    'like',
                                    '%' . $buscar . '%'
                                )
                                ->orWhere(
                                    'descripcion',
                                    'like',
                                    '%' . $buscar . '%'
                                );

                        }
                    );

                }
            )
            ->orderBy(
                'fecha',
                'desc'
            )
            ->paginate(10)
            ->withQueryString();


        $totalDias = CalendarioLaboral::count();

        $totalFestivos = CalendarioLaboral::where(
            'tipo',
            'festivo'
        )->count();

        $totalDescansos = CalendarioLaboral::where(
            'tipo',
            'descanso'
        )->count();

        $totalVacaciones = CalendarioLaboral::where(
            'tipo',
            'vacaciones'
        )->count();

        $totalLaborales = CalendarioLaboral::where(
            'tipo',
            'laboral'
        )->count();

        return view(
            'rh.calendario.index',
            compact(
                'dias',
                'buscar',
                'totalDias',
                'totalFestivos',
                'totalDescansos',
                'totalVacaciones',
                'totalLaborales',
            )
        );
    }

    public function create()
    {
        return view(
            'rh.calendario.create'
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'fecha' => [
                    'required',
                    'date',
                    'unique:calendario_laboral,fecha',
                ],

                'tipo' => [
                    'required',
                    Rule::in([
                        'laboral',
                        'descanso',
                        'festivo',
                        'vacaciones',
                    ]),
                ],

                'descripcion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
            ],
            [
                'fecha.required' =>
                    'La fecha es obligatoria.',

                'fecha.date' =>
                    'La fecha seleccionada no es válida.',

                'fecha.unique' =>
                    'Esta fecha ya está registrada en el calendario laboral.',

                'tipo.required' =>
                    'Debes seleccionar el tipo de día.',

                'tipo.in' =>
                    'El tipo de día seleccionado no es válido.',

                'descripcion.string' =>
                    'La descripción no es válida.',

                'descripcion.max' =>
                    'La descripción no debe superar los 255 caracteres.',
            ]
        );

        DB::transaction(function () use ($datos) {

            $dia = CalendarioLaboral::create([
                'fecha' =>
                    $datos['fecha'],

                'tipo' =>
                    $datos['tipo'],

                'descripcion' =>
                    isset($datos['descripcion'])
                        ? trim($datos['descripcion'])
                        : null,
            ]);

            ActividadService::registrar(

                'Registró el día '
                . $dia->fecha
                . ' como '
                . $dia->tipo
                . ' en el calendario laboral',

                null,

                [

                    'id' => $dia->id,

                    'fecha' =>
                        $dia->fecha,

                    'tipo' =>
                        $dia->tipo,

                    'descripcion' =>
                        $dia->descripcion,

                ]

            );

        });

        return redirect()
            ->route('rh.calendario.index')
            ->with(
                'success',
                'Día registrado correctamente.'
            );
    }

    public function edit(CalendarioLaboral $calendario)
    {
        return view(
            'rh.calendario.edit',
            compact('calendario')
        );
    }

    public function update(Request $request,CalendarioLaboral $calendario) 
    {
        $datos = $request->validate(
            [
                'fecha' => [
                    'required',
                    'date',
                    Rule::unique(
                        'calendario_laboral',
                        'fecha'
                    )->ignore($calendario->id),
                ],

                'tipo' => [
                    'required',
                    Rule::in([
                        'laboral',
                        'descanso',
                        'festivo',
                        'vacaciones',
                    ]),
                ],

                'descripcion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
            ],
            [
                'fecha.required' =>
                    'La fecha es obligatoria.',

                'fecha.date' =>
                    'La fecha seleccionada no es válida.',

                'fecha.unique' =>
                    'Esta fecha ya está registrada en el calendario laboral.',

                'tipo.required' =>
                    'Debes seleccionar el tipo de día.',

                'tipo.in' =>
                    'El tipo de día seleccionado no es válido.',

                'descripcion.string' =>
                    'La descripción no es válida.',

                'descripcion.max' =>
                    'La descripción no debe superar los 255 caracteres.',
            ]
        );

        DB::transaction(function () use (
            $datos,
            $calendario
        ) {

            $calendario->update([
                'fecha' =>
                    $datos['fecha'],

                'tipo' =>
                    $datos['tipo'],

                'descripcion' =>
                    isset($datos['descripcion'])
                        ? trim($datos['descripcion'])
                        : null,
            ]);

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Actualizó el día ' .
                    $calendario->fecha .
                    ' como ' .
                    $calendario->tipo .
                    ' en el calendario laboral',
            ]);
        });

        return redirect()
            ->route('rh.calendario.index')
            ->with(
                'success',
                'Día actualizado correctamente.'
            );
    }

    public function destroy(CalendarioLaboral $calendario)
    {
        DB::transaction(function () use ($calendario) {

            $fecha = $calendario->fecha;
            $tipo = $calendario->tipo;

            $calendario->delete();

            LogActividad::create([
                'usuario' =>
                    Auth::user()->rol,

                'accion' =>
                    'Eliminó el día ' .
                    $fecha .
                    ' registrado como ' .
                    $tipo .
                    ' del calendario laboral',
            ]);
        });

        return redirect()
            ->route('rh.calendario.index')
            ->with(
                'success',
                'Día eliminado correctamente.'
            );
    }
}