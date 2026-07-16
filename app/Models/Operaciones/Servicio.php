<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\PlazaOperativa;
use App\Models\Operaciones\IncidenciaOperativa;

class Servicio extends Model
{
    protected $table = 'servicios';

    protected $fillable = [

        'contrato_id',

        'nombre',

        'direccion',

        'municipio',

        'latitud',

        'longitud',

        'estado',

    ];

    public function contrato()
    {
        return $this->belongsTo(
            Contrato::class
        );
    }

    public function plazas()
    {
        return $this->hasMany(
            PlazaOperativa::class,
            'servicio_id'
        );
    }

    public function incidencias()
    {
        return $this->hasMany(
            IncidenciaOperativa::class,
            'servicio_id'
        );
    }

    public function calcularISS()
    {
        $vacantes =
            $this->plazas
            ->where(
                'estado',
                'vacante'
            )
            ->count();

        $incidencias =
            $this->incidencias
            ->where(
                'estado',
                'abierta'
            )
            ->count();

        $supervisiones =
            \App\Models\Operaciones\Supervision::whereHas(
                'asignacion.plaza',
                function ($query)
                {
                    $query->where(
                        'servicio_id',
                        $this->id
                    );
                }
            )->count();

        $iss =
            100
            -
            ($vacantes * 10)
            -
            ($incidencias * 5)
            +
            ($supervisiones * 2);

        return max(
            0,
            min(
                100,
                $iss
            )
        );
    }
}
