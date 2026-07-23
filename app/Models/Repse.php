<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RH\Empleado;

class Repse extends Model
{
    use HasFactory;

    protected $fillable = [

        'empleado_id',

        'alta_imss',
        'contrato_firmado',
        'cedula_ssp',
        'constancia_fiscal',
        'rfc_constancia',

        'vigencia_alta_imss',
        'vigencia_contrato',
        'vigencia_cedula_ssp',
        'vigencia_constancia_fiscal',

        'archivo_imss',
        'archivo_contrato',
        'archivo_cedula_ssp',
        'archivo_constancia_fiscal',

        'estatus',

        'observaciones'

    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function cumpleRequisitos(): bool
    {
        if (
            !$this->alta_imss ||
            !$this->contrato_firmado ||
            !$this->cedula_ssp ||
            !$this->constancia_fiscal
        ) {
            return false;
        }

        if (
            !$this->vigencia_cedula_ssp ||
            now()->startOfDay()->gt(
                \Carbon\Carbon::parse(
                    $this->vigencia_cedula_ssp
                )->startOfDay()
            )
        ) {
            return false;
        }

        if (
            !$this->empleado ||
            strtoupper(trim($this->rfc_constancia)) !==
            strtoupper(trim($this->empleado->rfc))
        ) {
            return false;
        }

        return true;
    }

    public function estaBloqueado(): bool
    {
        return !$this->cumpleRequisitos();
    }

    public function documentosFaltantes(): array
    {
        $faltantes = [];

        if (!$this->alta_imss) {
            $faltantes[] = 'Alta IMSS';
        }

        if (!$this->contrato_firmado) {
            $faltantes[] = 'Contrato firmado';
        }

        if (!$this->cedula_ssp) {
            $faltantes[] = 'Cédula SSP';
        }

        if 
        ($this->cedula_ssp &&
            (
                !$this->vigencia_cedula_ssp ||
                now()->startOfDay()->gt(
                    \Carbon\Carbon::parse(
                        $this->vigencia_cedula_ssp
                    )->startOfDay()
                )
            )
        )  {
            $faltantes[] =
                'Cédula SSP vencida o sin vigencia';
            }

        if (!$this->constancia_fiscal) {
            $faltantes[] = 'Constancia fiscal';
        }

        if (
            $this->constancia_fiscal &&
            (
                !$this->empleado ||
                !$this->rfc_constancia ||
                strtoupper(trim($this->rfc_constancia)) !==
                strtoupper(trim($this->empleado->rfc))
            )
        ) {
            $faltantes[] =
                'RFC de constancia fiscal no coincide';
        }

        return $faltantes;
    }

    public function estadoVigenciaCedula(): string
    {
        if (!$this->vigencia_cedula_ssp) {
            return 'sin_vigencia';
        }

        $vigencia = \Carbon\Carbon::parse(
            $this->vigencia_cedula_ssp
        )->startOfDay();

        $hoy = now()->startOfDay();

        if ($vigencia->lt($hoy)) {
            return 'vencida';
        }

        if (
            $vigencia->lte(
                $hoy->copy()->addDays(30)
            )
        ) {
            return 'por_vencer';
        }

        return 'vigente';
    }

    public function diasParaVencerCedula(): ?int
    {
        if (!$this->vigencia_cedula_ssp) {
            return null;
        }

        return now()
            ->startOfDay()
            ->diffInDays(
                \Carbon\Carbon::parse(
                    $this->vigencia_cedula_ssp
                )->startOfDay(),
                false
            );
    }
}