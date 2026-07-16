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
            'mantenimiento_vehiculars',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId(
                    'vehiculo_id'
                )->constrained(
                    'vehiculos'
                )->cascadeOnDelete();

                $table->date(
                    'fecha'
                );

                $table->integer(
                    'kilometraje'
                );

                $table->string(
                    'tipo'
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->integer(
                    'proximo_mantenimiento'
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
        Schema::dropIfExists('mantenimiento_vehiculars');
    }
};
