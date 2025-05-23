<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // Clave foránea (sintaxis más limpia)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Datos del vehículo
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula')->unique(); // Única por vehículo
            
            // Fecha y hora (pueden combinarse en un campo datetime)
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('duracion_estimada')->nullable()->comment('Minutos'); 
            
            // Estado (corrige typo en 'pendiente')
            $table->enum('estado', ['pendiente', 'asignada'])->default('pendiente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
