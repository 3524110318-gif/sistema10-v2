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
            'proveedores',
            function (Blueprint $table)
            {
                $table->id();

                $table->string(
                    'razon_social'
                );

                $table->string(
                    'rfc'
                )->unique();

                $table->string(
                    'nombre_contacto'
                )->nullable();

                $table->string(
                    'telefono'
                )->nullable();

                $table->string(
                    'correo'
                )->nullable();

                $table->text(
                    'direccion'
                )->nullable();

                $table->string(
                    'ciudad'
                )->nullable();

                $table->string(
                    'codigo_postal'
                )->nullable();

                $table->enum(
                    'estado',
                    [
                        'activo',
                        'inactivo'
                    ]
                )->default(
                    'activo'
                );

                $table->text(
                    'observaciones'
                )->nullable();

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'proveedores'
        );
    }
};
