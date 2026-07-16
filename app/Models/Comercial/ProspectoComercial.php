<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comercial\Cotizacion;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProspectoComercial extends Model
{
    protected $table = 'prospectos_comerciales';

    protected $fillable = [

        'razon_social',

        'rfc',

        'contacto',

        'telefono',

        'correo',

        'direccion',

        'tarifa',

        'numero_plazas',

        'estatus',

        'observaciones',

    ];

    protected $casts = [

        'tarifa' => 'decimal:2',

    ];

    public function cotizaciones()
    {
        return $this->hasMany(
            Cotizacion::class,
            'prospecto_comercial_id'
        );
    }
}
