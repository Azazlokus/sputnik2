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
        User::withoutEvents(function () {
            $admin = User::create([
                'email' => 'admin@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('admin'),
                'remember_token' => Str::random(10),
            ]);
            $user = User::create([
                'email' => 'user@anime.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('2002KemerovscayaSova2002'),
                'remember_token' => Str::random(10),
            ]);
            $adminRole = Role::query()->where('role', \App\Constants\RoleConstants::ADMIN)->first();
            $userRole = Role::query()->where('role', \App\Constants\RoleConstants::USER)->first();
            $admin->roles()->attach($adminRole->id);
            $user->roles()->attach($userRole->id);

            User::factory()
                ->count(10)
                ->create();
        });
    }
}
