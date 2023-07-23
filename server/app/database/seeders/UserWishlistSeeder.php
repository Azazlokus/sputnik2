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
        UserWishlist::withoutEvents(function () {
            UserWishlist::factory()
                ->count(10)
                ->create();
        });
    }
}
