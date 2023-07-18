<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $admin = User::create([
            'email' => 'Azazlokus@mail.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('azazlokus'),
            'remember_token' => Str::random(10)
        ]);
        $user = User::create([
            'email' => 'Makan@anime.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('2002KemerovscayaSova2002'),
            'remember_token' => Str::random(10)
        ]);
        $adminRole = Role::query()->where('role', \App\Constants\Role::ADMIN)->first();
        $userRole = Role::query()->where('role', \App\Constants\Role::USER)->first();
        $admin->roles()->attach($adminRole->id);
        $user->roles()->attach($userRole->id);

        User::factory()
            ->count(10)
            ->create();
    }
}
