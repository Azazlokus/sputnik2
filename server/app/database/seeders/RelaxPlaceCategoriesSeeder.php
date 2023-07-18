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
        DB::table('relax_place_categories')->insert([
            [
                'name' => 'City near  a sea'
            ],
            [
                'name' => 'Nice city'
            ]
        ]);
        RelaxPlaceCategory::factory()
            ->count(10)
            ->create();
    }
}
