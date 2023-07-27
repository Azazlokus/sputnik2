<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::withoutEvents(function () {
            if (!Role::query()->where('role', RoleConstants::ADMIN)->exists()) {
                Role::query()->create([
                    'role' => RoleConstants::ADMIN
                ]);

            }
            if (!Role::query()->where('role', RoleConstants::USER)->exists()) {
                Role::query()->create([
                    'role' => RoleConstants::USER
                ]);
            }
            if (!Role::query()->where('role', RoleConstants::USER_BLOCKED)->exists()) {
                Role::query()->create([
                    'role' => RoleConstants::USER_BLOCKED
                ]);

            }
        });
    }
}
