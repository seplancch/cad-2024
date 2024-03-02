<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RespuestaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'respuesta' => $this->faker->sentence(),
            'orden' => $this->faker->numberBetween(1, 5),
            'puntos' => $this->faker->numberBetween(1, 5),
        ];
    }
}
