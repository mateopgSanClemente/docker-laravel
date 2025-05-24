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
        Schema::create('coches', function (Blueprint $table) {
            $table->id();

            // Propietario (cliente)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Datos del vehículo
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula')->unique(); // Única por vehículo
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};
