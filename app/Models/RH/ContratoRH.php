<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContratoRH extends Model
{
    use HasFactory;

    protected $table = 'contratos_rh';

    protected $fillable = [
        'empleado_id',
        'numero_contrato',
        'tipo_contrato',
        'fecha_inicio',
        'fecha_fin',
        'fecha_firma',
        'firmado',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_firma' => 'date',
        'firmado' => 'boolean',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}