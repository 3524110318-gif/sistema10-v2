<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;

class CalendarioLaboral extends Model
{
    protected $table = 'calendario_laboral';
    protected $fillable = [
        'fecha',
        'tipo',
        'descripcion',
    ];
}
