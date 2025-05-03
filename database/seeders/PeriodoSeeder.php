<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periodos')->insert(
            [
                [
                    'cuestionario_id' => '1',
                    'clave' => '2017-2',
                    'descripcion' => 'CAD 2024-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2018-2',
                    'descripcion' => 'CAD 2018-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2019-2',
                    'descripcion' => 'CAD 2019-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2020-2',
                    'descripcion' => 'CAD 2020-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2021-2',
                    'descripcion' => 'CAD 2021-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2022-2',
                    'descripcion' => 'CAD 2022-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2023-2',
                    'descripcion' => 'CAD 2023-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'cuestionario_id' => '1',
                    'clave' => '2024-2',
                    'descripcion' => 'CAD 2024-2',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],
            ]
        );
    }
}
