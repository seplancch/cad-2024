<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Encuesta extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Encuesta::factory()->create([
            'titulo' => 'Cad 2017',
            'descripcion' => 'Cad aprovado por el consejo tecnico en 2017',
            'version' => '2017'
        ]);
    }
}
