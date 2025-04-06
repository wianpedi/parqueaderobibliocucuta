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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('plate', 10); // Placa del vehículo (sin restricción unique)
            $table->string('vehicle_type')->nullable(); // Tipo de vehículo ('car' o 'motorcycle')
            $table->timestamp('entry_time')->nullable(); // Hora de entrada
            $table->timestamp('exit_time')->nullable(); // Hora de salida
            $table->decimal('amount', 8, 2)->nullable(); // Valor a pagar
            $table->timestamps(); // Fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings'); // Elimina la tabla si se revierte la migración
    }
};