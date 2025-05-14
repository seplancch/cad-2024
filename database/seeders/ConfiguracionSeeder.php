<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracion::insert([
            [
                'nombre' => 'PERIODO_ACTUAL',
                'valor' => '20',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Periodo actual para el sistema',
            ],
            [
                'nombre' => 'INICIO_6',
                'valor' => '12-05-2025',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Fecha de apertura para alumnos de 6',
            ],
            [
                'nombre' => 'CIERRE_6',
                'valor' => '16-05-2025',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Fecha de cierre para alumnos de 6',
            ],
            [
                'nombre' => 'INICIO_24',
                'valor' => '12-06-2025',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Fecha de apertura para alumnos de 2 y 4',
            ],
            [
                'nombre' => 'CIERRE_24',
                'valor' => '16-06-2025',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Fecha de cierre para alumnos de 2 y 4',
            ],
        ]);
    }
}
