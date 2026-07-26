<?php

namespace App\Models\Gerencia;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CodigoAcceso extends Model
{
    protected $table = 'codigo_accesos';

    protected $fillable = [

        'modulo',

        'codigo',

        'estado',

        'fecha_generacion',

        'usuario_id',

    ];

    protected $casts = [

        'fecha_generacion' => 'datetime',

    ];

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            'usuario_id'
        );
    }
}