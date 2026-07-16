<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\Servicio;
use App\Models\Operaciones\Asignacion;

class PlazaOperativa extends Model
{
     protected $table =
        'plaza_operativas';

    protected $fillable = [

        'servicio_id',

        'nombre_plaza',

        'turno',

        'hora_entrada',

        'hora_salida',

        'estado',

    ];

    public function servicio()
    {
        return $this->belongsTo(
            Servicio::class,
            'servicio_id'
        );
    }

    public function asignaciones()
    {
        return $this->hasMany(
            Asignacion::class,
            'plaza_operativa_id'
        );
    }
}
