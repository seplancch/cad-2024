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
        Configuracion::create(
            [
                'nombre' => 'PERIODO_ACTUAL',
                'valor' => '8',
                'tipo' => 'SYSTEMA',
                'descripcion' => 'Periodo actual para el sistema',
            ]
        );
    }
}
