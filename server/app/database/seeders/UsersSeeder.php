<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
            $user = User::create([
                'email' => 'user@mail.ru',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
            $admin->roles()->attach(Role::query()->where('role', RoleConstants::ADMIN)->first());
            $user->roles()->attach(Role::query()->where('role', RoleConstants::USER)->first());

            User::factory()->count(10)->hasAttached(Role::where('role', RoleConstants::USER)->first())->create();

        });
    }
}
