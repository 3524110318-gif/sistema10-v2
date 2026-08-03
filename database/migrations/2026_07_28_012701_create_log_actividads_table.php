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
        Schema::create('log_actividads', function (Blueprint $table) {

            $table->id();

            // Rol o usuario que realizó la acción
            $table->string('usuario', 100);

            // Descripción completa de la acción
            $table->text('accion');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_actividads');
    }
};