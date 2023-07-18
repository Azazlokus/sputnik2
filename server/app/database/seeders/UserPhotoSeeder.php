<?php

namespace database\seeders;

use App\Models\User;
use App\Models\UserPhoto;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_photos')->insert([
                [
                    'user_id' => User::query()->inRandomOrder()->pluck('id')->first(),
                    'image_name' => 'Ava',
                    'path_to_photo' => './../../public/storage/hashiro.jpg'
                ],

            ]
        );
        UserPhoto::factory()
            ->count(10)
            ->create();
    }
}
