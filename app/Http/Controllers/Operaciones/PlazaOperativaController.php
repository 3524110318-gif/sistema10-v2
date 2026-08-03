<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\Operaciones\Servicio;
use Illuminate\Http\Request;
use App\Services\ActividadService;

class PlazaOperativaController extends Controller
{
    public function index()
    {
        $plazas = PlazaOperativa::with(
            'servicio'
        )->latest()->get();

        return view(
            'operaciones.plazas.index',
            compact('plazas')
        );
    }

    public function create()
    {
        $servicios = Servicio::where(
            'estado',
            'activo'
        )->get();

        return view(
            'operaciones.plazas.create',
            compact('servicios')
        );
    }

    public function store(
    Request $request
    )
    {
        $datos = $request->validate(
            [

                'servicio_id' => [
                    'required',
                    'integer',
                    'exists:servicios,id',
                ],

                'nombre_plaza' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'turno' => [
                    'required',
                    'in:diurno,nocturno,mixto',
                ],

                'hora_entrada' => [
                    'required',
                    'date_format:H:i',
                ],

                'hora_salida' => [
                    'required',
                    'date_format:H:i',
                ],

            ],
            [

                'servicio_id.required' =>
                    'Debes seleccionar un servicio.',

                'servicio_id.exists' =>
                    'El servicio seleccionado no existe.',

                'nombre_plaza.required' =>
                    'Debes ingresar el nombre de la plaza.',

                'nombre_plaza.max' =>
                    'El nombre de la plaza no debe superar los 150 caracteres.',

                'turno.required' =>
                    'Debes seleccionar un turno.',

                'turno.in' =>
                    'El turno seleccionado no es válido.',

                'hora_entrada.required' =>
                    'Debes ingresar la hora de entrada.',

                'hora_entrada.date_format' =>
                    'La hora de entrada no tiene un formato válido.',

                'hora_salida.required' =>
                    'Debes ingresar la hora de salida.',

                'hora_salida.date_format' =>
                    'La hora de salida no tiene un formato válido.',

            ]
        );


        $plaza = PlazaOperativa::create(
            [

                'servicio_id' =>
                    $datos['servicio_id'],

                'nombre_plaza' =>
                    $datos['nombre_plaza'],

                'turno' =>
                    $datos['turno'],

                'hora_entrada' =>
                    $datos['hora_entrada'],

                'hora_salida' =>
                    $datos['hora_salida'],

                'estado' =>
                    'vacante',

            ]
        );


        ActividadService::registrar(

            'Registró la plaza operativa ID '
            . $plaza->id,

            null,

            [

                'id' =>
                    $plaza->id,

                'servicio_id' =>
                    $plaza->servicio_id,

                'nombre_plaza' =>
                    $plaza->nombre_plaza,

                'turno' =>
                    $plaza->turno,

                'hora_entrada' =>
                    $plaza->hora_entrada,

                'hora_salida' =>
                    $plaza->hora_salida,

                'estado' =>
                    $plaza->estado,

            ]

        );


        return redirect()
            ->route(
                'operaciones.plazas.index'
            )
            ->with(
                'success',
                'La plaza operativa se registró correctamente.'
            );
    }
}
