<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
    protected $table = 'vigencias';

    protected $fillable = [

        'empleado_id',

        'documento',

        'fecha_vencimiento',

    ];

    public function empleado()
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}
