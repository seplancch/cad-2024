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
        Profesor::create([
            'user_id' => '2',
            'numero_trabajador' => '885650',
            'rfc' => 'we23',
            'plantel_id' => '1',
            'fecha_nacimiento' => '19900101',
            'antiguedad' => '5',
            'sexo' => '1',
        ]);
        Profesor::create([
            'user_id' => '1',
            'numero_trabajador' => '851788',
            'rfc' => '23444',
            'plantel_id' => '1',
            'fecha_nacimiento' => '19900101',
            'antiguedad' => '15',
            'sexo' => '2',
        ]);

    }
}
