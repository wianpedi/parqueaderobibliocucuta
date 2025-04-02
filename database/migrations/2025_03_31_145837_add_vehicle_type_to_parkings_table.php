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
        Schema::table('parkings', function (Blueprint $table) {
            // Agregar la columna vehicle_type con un valor por defecto nulo
            $table->string('vehicle_type')->nullable()->after('plate'); // Colocar después de la columna 'plate'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parkings', function (Blueprint $table) {
            // Eliminar la columna vehicle_type si se revierte la migración
            $table->dropColumn('vehicle_type');
        });
    }
};