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
        Schema::create('calendario_laboral', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->unique();
            $table->enum('tipo', [
                'laboral',
                'descanso',
                'festivo',
                'vacaciones',
            ]);
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendario_laboral');
    }
};
