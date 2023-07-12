<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersRolesPivotTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            [
                'user_id' => '00000000-0000-0000-0000-000000000000',
                'id' => '1'],
            [
                'user_id' => '11111111-1111-1111-1111-111111111111',
                'id' => '2'
            ]
        ]);
    }
}
