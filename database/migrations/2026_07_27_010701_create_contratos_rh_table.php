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
        Schema::create('contratos_rh', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('numero_contrato')
                ->unique();

            $table->enum('tipo_contrato', [
                'indeterminado',
                'determinado',
                'eventual',
                'prueba',
            ]);

            $table->date('fecha_inicio');

            $table->date('fecha_fin')
                ->nullable();

            $table->date('fecha_firma')
                ->nullable();

            $table->boolean('firmado')
                ->default(false);

            $table->enum('estado', [
                'vigente',
                'vencido',
                'cancelado',
            ])->default('vigente');

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_rh');
    }
};