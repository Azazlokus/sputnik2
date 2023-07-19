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
        Rating::factory()
            ->count(50)
            ->create();
    }
}
