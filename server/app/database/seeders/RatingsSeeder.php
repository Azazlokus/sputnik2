<?php

namespace database\seeders;

use App\Models\Rating;
use App\Models\RelaxPlace;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'rating' => 4,
                'comment' => 'Good place...'
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'rating' => 4,
                'comment' => 'Excellent  place!!!'
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'rating' => 4,
                'comment' => 'So so...'
            ],
        ]);
        Rating::factory()
            ->count(50)
            ->create();
    }
}
