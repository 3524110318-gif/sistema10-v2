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
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            $table->string('apellido_paterno');

            $table->string('apellido_materno')
                ->nullable();

            $table->string('telefono');

            $table->string('correo')
                ->nullable();

            $table->string('puesto_solicitado');

            $table->date('fecha_entrevista')
                ->nullable();

            $table->enum('estado', [

                'pendiente',

                'entrevistado',

                'aprobado',

                'rechazado',

                'contratado'

            ])->default('pendiente');

            $table->text('observaciones')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospectos');
    }
};
