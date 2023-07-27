<?php

namespace database\seeders;

use App\Models\Rating;
use App\Models\RelaxPlace;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{

    public function run(): void
    {
        Rating::withoutEvents(function () {
            Rating::factory()
                ->count(50)
                ->create();
        });
    }
}
