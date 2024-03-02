<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PreguntaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return[
            'titulo' => $this->faker->sentence(),
            'cuestionario_id' => '1',
            'rubro_id' =>  $this->faker->numberBetween(1, 5),
        ];
    }
}
