<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'bajas_empleados',
            function (Blueprint $table) {

                $table->string(
                    'archivo_carta_renuncia'
                )->nullable()
                    ->after('carta_renuncia');

                $table->string(
                    'archivo_finiquito'
                )->nullable()
                    ->after('finiquito_entregado');

                $table->foreignId('user_id')
                    ->nullable()
                    ->after('observaciones')
                    ->constrained('users')
                    ->nullOnDelete();

            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'bajas_empleados',
            function (Blueprint $table) {

                $table->dropForeign([
                    'user_id',
                ]);

                $table->dropColumn([
                    'archivo_carta_renuncia',
                    'archivo_finiquito',
                    'user_id',
                ]);

            }
        );
    }
};