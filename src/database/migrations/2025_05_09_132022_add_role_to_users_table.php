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
        Schema::table('users', function (Blueprint $table) {
            // Crea el campo 'role' cuando la migración se ejecuta. Su valor por defecto será 'cliente' y se situará después del campo email (estético).
            $table->string('role')->default('cliente')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Al revertir la migración se elimina la columna 'role'.
            $table->dropColumn('role');
        });
    }
};
