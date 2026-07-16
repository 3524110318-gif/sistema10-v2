<?php

namespace App\Models\Administracion;
use Illuminate\Database\Eloquent\Model;

class LogActividad extends Model
{
    protected $table = 'log_actividads';

    protected $fillable = [
        'usuario',
        'accion',
    ];
}
