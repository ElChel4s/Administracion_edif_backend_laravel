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
        Schema::create('residentes', function (Blueprint $table) {
            $table->id('id_residente');
            $table->unsignedBigInteger('id_usuario')->unique();
            $table->unsignedBigInteger('id_departamento');
            $table->date('fecha_mudanza')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            // La foreign key para id_departamento se agregará cuando creemos la tabla departamentos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residentes');
    }
};
