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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuestionario_id')->constrained('cuestionarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rubro_id')->constrained('rubros')->onUpdate('cascade')->onDelete('cascade');
            $table->text('titulo');
            $table->text('opcion_1');
            $table->text('opcion_2');
            $table->text('opcion_3')->nullable();
            $table->text('opcion_4')->nullable();
            $table->text('opcion_5')->nullable();
            $table->tinyInteger('correct_answer_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
