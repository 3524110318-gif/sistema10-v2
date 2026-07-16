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
        Schema::create('prospectos_comerciales', function (Blueprint $table) {
            $table->id();

            $table->string('razon_social');

            $table->string('rfc', 13)->nullable();

            $table->string('contacto');

            $table->string('telefono', 20);

            $table->string('correo')->nullable();

            $table->text('direccion')->nullable();

            $table->decimal(
                'tarifa',
                12,
                2
            )->default(0);

            $table->unsignedInteger(
                'numero_plazas'
            )->default(0);

            $table->enum(
                'estatus',
                [
                    'nuevo',
                    'seguimiento',
                    'cotizacion',
                    'ganado',
                    'perdido'
                ]
            )->default('nuevo');

            $table->text(
                'observaciones'
            )->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos_comerciales');
    }
};
