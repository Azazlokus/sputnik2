<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'relax_place_id' => '1',
                'name' => 'City near  a sea',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'relax_place_id' => '2',
                'name' => 'Nice city',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
