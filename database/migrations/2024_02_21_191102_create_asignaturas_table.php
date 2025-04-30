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
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id();
            //$table->unsignedSmallInteger('clave')->unique();
            $table->unsignedTinyInteger('orden');
            $table->string('abreviatura', 200);
            $table->string('nombre', 200);
            $table->unsignedTinyInteger('horas');
            $table->enum('tipo_semestre', ['P', 'N']);
            $table->unsignedTinyInteger('area');
            $table->unsignedTinyInteger('plan');
            $table->unsignedTinyInteger('semestre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaturas');
    }
};
