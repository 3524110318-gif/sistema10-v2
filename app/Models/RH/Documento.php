<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
    protected $fillable = [
        'empleado_id',
        'nombre',
        'entregado',
    ];

    protected $casts = [
        'entregado' => 'boolean',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}