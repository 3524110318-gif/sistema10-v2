<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    protected $table = 'capacitaciones';

    protected $fillable = [

        'empleado_id',

        'curso',

        'fecha_capacitacion',

        'calificacion',

        'vigencia_hasta',

        'evidencia',

        'dc3',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}
