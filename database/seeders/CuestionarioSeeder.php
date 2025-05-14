<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cuestionario;
use Illuminate\Support\Facades\DB;


class CuestionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cuestionario::insert([
            [
                'titulo' => 'Cad 2006',
                'descripcion' => 'Cad aprovado por el consejo tecnico en 2006',
                'version' => '2006'
            ],
            [
                'titulo' => 'Cad 2017',
                'descripcion' => 'Cad aprovado por el consejo tecnico en 2017',
                'version' => '2017'
            ],
        ]);
    }
}
