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
            'vehiculos',
            function (Blueprint $table) {

                $table->id();

                $table->string(
                    'unidad'
                );

                $table->string(
                    'placas'
                )->unique();

                $table->string(
                    'marca'
                );

                $table->string(
                    'modelo'
                );

                $table->year(
                    'anio'
                );

                $table->integer(
                    'kilometraje_actual'
                )->default(0);

                $table->enum(
                    'estado',
                    [
                        'activo',
                        'taller',
                        'baja'
                    ]
                )->default(
                    'activo'
                );

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
