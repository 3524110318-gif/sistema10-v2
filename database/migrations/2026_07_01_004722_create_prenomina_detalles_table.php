<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'prenomina_detalles',
            function (Blueprint $table)
            {
                $table->id();

                $table->foreignId(
                    'prenomina_id'
                )
                ->constrained(
                    'prenominas'
                )
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

                $table->foreignId(
                    'empleado_id'
                )
                ->constrained(
                    'empleados'
                )
                ->cascadeOnUpdate()
                ->restrictOnDelete();

                $table->decimal(
                    'salario_base',
                    12,
                    2
                );

                $table->integer(
                    'dias_laborados'
                )->default(0);

                $table->integer(
                    'dias_incapacidad'
                )->default(0);

                $table->string(
                    'folio_imss'
                )->nullable();

                $table->decimal(
                    'percepciones',
                    12,
                    2
                )->default(0);

                $table->decimal(
                    'deducciones',
                    12,
                    2
                )->default(0);

                $table->decimal(
                    'ajustes',
                    12,
                    2
                )->default(0);

                $table->text(
                    'justificacion'
                )->nullable();

                $table->decimal(
                    'total_neto',
                    12,
                    2
                )->default(0);

                $table->decimal(
                    'horas_extra',
                    12,
                    2
                )->default(0);

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'prenomina_detalles'
        );
    }
};
