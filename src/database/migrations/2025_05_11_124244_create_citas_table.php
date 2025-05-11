<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Cliente (relación con usuarios)
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('duracion_estimada')->nullable(); // en minutos, por ejemplo
            $table->timestamps();

            // Clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
