<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
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
                'password' => bcrypt('admintakoyadmin'),
                'remember_token' => Str::random(10),
            ]);
            $user = User::create([
                'email' => 'user@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('usersuchuser'),
                'remember_token' => Str::random(10),
            ]);
            $adminRole = Role::query()->where('role', \App\Constants\RoleConstants::ADMIN)->first();
            $admin->roles()->attach($adminRole->id);
            $userRole = Role::query()->where('role', \App\Constants\RoleConstants::USER)->first();
            $user->roles()->attach($userRole->id);

            $users = User::factory()
                ->count(10)
                ->create();

            $defaultRole = Role::where('role', RoleConstants::USER)->first();
            if ($defaultRole) {
                foreach ($users as $user) {
                    $user->roles()->attach($defaultRole);
                }
            }
        });
    }
}
