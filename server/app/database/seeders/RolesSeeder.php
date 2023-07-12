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
                ['role' => 'Администратор',
                    'created_at' => now(),
                    'updated_at' => now()],
                ['role' => 'Пользователь',
                    'created_at' => now(),
                    'updated_at' => now()]
            ]
        );
    }
}
