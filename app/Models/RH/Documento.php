<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'empleado_id',
        'nombre',
        'entregado',
    ];

    public function empleado()
    {
        return $this->belongsTo(
            \App\Models\RH\Empleado::class
        );
    }
}
