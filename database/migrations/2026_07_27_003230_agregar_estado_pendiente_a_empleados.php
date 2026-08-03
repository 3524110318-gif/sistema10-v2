<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE empleados
            MODIFY estado ENUM(
                'pendiente',
                'activo',
                'inactivo'
            ) NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::table('empleados')
            ->where('estado', 'pendiente')
            ->update([
                'estado' => 'inactivo',
            ]);

        DB::statement("
            ALTER TABLE empleados
            MODIFY estado ENUM(
                'activo',
                'inactivo'
            ) NOT NULL DEFAULT 'activo'
        ");
    }
};