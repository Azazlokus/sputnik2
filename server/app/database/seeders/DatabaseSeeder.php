<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RelaxPlace;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UsersRolesPivotTableSeeder::class);
        $this->call(RelaxPlaceSeeder::class);
        $this->call(RelaxPlaceImagesSeeder::class);
        $this->call(RelaxPlaceCategoriesSeeder::class);
        $this->call(UserWishlistSeeder::class);
        $this->call(UserPhotoSeeder::class);
        $this->call(UserNotificationsSeeder::class);
        $this->call(UserNotificationsSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
