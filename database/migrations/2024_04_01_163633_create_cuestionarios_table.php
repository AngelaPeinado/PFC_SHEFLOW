<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuestionarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('respuesta_p1', [
                'Seguir mi ciclo y ver los impactos sobre mi salud',
                'Practico powerlifting y estoy interesada en conocer la relación entre ambos temas',
                'Soy competidora y me gustaría sacar información sobre mi ciclo para mejorar mi rendimiento',
                'Otros'
            ])->nullable();
            $table->enum('respuesta_p2', ['Si', 'No', 'A veces'])->nullable();
            $table->enum('respuesta_p3', ['Si', 'No', 'No estoy segura'])->nullable();
            $table->enum('respuesta_p4', [
                'Con la regla',
                'Ovulando',
                'Premenstrual',
                'Preovulando',
                'No tengo ni idea de las fases de mi ciclo'
            ])->nullable();
            $table->enum('respuesta_p5', ['Si', 'No'])->nullable();
            $table->enum('respuesta_p6', ['Si, mucho', 'De vez en cuando', 'No, nunca'])->nullable();
            $table->enum('respuesta_p7', ['Si', 'No'])->nullable();
            $table->enum('respuesta_p8', ['Si', 'No'])->nullable();
            $table->enum('respuesta_p9', [
                'Sí, los uso',
                'No uso anticonceptivos',
                'Sí uso, pero no hormonales',
                'No se que son anticonceptivos hormonales'
            ])->nullable();
            $table->enum('respuesta_p10', ['Sí', 'No', 'No se que es eso'])->nullable();
            $table->enum('respuesta_p11', ['Si, siempre', 'Depende del día', 'No, nunca'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuestionarios');
    }
};
