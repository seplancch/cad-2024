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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 5);
            $table->string('seccion', 5);
            $table->foreignId('asignatura_id')->constrained();
            $table->foreignId('profesor_id')->constrained('profesores')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plantel_id')->constrained('planteles');
            $table->foreignId('periodo_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
