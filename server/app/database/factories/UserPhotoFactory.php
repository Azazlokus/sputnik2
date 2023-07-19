<?php

namespace Database\Factories;

use App\Models\RelaxPlace;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
            'image_name' => $this->faker->name(),
            'path_to_photo' => $this->faker->filePath()
        ];
    }
}
