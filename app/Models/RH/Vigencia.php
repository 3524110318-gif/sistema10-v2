<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vigencia extends Model
{
    protected $table = 'vigencias';

    protected $fillable = [

        'empleado_id',

        'documento',

        'fecha_vencimiento',

        'evidencia',

    ];

    protected $casts = [

        'fecha_vencimiento' => 'date',

    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(
            Empleado::class
        );
    }
}