<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [

        'prospecto_comercial_id',

        'folio',

        'fecha',

        'monto',

        'numero_plazas',

        'vigencia_dias',

        'estatus',

        'observaciones',

    ];

    protected $casts = [

        'fecha' => 'date',

        'monto' => 'decimal:2',

    ];

    public function prospecto(): BelongsTo
    {
        return $this->belongsTo(
            ProspectoComercial::class,
            'prospecto_comercial_id'
        );
    }
}