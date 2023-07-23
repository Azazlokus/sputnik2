<?php

namespace Database\Seeders;

use App\Models\RelaxPlaceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelaxPlaceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RelaxPlaceCategory::withoutEvents(function () {
            RelaxPlaceCategory::factory()
                ->count(10)
                ->create();
        });
    }
}
