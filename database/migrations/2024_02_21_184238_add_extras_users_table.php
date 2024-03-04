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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('numero_cuenta')->unique()->after('id');
            $table->string('fnacimiento', 100)->after('password');
            $table->unsignedSmallInteger('plantel')->after('password');
            $table->tinyInteger('semestre')->after('password');
            $table->tinyInteger('sexo')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('numero_cuenta');
            $table->dropColumn('fnacimiento');
            $table->dropColumn('plantel');
            $table->dropColumn('semestre');
            $table->dropColumn('sexo');
        });
    }
};
