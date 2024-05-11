<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            Users::class,
            Cuestionario::class,
            Rubros::class,
            PreguntasSeeder::class,
            PlantelSeeder::class,
            //Preguntas::class,
            PeriodoSeeder::class,
            AsignaturaSeeder::class,
            ProfesorSeeder::class,
            GrupoSeeder::class,
            AlumnoSeeder::class,
            InscripcionSeeder::class,
        ]);
    }
}
