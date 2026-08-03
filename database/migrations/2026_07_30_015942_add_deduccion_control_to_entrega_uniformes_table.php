<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entrega_uniformes', function (Blueprint $table) {
            $table->foreignId('prenomina_detalle_id')
                ->nullable()
                ->after('pdf_resguardo')
                ->constrained('prenomina_detalles')
                ->nullOnDelete();

            $table->timestamp('deduccion_aplicada_at')
                ->nullable()
                ->after('prenomina_detalle_id');
        });
    }

    public function down(): void
    {
        Schema::table('entrega_uniformes', function (Blueprint $table) {
            $table->dropForeign([
                'prenomina_detalle_id',
            ]);

            $table->dropColumn([
                'prenomina_detalle_id',
                'deduccion_aplicada_at',
            ]);
        });
    }
};