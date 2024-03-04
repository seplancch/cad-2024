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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('asignatura_id')->unsigned();
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');

            $table->string('grupo', 5);
            $table->string('seccion', 5);

            $table->unsignedBigInteger('plantel_id')->unsigned();
            $table->foreign('plantel_id')->references('id')->on('planteles');

            $table->unsignedSmallInteger('activa');
            $table->unsignedSmallInteger('autoinscripcion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
