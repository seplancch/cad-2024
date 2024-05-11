<?php

namespace Database\Seeders;

use App\Models\Inscripcion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inscripcion::create([
            'alumno_id' => '1',
            'grupo_id' => '1',
            'activa' => '1',
            'autoinscripcion' => '0',
        ]);
        Inscripcion::create([
            'alumno_id' => '1',
            'grupo_id' => '2',
            'activa' => '1',
            'autoinscripcion' => '0',
        ]);
    }
}
