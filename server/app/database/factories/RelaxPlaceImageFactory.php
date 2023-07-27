<?php

namespace Database\Factories;

use App\Models\RelaxPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RelaxPlaceImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'relax_place_id' => RelaxPlace::all()->random()->id,
            'image_name' => $this->faker->name(),
            'path_to_image' => $this->faker->filePath()
        ];
    }
}
