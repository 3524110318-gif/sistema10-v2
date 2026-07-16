<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $table = 'rh_incidencias';
    protected $fillable = [
        'empleado_id',
        'tipo',
        'fecha',
        'descripcion',
        'estado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
