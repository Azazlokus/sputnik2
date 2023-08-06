<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
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
            if (!User::where('email', 'admin@mail.ru')->exists()) {
                $admin = User::query()->create([
                    'email' => 'admin@mail.ru',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ]);
                $admin->roles()->attach(Role::query()->where('role', RoleEnum::Admin)->first());

            }
            if (!User::where('email', 'user@mail.ru')->exists()) {
                $user = User::query()->create([
                    'email' => 'user@mail.ru',
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10),
                ]);
                $user->roles()->attach(Role::query()->where('role', RoleEnum::User)->first());

            }

            User::factory()->count(10)->hasAttached(Role::where('role', RoleEnum::User)->first())->create();

        });
    }
}
