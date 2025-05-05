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
        Schema::create('profesores_planteles', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' autoincremental como clave primaria
            $table->unsignedBigInteger('profesor_id'); // Referencia a la tabla 'profesores'
            $table->unsignedBigInteger('plantel_id'); // Referencia a la tabla 'plantel'
            $table->unsignedBigInteger('periodo_id'); // Referencia a la tabla 'periodo'
            $table->unsignedSmallInteger('antiguedad');
            $table->enum('turno', ['M', 'V']);
            $table->date('fecha_asignacion')->default(DB::raw('CURRENT_DATE')); // Fecha de asignación con valor predeterminado actual
            $table->timestamps(); // Agrega columnas 'created_at' y 'updated_at'

            // Llaves foráneas
            $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');
            $table->foreign('plantel_id')->references('id')->on('planteles')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores_planteles');
    }
};
