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
        Schema::create('fecha_periodos', function (Blueprint $table) {
            $table->id();
            $table->date('fechaPeriodo_inicio')->nullable();
            $table->date('fechaPeriodo_fin')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación de uno a muchos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fecha_periodos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['fechaPeriodo_inicio', 'fechaPeriodo_fin']);
        });
    }
};
