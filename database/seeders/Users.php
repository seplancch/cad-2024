<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'numero_cuenta' => '151788',
            'name' => 'Jonathan Bailon',
            'email' => 'jonathan.bailon@cch.unam.mx',
            'password' => bcrypt('000000'),
            'fnacimiento' => '19991212',
            'plantel' => 5,
            'semestre' => 6,
            'sexo' => 1,
        ]);
    }
}
