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
        Schema::table('productos', function (Blueprint $table) {

            $table->boolean('genera_deduccion')
                ->default(false)
                ->after('tipo_producto');

            $table->decimal('monto_deduccion', 10, 2)
                ->nullable()
                ->after('genera_deduccion');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {

            $table->dropColumn([
                'genera_deduccion',
                'monto_deduccion',
            ]);

        });
    }
};