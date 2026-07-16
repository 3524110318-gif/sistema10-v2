<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\RH\Empleado;
use App\Models\Operaciones\PlazaOperativa;

class Doblete extends Model
{
    protected $fillable = [

        'empleado_id',

        'plaza_operativa_id',

        'guardia_ausente',

        'fecha',

        'motivo',

        'estado',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class,
            'empleado_id'
        );
    }

    public function plaza()
    {
        return $this->belongsTo(
            PlazaOperativa::class,
            'plaza_operativa_id'
        );
    }
}
