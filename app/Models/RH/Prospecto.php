<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    protected $table = 'prospectos';

    protected $fillable = [

        'nombre',

        'apellido_paterno',

        'apellido_materno',

        'telefono',

        'correo',

        'puesto_solicitado',

        'fecha_entrevista',

        'estado',

        'observaciones',

    ];
}
