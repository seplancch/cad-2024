<?php

namespace Database\Seeders;
use App\Models\Profesor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesor = Profesor::create([
            'user_id' => '1',
            'numero_trabajador' => '851788',
            'rfc' => 'basj850331631',
            'fecha_nacimiento' => '19850331',
            'sexo' => '2',
        ]);


        $profesor->profesorPlantel()->create([
            'plantel_id' => '47205',
            'periodo_id' => '8',
            'antiguedad' => '15',
            'fecha_asignacion' => now(),
        ]);


    }
}
