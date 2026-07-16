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
        Schema::create('bajas_empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->onDelete('cascade');

            $table->date('fecha_baja');

            $table->boolean('uniforme_devuelto')
                ->default(false);

            $table->boolean('botas_devueltas')
                ->default(false);

            $table->boolean('credencial_devuelta')
                ->default(false);

            $table->boolean('radio_devuelto')
                ->default(false);

            $table->boolean('carta_renuncia')
                ->default(false);

            $table->boolean('finiquito_entregado')
                ->default(false);

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
        Schema::dropIfExists('bajas_empleados');
    }
};
