<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContratoComercial extends Model
{
    protected $table = 'contratos_comerciales';

    protected $fillable = [

        'cliente_comercial_id',

        'folio',

        'fecha_inicio',

        'fecha_fin',

        'tarifa',

        'numero_plazas',

        'indexacion_anual',

        'pdf_consignas',

        'anticipo_validado',

        'estado',

        'observaciones',

    ];

    protected $casts = [

        'fecha_inicio' => 'date',

        'fecha_fin' => 'date',

        'tarifa' => 'decimal:2',

        'indexacion_anual' => 'decimal:2',

        'anticipo_validado' => 'boolean',

    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(

            ClienteComercial::class,

            'cliente_comercial_id'

        );
    }


    public function getRenovacionProximaAttribute()
    {
        if (
            $this->estado !== 'activo'
        ) {

            return false;

        }

        return now()->diffInDays(

            $this->fecha_fin,

            false

        ) <= 60;
    }
}