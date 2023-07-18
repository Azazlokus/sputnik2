<?php

namespace database\seeders;

use App\Models\RelaxPlace;
use App\Models\RelaxPlaceImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RelaxPlaceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('relax_place_images')->insert([
                [
                    'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                    'image_name' => './../../public/storage/breketmax.jpg',
                    'path_to_image' => 'D://images'
                ],
                [
                    'relax_place_id' => RelaxPlace::query()->inRandomOrder()->pluck('id')->first(),
                    'image_name' => 'Freedom.png',
                    'path_to_image' => './../../public/storage/hashiro.jpg'
                ],
            ]
        );
        RelaxPlaceImage::factory()
            ->count(10)
            ->create();
    }
}
