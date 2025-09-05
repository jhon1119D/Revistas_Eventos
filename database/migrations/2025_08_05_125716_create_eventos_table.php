<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios (nullable + clave foránea)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Campos principales
            $table->string('titulo');
            $table->string('acronimo')->nullable();
            $table->string('ranking')->nullable();
            $table->string('enlace')->nullable();
            $table->string('documento_url')->nullable();
            $table->string('autor_nombre')->nullable();

            // Fechas
            $table->date('fecha')->nullable();
            $table->date('fecha_aceptacion')->nullable();
            $table->date('fecha_registro')->nullable();

            // Timestamps estándar (opcional pero útil para Laravel)
            $table->timestamps();

            // Índices recomendados para rendimiento
            $table->index('user_id');
            $table->index('titulo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
