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

            $table->foreignId('producto_id')
                ->nullable()
                ->after('empleado_id')
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedInteger('cantidad')
                ->default(1)
                ->after('producto_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrega_uniformes', function (Blueprint $table) {

            $table->dropForeign([
                'producto_id'
            ]);

            $table->dropColumn([
                'producto_id',
                'cantidad'
            ]);

        });
    }
};