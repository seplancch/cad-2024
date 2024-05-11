<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumno::create([
            'user_id' => '3',
            'numero_cuenta' => '885650',
            'fecha_nacimiento' => '19900101',
            'plantel_id' => '1',
            'sexo' => '1',
        ]);
    }
}
