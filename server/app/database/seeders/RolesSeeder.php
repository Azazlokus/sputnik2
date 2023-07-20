<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
                ['role' => RoleConstants::ADMIN],
                ['role' => RoleConstants::USER],
                ['role' => RoleConstants::USER_BLOCKED],
            ]
        );
    }
}
