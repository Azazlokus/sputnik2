<?php

namespace Database\Factories;

use App\Models\RelaxPlace;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserWishlistFactory extends Factory
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
            'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
            'visit_time' => Carbon::now()->addDays(rand(1, 30))
        ];
    }
}
