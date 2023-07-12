<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                [
                    'id' => '00000000-0000-0000-0000-000000000000',
                    'username' => 'Azazlokus',
                    'email' => 'Azazlokus@mail.ru',
                    'email_verified_at' => now(),
                    'password' => bcrypt('azazlokus'),
                    'firstName' => 'Azamat',
                    'lastName' => 'Kusarbaev',
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => '11111111-1111-1111-1111-111111111111',
                    'username' => 'Breketmax',
                    'email' => 'Makan@anime.ru',
                    'email_verified_at' => now(),
                    'password' => bcrypt('2002KemerovscayaSova2002'),
                    'firstName' => 'Maxim',
                    'lastName' => 'Scheglov',
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
        User::factory()
            ->count(10)
            ->create();
    }
}
