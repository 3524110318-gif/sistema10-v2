<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $fillable = [

        'supervision_id',

        'titulo',

        'foto',

        'descripcion',

    ];

    public function supervision()
    {
        return $this->belongsTo(
            Supervision::class,
            'supervision_id'
        );
    }
}
