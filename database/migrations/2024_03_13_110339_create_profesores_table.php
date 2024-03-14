<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Plantel;
use App\Models\Asignatura;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedMediumInteger('numero_trabajador')->unique();
            $table->string('rfc', 100)->unique();
            $table->string('nombre', 255);
            $table->string('paterno', 255);
            $table->string('materno', 255);
            $table->foreignId('plantel_id')->constrained('planteles');
            $table->foreignId('asignatura_id')->constrained('asignaturas');
            $table->enum('turno', ['M', 'V']);
            $table->date('fecha_nacimiento');
            $table->unsignedSmallInteger('antiguedad');
            $table->enum('sexo', ['M', 'F']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
