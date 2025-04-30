<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grupo::create([
            'nombre' => '404',
            'seccion' => 'A',
            'asignatura_id' => '1102',
            'profesor_id' => '1',
            'plantel_id' => '47205',
            'periodo_id' => '1',
        ]);

        Grupo::create([
            'nombre' => '604',
            'seccion' => 'A',
            'asignatura_id' => '1504',
            'profesor_id' => '2',
            'plantel_id' => '47205',
            'periodo_id' => '1',
        ]);
    }
}
