<?php

namespace Database\Seeders;

use App\Models\Grupos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupos::create([
            'nombre' => '404',
            'seccion' => 'A',
            'asignatura_id' => '1',
            'profesor_id' => '1',
            'plantel_id' => '1',
            'periodo_id' => '1',
        ]);

        Grupos::create([
            'nombre' => '604',
            'seccion' => 'A',
            'asignatura_id' => '2',
            'profesor_id' => '2',
            'plantel_id' => '1',
            'periodo_id' => '1',
        ]);
    }
}
