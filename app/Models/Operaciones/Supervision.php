<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\Evidencia;

class Supervision extends Model
{
    protected $fillable = [

        'asignacion_id',

        'fecha_supervision',

        'resultado',

        'observaciones',

        'foto',

    ];

    public function asignacion()
    {
        return $this->belongsTo(
            Asignacion::class,
            'asignacion_id'
        );
    }

    public function evidencias()
    {
        return $this->hasMany(
            Evidencia::class,
            'supervision_id'
        );
    }

    public function incidencias()
    {
        return $this->hasMany(
            IncidenciaOperativa::class,
            'supervision_id'
        );
    }

    public function incidencia()
    {
        return $this->hasOne(
            IncidenciaOperativa::class,
            'supervision_id'
        );
    }
}
