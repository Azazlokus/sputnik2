<?php

namespace Database\Seeders;

use Couchbase\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                ['role' => \App\Constants\Role::ADMIN],
                ['role' => \App\Constants\Role::USER]
            ]
        );
    }
}
