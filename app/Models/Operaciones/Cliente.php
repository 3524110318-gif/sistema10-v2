<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\Contrato;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [

        'razon_social',

        'rfc',

        'representante',

        'telefono',

        'correo',

        'direccion',

        'estado',

    ];

    public function contratos()
    {
        return $this->hasMany(
            Contrato::class
        );
    }
}
