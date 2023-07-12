<?php

namespace database\seeders;

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
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'relax_place_id' => '1',
                'visit_time' => '2023-08-12 17:40:17'
            ],
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'relax_place_id' => '2',
                'visit_time' => '2023-08-12 17:40:17'
            ],
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'relax_place_id' => '5',
                'visit_time' => '2023-08-12 17:40:17'
            ],
            [
                'user_id' => '11111111-1111-1111-1111-111111111111',
                'relax_place_id' => '1',
                'visit_time' => '2023-08-12 17:40:17'
            ],

        ]);
    }
}
