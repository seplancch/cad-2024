<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rubros extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rubros')->insert([
            [
                'titulo' => 'Autoevaluación del estudiante.',
                'descripcion' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 1. Asistencia y cumplimiento de horario durante el curso de tu profesor o profesora.',
                'descripcion' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 2. Planeación.',
                'descripcion' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 3. Desarrollo del curso.',
                'descripcion' => '',
                 'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 4. Desarrollo de habilidades transversales.',
                'descripcion' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 5. Evaluación.',
                'descripcion' => '',
                 'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'titulo' => 'Rubro 6. Interacción Profesor-Alumno.',
                'descripcion' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
    }
}
