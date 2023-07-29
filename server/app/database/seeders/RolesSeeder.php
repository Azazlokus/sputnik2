<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::withoutEvents(function () {
            if (!Role::query()->where('role', RoleEnum::Admin)->exists()) {
                Role::query()->create([
                    'role' => RoleEnum::Admin
                ]);

            }
            if (!Role::query()->where('role', RoleEnum::User)->exists()) {
                Role::query()->create([
                    'role' => RoleEnum::User
                ]);
            }
            if (!Role::query()->where('role', RoleEnum::UserBlocked)->exists()) {
                Role::query()->create([
                    'role' => RoleEnum::UserBlocked
                ]);

            }
        });
    }
}
