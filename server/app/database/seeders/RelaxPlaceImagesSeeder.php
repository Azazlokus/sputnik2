<?php

namespace database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RelaxPlaceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('relax_place_images')->insert([
                [
                    'relax_place_id' => '1',
                    'image_name' => 'Xvost.png',
                    'path_to_image' => 'D://images'
                ],
                [
                    'relax_place_id' => '1',
                    'image_name' => 'Lastochkin.png',
                    'path_to_image' => 'D://images'
                ],
                [
                    'relax_place_id' => '2',
                    'image_name' => 'Freedom.png',
                    'path_to_image' => 'D://images'
                ],
            ]
        );
    }
}
