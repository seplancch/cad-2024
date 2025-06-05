<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('satisfaccion_encuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('periodo')->nullable();
            $table->unsignedInteger('pregunta_id'); // identificador numérico de la pregunta
            $table->string('pregunta_texto'); // texto de la pregunta
            $table->string('respuesta_texto')->nullable(); // texto de la respuesta
            $table->integer('respuesta_valor')->nullable(); // valor numérico de la respuesta
            $table->string('user_agent')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('satisfaccion_encuestas');
    }
};
