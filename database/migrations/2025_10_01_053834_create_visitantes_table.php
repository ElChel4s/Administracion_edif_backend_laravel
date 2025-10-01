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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id('id_visitante');
            $table->unsignedBigInteger('id_usuario')->unique();
            $table->unsignedBigInteger('id_residente_visita');
            $table->string('motivo_visita', 255);
            $table->timestamp('fecha_entrada');
            $table->timestamp('fecha_salida')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_residente_visita')->references('id_residente')->on('residentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
