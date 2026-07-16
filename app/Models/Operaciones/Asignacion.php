<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\RH\Empleado;
use App\Models\Operaciones\Supervision;

class Asignacion extends Model
{
    protected $fillable = [

        'plaza_operativa_id',

        'empleado_id',

        'fecha_inicio',

        'fecha_fin',

        'estado',

    ];

    public function plaza()
    {
        return $this->belongsTo(
            PlazaOperativa::class,
            'plaza_operativa_id'
        );
    }

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class,
            'empleado_id'
        );
    }

    public function supervisiones()
    {
        return $this->hasMany(
            Supervision::class,
            'asignacion_id'
        );
    }
}
