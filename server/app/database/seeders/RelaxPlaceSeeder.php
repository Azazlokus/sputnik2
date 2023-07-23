<?php

namespace Database\Seeders;

use App\Models\RelaxPlaceCategory;
use App\Models\RelaxPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RelaxPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RelaxPlace::withoutEvents(function () {
            RelaxPlace::factory()
                ->count(10)
                ->create();
        });
    }
}
