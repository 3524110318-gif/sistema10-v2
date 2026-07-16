<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;

class ClienteComercial extends Model
{
    protected $table = 'clientes_comerciales';

    protected $fillable = [

        'razon_social',

        'rfc',

        'representante_legal',

        'telefono',

        'correo',

        'domicilio_fiscal',

        'estatus',

    ];
}
