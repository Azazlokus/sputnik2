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
            'user_id' => User::all()->random()->id,
            'relax_place_id' => RelaxPlace::all()->random()->id,
            'visit_time' => Carbon::now()->addDays(rand(1, 30))
        ];
    }
}
