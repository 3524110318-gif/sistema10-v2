<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\PrenominaDetalle;

class Prenomina extends Model
{
    protected $table = 'prenominas';

    protected $fillable = [

        'periodo_inicio',

        'periodo_fin',

        'estatus',

        'observaciones',

    ];

    protected $casts = [

        'periodo_inicio' => 'date',

        'periodo_fin' => 'date',

    ];

    public function detalles()
    {
        return $this->hasMany(
            PrenominaDetalle::class
        );
    }

    public function getTotalNominaAttribute()
    {
        return $this->detalles()
            ->sum(
                'total_neto'
            );
    }

    public function getTotalEmpleadosAttribute()
    {
        return $this->detalles()
            ->count();
    }

    public function getTotalPercepcionesAttribute()
    {
        return $this->detalles()
            ->sum(
                'percepciones'
            );
    }

    public function getTotalDeduccionesAttribute()
    {
        return $this->detalles()
            ->sum(
                'deducciones'
            );
    }
}
