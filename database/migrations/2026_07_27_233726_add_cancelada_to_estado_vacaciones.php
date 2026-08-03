<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE vacaciones
            MODIFY estado ENUM(
                'pendiente',
                'aprobada',
                'rechazada',
                'cancelada'
            ) NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::table('vacaciones')
            ->where('estado', 'cancelada')
            ->update([
                'estado' => 'pendiente',
            ]);

        DB::statement("
            ALTER TABLE vacaciones
            MODIFY estado ENUM(
                'pendiente',
                'aprobada',
                'rechazada'
            ) NOT NULL DEFAULT 'pendiente'
        ");
    }
};