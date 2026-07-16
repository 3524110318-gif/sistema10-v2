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
        Schema::create('entrega_uniformes', function (Blueprint $table) {
            $table->id();
             $table->foreignId('empleado_id')
                ->constrained('empleados')
                ->onDelete('cascade');

            $table->string('articulo');

            $table->enum('tipo', [
                'nuevo',
                'segunda_mano'
            ]);

            $table->date('fecha_entrega');

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
        Schema::dropIfExists('entrega_uniformes');
    }
};
