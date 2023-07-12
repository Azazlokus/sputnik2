<?php

namespace database\seeders;

use App\Models\User;
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
                    'user_id' => '00000000-0000-0000-0000-000000000000',
                    'image_name' => 'Ava',
                    'path_to_photo' => 'D://photosFromEgypt',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => '00000000-0000-0000-0000-000000000000',
                    'image_name' => 'Ava2',
                    'path_to_photo' => 'D://photosFromThailand',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => '11111111-1111-1111-1111-111111111111',
                    'image_name' => 'Ava2',
                    'path_to_photo' => 'D://photosFromThailand',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );

    }
}
