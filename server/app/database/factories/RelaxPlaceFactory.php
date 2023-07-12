<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RelaxPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $faker->paragraph,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'average_rating' => $faker->randomFloat(2, 0, 5),
            'country' => $faker->country,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
