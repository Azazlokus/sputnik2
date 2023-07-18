<?php

namespace database\seeders;

use App\Models\RelaxPlace;
use App\Models\User;
use App\Models\UserWishlist;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_wishlists')->insert([
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'visit_time' => Carbon::now()->addDays(rand(1, 30))
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'visit_time' => Carbon::now()->addDays(rand(1, 30))
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'visit_time' => Carbon::now()->addDays(rand(1, 30))
            ],
            [
                'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                'visit_time' => Carbon::now()->addDays(rand(1, 30))
            ],
        ]);
        UserWishlist::factory()
            ->count(10)
            ->create();
    }
}
