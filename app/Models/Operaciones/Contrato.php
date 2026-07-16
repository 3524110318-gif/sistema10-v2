<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operaciones\Cliente;
use App\Models\Operaciones\Servicio;

class Contrato extends Model
{
    protected $table = 'contratos';

    protected $fillable = [

        'cliente_id',

        'numero_contrato',

        'fecha_inicio',

        'fecha_fin',

        'estado',

        'observaciones',

    ];

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class
        );
    }

    public function servicios()
    {
        return $this->hasMany(
            Servicio::class
        );
    }
}
