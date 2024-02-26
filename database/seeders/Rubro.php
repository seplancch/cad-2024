<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Rubro extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Rubro::factory()->create([
            'titulo' => 'Rubro 1',
            'descripcion' => 'Asistencia y cumplimiento de horario',
        ]);

        \App\Models\Rubro::factory()->create([
            'titulo' => 'Rubro 2',
            'descripcion' => 'Planeación',
        ]);
    }
}
