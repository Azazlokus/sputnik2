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
        RelaxPlaceImage::factory()
            ->count(10)
            ->create();
    }
}
