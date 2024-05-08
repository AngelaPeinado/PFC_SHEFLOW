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
        Schema::create('pivote_sintomas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('opcion_sintoma_id');
            $table->decimal('agua', 8, 2);
            $table->integer('pasos')->nullable();
            $table->decimal('temperatura', 5, 2)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('notas')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('opcion_sintoma_id')->references('id')->on('sintomas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivote_sintomas');
    }
};
