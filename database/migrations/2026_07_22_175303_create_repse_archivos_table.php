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
        Schema::create('repse_archivos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('empleado_id')
                ->nullable()
                ->constrained('empleados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('cliente_id')
                ->nullable()
                ->constrained('clientes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('periodo');

            $table->enum('tipo', [
                'alta_imss',
                'nomina_pdf',
                'nomina_xml',
                'constancia_sat',
                'pago_sua',
            ]);

            $table->string('archivo');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repse_archivos');
    }
};
