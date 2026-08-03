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
        Schema::table('entrega_uniformes', function (Blueprint $table) {

            // Ruta de la imagen de la firma
            $table->string('firma_path')
                ->nullable()
                ->after('observaciones');

            // Ruta del PDF de resguardo
            $table->string('pdf_resguardo')
                ->nullable()
                ->after('firma_path');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrega_uniformes', function (Blueprint $table) {

            $table->dropColumn([
                'firma_path',
                'pdf_resguardo',
            ]);

        });
    }
};