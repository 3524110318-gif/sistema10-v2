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
        Schema::create('clientes_comerciales', function (Blueprint $table) {
            $table->id();

            $table->string('razon_social');

            $table->string('rfc',13)->unique();

            $table->string('representante_legal');

            $table->string('telefono',20);

            $table->string('correo');

            $table->text('domicilio_fiscal');

            $table->enum(
                'estatus',
                [
                    'activo',
                    'inactivo'
                ]
            )->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_comerciales');
    }
};
