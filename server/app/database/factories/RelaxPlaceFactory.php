<?php

namespace Database\Factories;

use App\Models\RelaxPlaceCategory;
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
        return [
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $this->faker->paragraph,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'average_rating' => $this->faker->randomFloat(2, 0, 5),
            'country' => $this->faker->country,
            'category' => RelaxPlaceCategory::query()->inRandomOrder()->pluck('id')->first(),

        ];
    }
}
