<?php

namespace database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'user_id' => '11111111-1111-1111-1111-111111111111',
                'relax_place_id' => '1',
                'rating' => 4,
                'comment' => 'Good place...'
            ],
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'relax_place_id' => '1',
                'rating' => 4,
                'comment' => 'Excellent  place!!!'
            ],
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'relax_place_id' => '2',
                'rating' => 4,
                'comment' => 'So so...'
            ],
        ]);
    }
}
